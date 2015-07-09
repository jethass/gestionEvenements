<?php
namespace Omea\GestionTelco\PortabilityBundle\Services;

use Psr\Log\LoggerInterface;
use Doctrine\DBAL\Connection;
use Omea\GestionTelco\PortabilityBundle\Types\Message;

class IncomingPortabilityCreationService
{
    /** @var array */
    protected $config;

    /** @var LoggerInterface */
    protected $logger;

    /** @var Connection */
    protected $mainDb;

    /** @var MessagingService */
    protected $messaging;

    /**
     * @param LoggerInterface  $logger
     * @param array            $config
     * @param MessagingService $messaging
     * @param Connection       $mainDb
     */
    public function __construct(LoggerInterface $logger,
                                array $config,
                                MessagingService $messaging,
                                Connection $mainDb)
    {
        $this->logger = $logger;
        $this->config = $config;
        $this->messaging = $messaging;
        $this->mainDb = $mainDb;
    }

    /** Initiates a new Incoming Portability
     * @param  int    $idClient    the client's unique ID in the system
     * @param  string $msisdn      the phone number to be ported in
     * @param  string $rio         the phone number's current RIO passcode
     * @param  string $dateDemande the date the portability is created
     * @param  string $datePortage the date the portability is to be scheduled for
     * @param  int    $tranche     the time-period the portability is to be scheduled for
     * @param  int    $idTrans     the transaction ID associated to the client's initial activation purchase
     * @return string the portability's unique identifier (IDPORTAGE)
     */
    public function createIncomingPortability($idClient, $msisdn, $rio, $dateDemande, $datePortage, $tranche, $idTransaction)
    {
        try {

            // Check duplicates
            if ($this->checkActiveIncomingPortability($msisdn)) {
                throw new \Exception("Active incoming portability already in progress !");
            }

            // Calculate IDPORTAGE
            $idPortage = $this->messaging->generateIdPortage($this->config['operators']['op'], $this->config['messages']['marque_simm']);

            $this->mainDb->beginTransaction();

            // Initialize PNM_ACTIVATION_OMG
            $paoQuery = "INSERT INTO {$this->config['main']['tables']['status']} (TYPE_PORTA, ID_CLIENT, MSISDN_PORTE, RIO, IDPORTAGE, DATEDEMANDE, DATEPORTAGE, TRANCHE) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $this->mainDb->executeUpdate($paoQuery, array('PE', $idClient, $msisdn, $rio, $idPortage, $dateDemande, $datePortage, $tranche));

            // Initialize DISE_PNM_IN [For legacy reasons, not really used anymore]
            $disePnmInQuery = 'INSERT INTO DISE_PNM_IN (ID_CLIENT, IDPORTAGE, DATE_INSERTION) VALUES (?, ?, NOW())';
            $this->mainDb->executeUpdate($disePnmInQuery, array($idClient, $idPortage));

            // Create ELI message
            $message = new Message();
            $message->state = $this->config['main']['states']['out']['pending'];
            $message->operation = 'ELI';
            $message->emetteur = 'RR';
            $message->recepteur = 'EG';
            $message->msisdn = $msisdn;
            $message->rio = $rio;
            $message->idPortage = $idPortage;
            $message->opr = $this->config['operators']['op'];
            $message->oprt = $this->config['operators']['optech'];
            $message->opd = $opd;
            $message->dateDemande = $dateDemande;
            $message->datePortage = $datePortage;
            $message->tranche = $tranche;

            $this->messaging->addMessage($this->config['main']['tables']['out'], $message);

            // TRANSACTION_ETAT
            $this->updateTransactionStatus($idTransaction, $this->config['misc']['transactionStatus']['awaitingActivation']);

            $this->mainDb->commit();
        } catch (\Exception $e) {
            $this->mainDb->rollback();
            throw new \Exception("Could not create new Incoming Portability", 0, $e);
        }

        return $idPortage;
    }

