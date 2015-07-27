<?php
namespace Omea\GestionTelco\PortabilityBundle\Services;

use Psr\Log\LoggerInterface;
use Omea\GestionTelco\PortabilityBundle\Types\Message;

class IncomingPortabilityService
{
    /** @var array */
    protected $config;

    /** @var LoggerInterface */
    protected $logger;

    /** @var MainRepositoryService */
    protected $main;

    /** @var MessagingService */
    protected $messaging;

    /**
     * @param LoggerInterface       $logger
     * @param array                 $config
     * @param MessagingService      $messaging
     * @param MainRepositoryService $main
     */
    public function __construct(LoggerInterface $logger,
                                array $config,
                                MessagingService $messaging,
                                MainRepositoryService $main)
    {
        $this->logger = $logger;
        $this->config = $config;
        $this->messaging = $messaging;
        $this->main = $main;
    }

    /** Initiates a new Incoming Portability
     * @param  int    $idClient    the client's unique ID in the system
     * @param  string $msisdn      the phone number to be ported in
     * @param  string $rio         the phone number's current RIO passcode
     * @param  string $dateDemande the date the portability is created
     * @param  string $datePortage the date the portability is to be scheduled for
     * @param  int    $tranche     the time-period the portability is to be scheduled for
     * @return string the portability's unique identifier (IDPORTAGE)
     */
    public function createIncomingPortability($idClient, $msisdn, $rio, $dateDemande, $datePortage, $tranche)
    {
        try {

            // Check duplicates
            if ($this->checkActiveIncomingPortability($msisdn)) {
                throw new \Exception("Active incoming portability already in progress !");
            }
            // Calculate IDPORTAGE
            $idPortage = $this->main->generateIdPortage($this->config['operators']['op'], $this->config['messages']['marque_simm']);

            $this->main->beginTransaction();

            // Initialize PNM_ACTIVATION_OMG
            $this->main->createPortabilityStatus('PE', $idClient, $msisdn, $rio, $idPortage, $dateDemande, $datePortage, $tranche);

            // Initialize DISE_PNM_IN [For legacy reasons, not really used anymore]
            $this->main->insertDisePnmIn($idClient, $idPortage);

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
            $message->opd = substr($rio, 0, 2);
            $message->dateDemande = $dateDemande;
            $message->datePortage = $datePortage;
            $message->tranche = $tranche;

            $this->messaging->addMessage($this->config['main']['tables']['out'], $message);

            $this->main->commit();
        } catch (\Exception $e) {
            if ($this->main->isTransactionActive()) {
                $this->main->rollback();
            }
            throw new \Exception("Could not create new Incoming Portability - {$e->getMessage()}", 0, $e);
        }

        return $idPortage;
    }

    /** Checks whether an incoming portability is already ongoing for a given phone number
     * @param  string  $msisdn
     * @return boolean
     */
    public function checkActiveIncomingPortability($msisdn)
    {
        $lastPortability = $this->main->getLastPortabilityStatusByMsisdn($msisdn, 'PS');
        $this->logger->info("Last porta for $msisdn : $lastPortability");
        if (empty($lastPortability)) {
            // No incoming portability at all
            return false;
        } elseif ($lastPortability->acq == '1') {
            // Incoming portability is over
            return false;
        } elseif ($lastPortability->lastOperationIn != 'GOP' && $lastPortability->datePortage < new \DateTime('now')) {
            // Still no GOP past the portability's scheduled date ? Let's assume it's been cancelled somehow
            return false;
        } elseif ($lastPortability->lastOperationIn == 'IND') {
            // Portability cancelled by other operator
            return false;
        } elseif ($lastPortability->lastOperationIn == 'ANR'
                  && in_array($lastPortability->lastReturnCodeIn, $this->config['misc']['ANRsuccessReturnCodes'])) {
            // Portability successfully cancelled by us
            return false;
        } elseif ($lastPortability->lastOperationIn == 'ANR') {
            // Portability unsuccessfully cancelled by us
            return true;
        } elseif ($lastPortability->lastOperationIn == 'ELI'
                  && $lastPortability->lastReturnCodeIn == $this->config['misc']['successReturnCode']) {
            // EGP eligibility OK
            return true;
        } elseif ($lastPortability->lastOperationIn == 'ELI') {
            // EGP eligibility KO
            return false;
        } elseif ($lastPortability->lastOperationIn == null) {
            // No OK from EGP yet
            return true;
        }
    }

