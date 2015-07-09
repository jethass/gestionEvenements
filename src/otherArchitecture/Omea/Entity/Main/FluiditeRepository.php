<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

class FluiditeRepository extends EntityRepository
{
    /**
     * @param $idClient
     * @param  null  $traite
     * @return array
     */
    public function getPendingMigrationByClient($idClient)
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->select('f.idMig', 'f.dateInsertion', 'f.offreId', 'f.offreOld', 'f.dateMigration', 'f.dateAnnulation', 'f.montant', 'a.titreMarket', 'a.idArticle')
            ->from($this->getEntityName(), 'f')
            ->innerJoin('f.forfait', 'fo')
            ->innerJoin('fo.article', 'a')
            ->innerJoin('f.client', 'c')
            ->where($qb->expr()->eq('c.idClient', $idClient))
            ->andWhere($qb->expr()->isNull('f.traite'))
            ->orderBy('f.idMig', 'DESC');

        $result = $qb->getQuery()->getArrayResult();//in case whe have more than one row

        return isset($result[0])?$result[0]:null;
    }

    /**
     * @param $idClient
     * @return bool
     */
    public function isMigrationAttendue($idClient) {
        /** @var Fluidite $migration */
        $migration = $this->getPendingMigrationByClient($idClient);
        if(0 === count($migration)) {
            return false;
        }

        $now = new \DateTime();

        if($migration["dateMigration"] <= $now || $migration["dateAnnulation"]) {
            return false;
        }

        return true;
    }
}
