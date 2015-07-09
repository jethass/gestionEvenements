<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

class TransactionEtatRepository extends EntityRepository {

    public function getTransactionsEtatByIdTransAndIdTransStatut($idTrans, $idTransStatut)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('te')
            ->from($this->getEntityName(), 'te')
            ->innerJoin('te.transaction', 't')
            ->where($qb->expr()->eq('t.idTrans', $idTrans))
            ->andWhere($qb->expr()->eq('te.idTransactionStatut', $idTransStatut))
            ->orderBy('te.dateEtat', 'ASC');

        return $qb->getQuery()->getArrayResult();
    }

    public function getLastTransactionsEtatByIdTrans($idTrans)
    {
        $qb = $this->createQueryBuilder('te');
        $qb->innerJoin('te.transaction', 't')
            ->where('t.idTrans = :idTrans')
            ->orderBy('te.dateEtat', 'desc')
            ->setParameter('idTrans', $idTrans)
            ->setMaxResults(1)
            ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
