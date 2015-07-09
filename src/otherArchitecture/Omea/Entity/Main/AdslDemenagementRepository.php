<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

class AdslDemenagementRepository extends EntityRepository{

    
    public function getDemenagementInitial(){
        $qb = $this->_em->createQueryBuilder();
        $qb->select("d")
           ->from($this->getEntityName(), 'd')
           ->where($qb->expr()->eq('d.statut', ':statut'))
           ->andWhere($qb->expr()->lte('d.datePlanification', 'CURRENT_DATE()'))
           ->setParameter('statut', 'INIT')
            ;

        return $qb->getQuery()->getArrayResult();
    }

    public function getDemenagementResiliationOK(){
        $qb = $this->_em->createQueryBuilder();
        $qb->select("d")
        ->from($this->getEntityName(), 'd')
        ->where($qb->expr()->eq('d.statut', ':statut'))
        ->setParameter('statut', 'RESILIATION_OK')
        ;
    
        return $qb->getQuery()->getArrayResult();
    }
    
    public function getDemenagementActivationOK(){
        $qb = $this->_em->createQueryBuilder();
        $qb->select("d")
        ->from($this->getEntityName(), 'd')
        ->where($qb->expr()->eq('d.statut', ':statut'))
        ->setParameter('statut', 'ACTIVATION_OK')
        ;
    
        return $qb->getQuery()->getArrayResult();
    }
} 