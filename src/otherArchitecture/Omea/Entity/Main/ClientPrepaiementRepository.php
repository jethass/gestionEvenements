<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

class ClientPrepaiementRepository extends EntityRepository
{
    /**
     * @param $clientId
     * @param $state
     * @return array
     */
    public function getPrepaymentsByState($clientId, $state)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('cp')
            ->from($this->getEntityName(), 'cp')
            ->innerJoin('cp.client', 'c')
            ->innerJoin('cp.etat', 'e')
            ->where($qb->expr()->eq('e.idClientPrepaiementEtat', ':state'))
            ->andWhere($qb->expr()->eq('c.idClient', ':clientId'))
            ;

        $qb->setParameter('state', $state);
        $qb->setParameter('clientId', $clientId);

        return $qb->getQuery()->getResult();
    }

    /**
     * @param $clientId
     * @return array
     */
    public function getLastPrepayment($clientId)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('cp')
            ->from($this->getEntityName(), 'cp')
            ->innerJoin('cp.client', 'c')
            ->andWhere($qb->expr()->eq('c.idClient', ':clientId'))
        ;
        $qb->setParameter('clientId', $clientId);
        $qb->orderBy('cp.idClientPrepaiement', 'DESC');
        $qb->setMaxResults(1);

        return $qb->getQuery()->getSingleResult();
    }

    /**
     * @param $interval
     * @return array
     */
    public function getClientsNearTheEnd($interval, $state = 2)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('cp')
            ->from($this->getEntityName(), 'cp')
            ->where($qb->expr()->eq('cp.dtFinPrepaiement', ':date'))
            ->andWhere($qb->expr()->eq('cp.etat', ':state'))
            ;
        $qb->setParameter('date', (new \DateTime($interval))->format('Y-m-d'));
        $qb->setParameter('state', $state);

        return $qb->getQuery()->iterate();

    }
}
