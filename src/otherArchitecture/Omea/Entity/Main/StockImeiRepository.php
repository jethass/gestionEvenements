<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

class StockImeiRepository extends EntityRepository
{
    /**
     * Get the customer's current mobile info
     *
     * @param integer $idClient
     *
     * @return array|ArrayCollection
     */
    public function findCurrentMobileByIdClient($idClient)
    {
        return $this->createQueryBuilder('si')
            ->innerJoin('si.commande', 'cmd')
            ->innerJoin('cmd.transaction', 't')
            ->innerJoin('cmd.article', 'a')
            ->innerJoin('a.typeEntite', 'te', 'WITH', 'te.idTe IN (:idTe)')
            ->leftJoin('a.artCombiPere', 'ac')
            ->leftJoin('ac.articleFils', 'a2')
            ->leftJoin('a2.typeEntite', 'te2', 'WITH', 'te2.idTe IN (:idTe)')
            ->where('t.idClient = :idClient')
            ->andWhere('t.transAnnule IS NOT NULL')
            ->setParameter('idClient', $idClient)
            ->setParameter('idTe', array(1, 2, 3, 4))
            ->getQuery()
            ->getResult();
    }

    /**
     * Get a StockImei for the given clientId and idArt
     *
     * @param integer $clientId
     * @param integer $idArt
     * @return StockImei|null
     */
    public function getStockImeiFromClientAndArticle($clientId, $idArt)
    {
        $qb = $this->createQueryBuilder('si')
            ->innerJoin('si.commande', 'cmd')
            ->innerJoin('cmd.transaction', 't')
            ->innerJoin('t.client', 'c')
            ->where('c.idClient = :clientId')
            ->andWhere('cmd.idArt = :idArt')
            ->setParameters(
                array(
                    'clientId'   => $clientId,
                    'idArt'      => $idArt,
                )
            );

        return $qb->getQuery()->getOneOrNullResult();
    }
}
