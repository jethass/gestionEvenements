<?php
namespace Omea\GestionTelco\PortabilityBundle\Services;

use Psr\Log\LoggerInterface;
use Doctrine\DBAL\Connection;
use Omea\GestionTelco\PortabilityBundle\Types\PortabilityStatus;

class MainRepositoryService
{
    /** @var LoggerInterface */
    private $logger;

    /** @var array */
    private $config;

    /** @var Connection */
    private $mainDb;

    /**
     * @param LoggerInterface $logger
     * @param array           $portabilityConfig
     * @param Connection      $mainDb
     */
    public function __construct(LoggerInterface $logger, array $portabilityConfig, Connection $mainDb)
    {
        $this->logger = $logger;
        $this->mainDb = $mainDb;
        $this->config = $portabilityConfig;
    }
    
    public function beginTransaction()
    {
        $this->mainDb->beginTransaction();
    }
    public function commit()
    {
        $this->mainDb->commit();
    }
    public function rollback()
    {
        $this->mainDb->rollback();
    }
    public function isTransactionActive()
    {
        return $this->mainDb->isTransactionActive();
    }
    public function executeQuery($query, $params)
    {
        return $this->mainDb->executeQuery($query, $params);
    }
    
    public function getParametrage($param)
    {
        $query = 'SELECT VALEUR FROM PARAMETRAGE WHERE ID = ?';
        $value = $this->mainDb->fetchColumn($query, array($param), 0);
        
        return $value;
    }

    public function getLastPortabilityStatusByMsisdn($msisdn, $portabilityType)
    {
        $query = "SELECT ID_PAO, TYPE_PORTA, ID_CLIENT, MSISDN_PORTE, RIO, NUM_ABO, IDPORTAGE, DATEDEMANDE, DATEPORTAGE, TRANCHE, LAST_OPERATION_IN, LAST_CODERETOUR_IN, LAST_DATE_IN, ACQ, CODE_ANOMALIE FROM {$this->config['main']['tables']['status']} WHERE MSISDN_PORTE = ? AND TYPE_PORTA = ? ORDER BY ID_PAO DESC LIMIT 1";
        $lastPortability = $this->mainDb->fetchAssoc($query, array($msisdn, $portabilityType));

        if (empty($lastPortability)) {
            return null;
        }
        return new PortabilityStatus($lastPortability);
    }
    
    public function getLastPortabilityStatusByIdPortage($idPortage, $portabilityType)
    {
        $paoQuery = "SELECT ID_PAO, TYPE_PORTA, ID_CLIENT, MSISDN_PORTE, RIO, NUM_ABO, IDPORTAGE, DATEDEMANDE, DATEPORTAGE, TRANCHE, LAST_OPERATION_IN, LAST_CODERETOUR_IN, LAST_DATE_IN, ACQ, CODE_ANOMALIE FROM {$this->config['main']['tables']['status']} WHERE IDPORTAGE = ? AND TYPE_PORTA = ? ORDER BY ID_PAO DESC LIMIT 1";
        $pao = $this->mainDb->fetchAssoc($paoQuery, array($idPortage, $portabilityType));
        
        if (empty($pao)) {
            return null;
        }
        return new PortabilityStatus($pao);
    }
    
    public function createPortabilityStatus($portabilityType, $idClient, $msisdn, $rio, $idPortage, $dateDemande, $datePortage, $tranche)
    {
        $paoQuery = "INSERT INTO {$this->config['main']['tables']['status']} (TYPE_PORTA, ID_CLIENT, MSISDN_PORTE, RIO, IDPORTAGE, DATEDEMANDE, DATEPORTAGE, TRANCHE) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $this->mainDb->executeUpdate($paoQuery, array($portabilityType, $idClient, $msisdn, $rio, $idPortage, $dateDemande, $datePortage, $tranche));
        
        return $this->mainDb->lastInsertId();
    }

    public function updatePortabilityStatusWithIncomingMessage($msisdn, $idPortage, $operation, $returnCode)
    {
        $paoUpdateQuery = "UPDATE {$this->config['main']['tables']['status']} SET LAST_OPERATION_IN = ?, LAST_CODERETOUR_IN = ?, LAST_DATE_IN = NOW() WHERE MSISDN_PORTE = ? AND IDPORTAGE = ?";
        $nbRows = $this->mainDb->executeUpdate($paoUpdateQuery, array($operation, $returnCode, $msisdn, $idPortage));
        
        return $nbRows;
    }
    
    public function updatePortabilityStatusWithNumAbo($idPortage, $numAbo)
    {
        $paoQuery = "UPDATE {$this->config['main']['tables']['status']} SET NUM_ABO = ? WHERE IDPORTAGE = ?";
        $nbRows = $this->mainDb->executeUpdate($paoQuery, array($numAbo, $idPortage));
        
        return $nbRows;
    }
    
    public function updateFinalPortabilityStatus($idPao, $acq, $anomalyCode = 0)
    {
        $updatePaoQuery = "UPDATE {$this->config['main']['tables']['status']} SET ACQ = ?, CODE_ANOMALIE = ? WHERE ID_PAO = ?";
        $nbRows = $this->mainDb->executeUpdate($updatePaoQuery, array($acq, $anomalyCode, $idPao));
        
        return $nbRows;
    }
    