    /** Acknowledges an Incoming Portability went well (or not)
     * @param string $idPortage   the portability's unique identifier
     * @param int    $anomalyCode a code for how well the activation went (0 if ok)
     */
    public function acknowledgeIncomingPortability($idPortage, $anomalyCode = 0)
    {
        try {
            $this->main->beginTransaction();
            
            // Retrieve data from PAO
            $pao = $this->main->getLastPortabilityStatusByIdPortage($idPortage, 'PE');
            
            if (is_null($pao)) {
                throw new \Exception("No current incoming portabilities with idPortage $idPortage");
            }
            if ($pao->lastOperationIn != 'GOP') {
                throw new \Exception("Last message we got from EGP for #$idPortage was not GOP but {$pao->lastOperationIn}");
            }
            if ($pao->acq == '1') {
                throw new \Exception("Portage #$idPortage was already acknowledged");
            }
            
            // Retrieve GOP from incoming messages
            $gop = $this->messaging->getMessageByIdPortage($this->config['main']['tables']['in'], $idPortage, 'GOP');
            
            // Update PAO in all cases
            if ($anomalyCode != 0) {
                $this->main->updateFinalPortabilityStatus($pao->idPao, '0', $anomalyCode);
            } else {
                $this->main->updateFinalPortabilityStatus($pao->idPao, '1', '0');
            
                // Insert/Update RNPI
                $this->main->updateRefNumerosPortesIn('A', $pao->numAbo, $gop->msisdn, $gop->opa, $gop->opat, $gop->opr, $gop->oprt, $gop->datePortage->format('Y-m-d'));
                
                // Create ACQ message
                $acq = clone $gop;
                $acq->state = $this->config['main']['states']['out']['pending'];
                $acq->operation = 'ACQ';
                $acq->emetteur = 'RR';
                $acq->recepteur = 'EG';
                $acq->codeRetour = $this->config['misc']['successReturnCode'];

                $this->messaging->addMessage($this->config['main']['tables']['out'], $acq);
            }
            $this->main->commit();
        } catch (\Exception $e) {
            $this->main->rollback();
            throw new \Exception("Could not acknowledge Incoming Portability $idPortage : {$e->getMessage()}", 0, $e);
        }

        return true;
    }

    /** Cancels an Incoming Portability
     * @param string $msisdn      the phone number being ported in
     * @param string $idPortage   the portability's unique identifier
     * @param int    $anomalyCode a code for how well the activation went (0 if ok)
     */
    public function cancelIncomingPortability($idPortage)
    {
        try {
            // Retrieve data from PAO
             $pao = $this->main->getLastPortabilityStatusByIdPortage($idPortage, 'PE');
            
            if (is_null($pao)) {
                throw new \Exception("No current incoming portabilities with idPortage $idPortage");
            }
            if ($pao->lastOperationIn == 'GOP') {
                throw new \Exception("Incoming portability #$idPortage cannot be cancelled anymore");
            }
            if (($pao->lastOperationIn == 'ELI' && $pao->lastReturnCodeIn != $this->config['misc']['successReturnCode'])
                || ($pao->lastOperationIn == 'ANR' && $pao->lastReturnCodeIn == $this->config['misc']['successReturnCode'])
                || ($pao->lastOperationIn == 'IND')) {
                throw new \Exception("Incoming portability #$idPortage has already been cancelled");
            }
            
            // Retrieve original ELI from outgoing messages
            $eli = $this->messaging->getMessageByIdPortage($this->config['main']['tables']['out'], $idPortage, 'ELI');
            
            // Create ANR message
            $anr = clone $eli;
            $anr->state = $this->config['main']['states']['out']['pending'];
            $anr->operation = 'ANR';
            $anr->emetteur = 'RR';
            $anr->recepteur = 'EG';
            $anr->codeRetour = $this->config['misc']['successReturnCode'];

            $this->messaging->addMessage($this->config['main']['tables']['out'], $anr);
        } catch (\Exception $e) {
            throw new \Exception("Could not cancel Incoming Portability $idPortage : {$e->getMessage()}", 0, $e);
        }

        return true;
    }
}
