<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

class StockNsceRepository extends EntityRepository
{
    public function findActiveByClient($clientId)
    {
        return $this->createQueryBuilder('sn')
            ->innerJoin('sn.stockmsisdn', 'sm')
            ->where('sm.idClient = :idClient')
            ->andWhere('sm.etat = :etatMsisdn')
            ->andWhere('sn.etat = :etatNsce')
            ->setParameters(array(
                'idClient'   => $clientId,
                'etatMsisdn' => '1',
                'etatNsce'   => '1',
            ))
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findLastByClient($clientId)
    {
        $qb = $this->createQueryBuilder('sn')
            ->innerJoin('sn.commandes', 'c')
            ->innerJoin('c.transaction', 't')
            ->where('t.idClient = :idClient');

        $orModule = $qb->expr()->orX();
        $orModule->add($qb->expr()->eq('sn.etat', ':etat'));

        $andModule = $qb->expr()->andX();
        $andModule->add($qb->expr()->isNull('sn.msisdn'));
        $andModule->add($qb->expr()->eq('t.idDis', ':idDis'));
        $andModule->add($qb->expr()->eq('t.idMag', ':idMag'));
        $orModule->add($andModule);

        $qb->andWhere($orModule)
            ->setParameters(array(
                'idClient' => $clientId,
                'etat' => '1',
                'idDis' => '500',
                'idMag' => '5'
            ))
            ->orderBy('sn.dateDernMaj', 'DESC')
            ->setMaxResults(1);

        return $qb->getQuery()
            ->getOneOrNullResult();
    }
}
