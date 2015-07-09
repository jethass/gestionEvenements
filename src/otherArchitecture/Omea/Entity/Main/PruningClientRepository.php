<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

/**
 */
class PruningClientRepository extends EntityRepository
{
    /**
     * @param integer $idClient
     * @param integer $idParametrage
     * @param \DateTime $dateMigration
     * @return \Doctrine\DBAL\Driver\Statement
     */
    public function insertClient($idClient, $idParametrage, \DateTime $dateMigration)
    {
        $con = $this->getEntityManager()->getConnection();
        $metadata = $this->getClassMetadata();
        $sql = sprintf('INSERT INTO %s (%s, %s, %s) VALUES (%d, %d, %s)',
            $metadata->getTableName(),
            $metadata->getColumnName('idPruningParametrage'),
            $metadata->getColumnName('idClient'),
            $metadata->getColumnName('dateMigrationTheorique'),
            $idParametrage,
            $idClient,
            $con->quote($dateMigration->format('Y-m-d'))
        );
        return $con->executeQuery($sql);
    }
    
    /**
     * Récupère les clients actifs sur un ou plusieurs cycles et une offre donnée
     * @param array $cycles
     * @param integer $offreId
     * @return \Doctrine\DBAL\Driver\Statement
     */
    public function getClientActifParCycleEtOffre(array $cycles, $offreId)
    {
        $inQuery = implode(', ', array_fill(0, count($cycles), '?'));

        $sql = '
            SELECT SM.`ID_CLIENT`, SM.MSISDN, SM.DATE_IAS
            FROM MAIN_VM.`CLIENT` C
            INNER JOIN MAIN_VM.`STOCK_MSISDN` SM ON SM.`ID_CLIENT` = C.`ID_CLIENT`
            INNER JOIN MAIN_VM.`DISE_ABONNEMENT` DA ON DA.`NUM_ABO` = SM.`NUM_ABO`
            INNER JOIN MAIN_VM.`FORFAIT` F ON F.`ID_ART` = SM.`ID_ART`
            LEFT JOIN MAIN_VM.`PRUNING_CLIENT` PC ON PC.`ID_CLIENT` = C.`ID_CLIENT`
            LEFT JOIN MAIN_VM.`FLUIDITE` FL ON FL.`ID_CLIENT` = SM.`ID_CLIENT` AND FL.`TRAITE` IS NULL AND FL.DATE_ANNULATION IS NULL
            WHERE FL.`ID_CLIENT` IS NULL
            AND PC.`ID_CLIENT` IS NULL
            AND C.`CYCLE` IN(' . $inQuery . ')
            AND F.`offre_id` = ?
            AND DA.`STATUT_ABONNEMENT` = \'A\'';

        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);

        foreach ($cycles as $i => $cycle) {
            $stmt->bindValue(($i + 1), $cycle);
        }
        $stmt->bindValue(count($cycles) + 1, $offreId);
        
        $stmt->execute();
                
        return $stmt;
    }

    /**
     * @param \DateTime $dateMigration
     * @return \Doctrine\DBAL\Driver\Statement
     */
    public function getClientsAMigrerParDate(\DateTime $dateMigration, $limit)
    {
        $sql = '
            SELECT SM.ID_CLIENT, SM.MSISDN, SM.DATE_IAS, F.REF_SAP, CL.EMAIL, C.ID_PRUNING_CLIENT, DA.STATUT_ABONNEMENT
            FROM MAIN_VM.PRUNING_CLIENT C
            INNER JOIN MAIN_VM.STOCK_MSISDN SM ON SM.ID_CLIENT = C.ID_CLIENT
            INNER JOIN MAIN_VM.CLIENT CL ON CL.ID_CLIENT = C.ID_CLIENT
            INNER JOIN MAIN_VM.DISE_ABONNEMENT DA ON DA.NUM_ABO = SM.NUM_ABO
            INNER JOIN MAIN_VM.PRUNING_PARAMETRAGE PP ON PP.ID_PRUNING_PARAMETRAGE = C.ID_PRUNING_PARAMETRAGE
            INNER JOIN MAIN_VM.FORFAIT F ON F.offre_id = PP.OFFRE_ID_CIBLE
            LEFT JOIN MAIN_VM.FLUIDITE FL ON FL.ID_CLIENT = SM.ID_CLIENT AND FL.TRAITE IS NULL AND FL.DATE_ANNULATION IS NULL
            WHERE FL.ID_CLIENT IS NULL
            AND C.DATE_MIGRATION_THEORIQUE = \'' . $dateMigration->format("Y-m-d") . '\'
            AND C.ID_MIG IS NULL
            LIMIT ' . $limit;

        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);

        $stmt->execute();

        return $stmt;
    }
    
    /**
     * 
     * @param \DateTime $dateMigration
     * @param boolean $isMigrationTermine
     * @return \Doctrine\DBAL\Driver\Statement
     */
    public function getClientsAvecParametrage(\DateTime $dateMigration, $isMigrationTermine)
    {
        $nullCondition = (true === $isMigrationTermine ? 'IS NOT NULL' : 'IS NULL');
        
        $sql = '
            SELECT C.ID_CLIENT, PP.OFFRE_ID_ORIGINE, PP.OFFRE_ID_CIBLE, A0.ID_ART AS ID_ARTICLE_ORIGINE, A1.ID_ART AS ID_ARTICLE_CIBLE
            FROM MAIN_VM.PRUNING_CLIENT C
            INNER JOIN MAIN_VM.PRUNING_PARAMETRAGE PP ON PP.ID_PRUNING_PARAMETRAGE = C.ID_PRUNING_PARAMETRAGE
            INNER JOIN MAIN_VM.FORFAIT F0 ON F0.offre_id = PP.OFFRE_ID_ORIGINE
            INNER JOIN MAIN_VM.FORFAIT F1 ON F1.offre_id = PP.OFFRE_ID_CIBLE
            INNER JOIN MAIN_VM.ARTICLE A0 ON A0.ID_ART = F0.ID_ART
            INNER JOIN MAIN_VM.ARTICLE A1 ON A1.ID_ART = F1.ID_ART
            WHERE C.DATE_MIGRATION_THEORIQUE = \'' . $dateMigration->format("Y-m-d") . '\'
            AND C.ID_MIG ' . $nullCondition;

        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);

        $stmt->execute();

        return $stmt;
    }
}