    /** Checks whether an incoming portability is already ongoing for a given phone number
     * @param  string  $msisdn
     * @return boolean
     */
    public function checkActiveIncomingPortability($msisdn)
    {
        $query = "SELECT IDPORTAGE, DATE_PORTAGE, LAST_OPERATION_IN, LAST_CODERETOUR_IN, LAST_DATE_IN, ACQ FROM {$this->config['main']['tables']['status']} WHERE MSISDN_PORTE = ? AND TYPE_PORTA = ? ORDER BY ID_PNMACTIVATIONOMG DESC LIMIT 1";
        $lastPortability = $this->mainDb->fetchAssoc($query, array($msisdn, 'PE'));

        if (empty($lastPortability)) {
            // No incoming portability at all
            return false;
        } elseif ($lastPortability['ACQ'] == '1') {
            // Incoming portability is over
            return false;
        } elseif ($lastPortability['LAST_OPERATION_IN'] != 'GOP' && $lastPortability['DATEPORTAGE'] < date('Y-m-d')) {
            // Still no GOP past the portability's scheduled date ? Let's assume it's been cancelled somehow
            return false;
        } elseif ($lastPortability['LAST_OPERATION_IN'] == 'IND') {
            // Portability cancelled by other operator
            return false;
        } elseif ($lastPortability['LAST_OPERATION_IN'] == 'ANR'
                  && in_array($lastPortability['LAST_CODERETOUR_IN'], $this->config['misc']['ANRsuccessReturnCodes'])) {
            // Portability successfully cancelled by us
            return false;
        } elseif ($lastPortability['LAST_OPERATION_IN'] == 'ANR') {
            // Portability unsuccessfully cancelled by us
            return true;
        } elseif ($lastPortability['LAST_OPERATION_IN'] == 'ELI'
                  && $lastPortability['LAST_CODERETOUR_IN'] == $this->config['misc']['successReturnCode']) {
            // EGP eligibility OK
            return true;
        } elseif ($lastPortability['LAST_OPERATION_IN'] == 'ELI') {
            // EGP eligibility KO
            return false;
        } elseif ($lastPortability['LAST_OPERATION_IN'] == null) {
            // No OK from EGP yet
            return true;
        }
    }

    protected function updateTransactionStatus($idTransaction, $status)
    {
        $checkStatusQuery = 'SELECT ID_TRANS_STATUS FROM TRANSACTION_ETAT WHERE ID_TRANS = ? ORDER BY ID_TRANS_ETAT DESC';
        $currentStatus = $this->mainDb->fetchColumn($checkStatusQuery, array($idTransaction), 0);
        if ($currentStatus != $status) {
            $updateQuery = 'INSERT INTO TRANSACTION_ETAT (ID_TRANS, ID_TRANS_STATUS, DATE_ETAT) VALUES (?, ?, NOW())';
            $nbLignes = $this->mainDb->executeUpdate($updateQuery, array($idTransaction, $status));
        } else {
            $this->logger->warning("Status for transaction $idTransaction was already $status");
            $nbLignes = 0;
        }
        return $nbLignes;
    }

    /** Generates a new unique identifier for a portability
     * @param $operator string the receiving operator's identifier
     * @param $marque string a subidentifier for the marque
     * @return string the new idPortage
     */
    protected function generateIdPortage($operator, $marque)
    {
        $this->mainDb->executeQuery('LOCK TABLE COMPTEUR_IDPORTAGE WRITE');
        $idPortage = $this->mainDb->fetchColumn('SELECT IDPORTAGE FROM COMPTEUR_IDPORTAGE', array(), 0);
        $this->mainDb->executeUpdate('UPDATE COMPTEUR_IDPORTAGE SET IDPORTAGE=?', array( ($idPortage + 1) ));
        $this->mainDb->executeQuery('UNLOCK TABLE');
        return $operateur . $marque . $idPortage;
    }
}