    /** Generates a new unique identifier for a portability
     * @param $operator string the receiving operator's identifier
     * @param $marque string a subidentifier for the marque
     * @return string the new idPortage
     */
    public function generateIdPortage($operator, $marque)
    {
        $this->mainDb->executeUpdate('LOCK TABLE COMPTEUR_IDPORTAGE WRITE');
        $idPortage = $this->mainDb->fetchColumn('SELECT IDPORTAGE FROM COMPTEUR_IDPORTAGE', array(), 0);
        $this->mainDb->executeUpdate('UPDATE COMPTEUR_IDPORTAGE SET IDPORTAGE=?', array( ($idPortage + 1) ));
        $this->mainDb->executeUpdate('UNLOCK TABLE');
        return $operator . $marque . $idPortage;
    }

    public function insertDisePnmIn($idClient, $idPortage)
    {
        $disePnmInQuery = 'INSERT INTO DISE_PNM_IN (ID_CLIENT, IDPORTAGE, DATE_INSERTION) VALUES (?, ?, NOW())';
        $nbRows = $this->mainDb->executeUpdate($disePnmInQuery, array($idClient, $idPortage));
        
        return $nbRows;
    }
    
    public function updateRefNumerosPortesIn($lineStatus, $numAbo, $msisdn, $opa, $opat, $ope, $opet, $datePortage)
    {
        $RNPIquery = "INSERT INTO REF_NUMEROS_PORTES_IN (STATUT_ABONNEMENT, NUM_ABO, MSISDN, OPA, OPAt, OPE, OPEt, DATE) VALUES (?, ?, ?, ?, ?, ?, ?, ?) "
        ."ON DUPLICATE KEY UPDATE STATUT_ABONNEMENT = ?, NUM_ABO = ?, OPA = ?, OPAt = ?, OPE = ?, OPEt = ?, DATE = ?";
        $nbRows = $this->mainDb->executeUpdate($RNPIquery, array($lineStatus, $numAbo, $msisdn, $opa, $opat, $ope, $opet, $datePortage, $lineStatus, $numAbo, $opa, $opat, $ope, $opet, $datePortage));
        
        return $nbRows;
    }

    public function clearResiliation($idClient)
    {
        $deleteQuery = "DELETE FROM RESILIATION WHERE ID_CLIENT = ?";
        $nbDeletedRows = $this->mainDb->executeUpdate($deleteQuery, array($idClient));
        
        return $nbDeletedRows;
    }

    public function setResiliation($idClient, $typeResil, $etatResil, $dateResil, $idTraitementMic = null)
    {
        $insertQuery = "INSERT INTO RESILIATION (ID_CLIENT, TYPE_RESIL, ETAT, PORTABILITE, DATE_RESILIATION, ID_TRAITEMENTMIC_ZSMART) VALUES (?, ?, ?, '0', ?, ?)";
        $values = array($idClient, $typeResil, $etatResil, $dateResil, $idTraitementMic);

        $nbLignesInserted = $this->mainDb->executeUpdate($insertQuery, $values);
        if ($nbLignesInserted != 1) {
            throw new \Exception("Could not create resiliation for client $idClient");
        }
    }

    public function updatePnmOutWait($idPnmOutWait, $status)
    {
        $statusQuery = 'UPDATE PNM_OUT_WAIT SET ACTIV_PNM_V2 = ? WHERE ID_PNM_OUT_WAIT = ?';
        $nbRows = $this->mainDb->executeUpdate($statusQuery, array($status, $idPnmOutWait));
        
        return $nbRows;
    }
    public function resetDatePortageInPnmOutWait($idPnmOutWait)
    {
        $query = 'UPDATE PNM_OUT_WAIT SET DATEDEMANDE = ?, DATEPORTAGE = ? WHERE ID_PNM_OUT_WAIT = ?';
        $nbRows = $this->mainDb->executeUpdate($query, array('0000-00-00', '0000-00-00', $idPnmOutWait));
        return $nbRows;
    }
    
    public function updateTransactionStatus($idTransaction, $status)
    {
        $checkStatusQuery = 'SELECT ID_TRANS_STATUT FROM TRANSACTION_ETAT WHERE ID_TRANS = ? ORDER BY ID_TRANS_ETAT DESC';
        $currentStatus = $this->mainDb->fetchColumn($checkStatusQuery, array($idTransaction), 0);
        if ($currentStatus != $status) {
            $updateQuery = 'INSERT INTO TRANSACTION_ETAT (ID_TRANS, ID_TRANS_STATUT, DATE_ETAT) VALUES (?, ?, NOW())';
            $nbRows = $this->mainDb->executeUpdate($updateQuery, array($idTransaction, $status));
        } else {
            $this->logger->warning("Status for transaction $idTransaction was already $status");
            $nbRows = 0;
        }
        return $nbRows;
    }
    
    public function insertPnmAbandon($idClient)
    {
        $abandonRequest = 'INSERT INTO PNM_ABANDON (ID_CLIENT) VALUES (?)';
        $nbRows = $this->mainDb->executeUpdate($abandonRequest, array($idClient));
        
        return $nbRows;
    }
}
