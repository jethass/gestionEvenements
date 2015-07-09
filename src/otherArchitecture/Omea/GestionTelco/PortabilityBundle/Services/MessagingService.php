<?php
namespace Omea\GestionTelco\PortabilityBundle\Services;

use Psr\Log\LoggerInterface;
use Doctrine\DBAL\Connection;
use Omea\GestionTelco\PortabilityBundle\Types\Message;

class MessagingService
{
    /** @var LoggerInterface */
    private $logger;

    /** @var array */
    private $config;

    /** @var Connection */
    private $mainDb;

    /** @var Connection */
    private $pnmDb;

    /**
     * @param LoggerInterface $logger
     * @param Connection      $mainDb
     * @param Connection      $pnmDb
     * @param array           $portabilityConfig
     */
    public function __construct(
        LoggerInterface $logger,
        Connection $mainDb,
        Connection $pnmDb,
        array $portabilityConfig
    ) {
        $this->logger = $logger;
        $this->mainDb = $mainDb;
        $this->pnmDb = $pnmDb;
        $this->config = $portabilityConfig;
    }

    /**
     * @param string  $queue
     * @param Message $message
     */
    public function addMessage($table, Message $message)
    {
        switch ($table) {
            case $this->config['main']['tables']['in']:
            case $this->config['main']['tables']['out']:
                $db = 'mainDb';
                $format = 'Y-m-d';
                $insertQuery = "INSERT INTO $table
                (ETAT, DATEHEUREETAT, OPERATION, EMETTEUR, RECEPTEUR, MSISDN, RIO, OPR, OPRT, OPD,
                 OPDT, OPA, OPAT, IDPORTAGE, DATEDEMANDE, DATEPORTAGE, TRANCHE, CODERETOUR)
                VALUES (?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";
                break;
            case $this->config['messages']['tables']['in']:
            case $this->config['messages']['tables']['out']:
                $db = 'pnmDb';
                $format = 'Ymd';
                $insertQuery = "INSERT INTO $table
                (ETAT_MESSAGE, DATE_RECEPTION, DATE_DERNIER_CHANGEMENT_ETAT, OPERATION, EMETTEUR, RECEPTEUR, MSISDN, RIO, OPR, OPRT, OPD,
                 OPDT, OPA, OPAT, ID_PORTAGE, DATE_DEMANDE, DATE_PORTAGE, TRANCHE, CODE_RETOUR, MARQUE_ID)
                VALUES (?, NOW(), NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '1') ";
                break;
            default:
                throw new \Exception("We do not know how to update table $table");
        }

        $values = array($message->state,
                        $message->operation,
                        $message->emetteur,
                        $message->recepteur,
                        $message->msisdn,
                        $message->rio,
                        $message->opr,
                        $message->oprt,
                        $message->opd,
                        $message->opdt,
                        $message->opa,
                        $message->opat,
                        $message->idPortage,
                        $message->dateDemande->format($format),
                        $message->datePortage->format($format),
                        $message->tranche,
                        $message->codeRetour);

        $nbLignesInserted = $this->$db->executeUpdate($insertQuery, $values);
        if ($nbLignesInserted != 1) {
            throw new \Exception('Could not insert message %s into table %s', $message, $table);
        }
        return $this->$db->lastInsertId();
    }

    /** Updates the state of a message in the message table
     * @param string $table the message table's name
     * @param int    $id    the message's unique identifier in this table
     * @param string $state the state's value
     */
    public function updateState($table, $id, $state)
    {
        switch ($table) {
            case $this->config['messages']['tables']['in']:
            case $this->config['messages']['tables']['out']:
                $updateQuery = "UPDATE $table SET ETAT_MESSAGE = ?, DATE_DERNIER_CHANGEMENT_ETAT=NOW() WHERE ID = ?";
                $nbLignesUpdated = $this->pnmDb->executeUpdate($updateQuery, array($state, $id));
                break;
            case $this->config['main']['tables']['in']:
                $updateQuery = "UPDATE $table SET ETAT = ? WHERE ID_OPI = ?";
                $nbLignesUpdated = $this->mainDb->executeUpdate($updateQuery, array($state, $id));
                break;
            case $this->config['main']['tables']['out']:
                $updateQuery = "UPDATE $table SET ETAT = ? WHERE ID_OPO = ?";
                $nbLignesUpdated = $this->mainDb->executeUpdate($updateQuery, array($state, $id));
                break;
            default:
                throw new \Exception("We do not know how to update table $table");
        }
        if ($nbLignesUpdated != 1) {
            throw new \Exception("Query $query with state = $state & id = $id updated nothing");
        }
        $this->logger->info("Updated state of element #$id in $table to $state");
    }
}
