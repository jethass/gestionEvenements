<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

class C010Repository extends EntityRepository
{
    public function getByMontantAndTypePaiement($signe,$montant)
    {

            $qb = $this->_em->createQueryBuilder();

            $qb->select(array('c.idClient','c.nom','c.prenom','c.balanceClient', 'c.cycle'));
            $qb->from($this->getEntityName(),'c');
            $qb->where('c.balanceClient '.$signe.' :montantMax');
            $qb->andWhere('c.balanceClient > 0');
            $qb->andWhere('c.isTraite = 0');
            $qb->andWhere('c.rembParChq = \'0\'');
            $qb->setParameter('montantMax',$montant);
            $qb->setMaxResults(1000);

            return $qb->getQuery()->getResult();

    }

    public function getByMontantMaxAndCbOrPrelevement($montantMax)
    {
        return $this->getByMontantAndTypePaiement('<=',$montantMax);
    }

    public function getByMontantMinAndCbOrPrelevement($montantMin)
    {
        return $this->getByMontantAndTypePaiement('>',$montantMin);
    }

    public function getByCheque()
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->select(array('c.idClient','c.nom','c.prenom','c.balanceClient', 'c.cycle'));
        $qb->from($this->getEntityName(),'c');
        $qb->where('c.rembParChq = \'1\'');
        $qb->andWhere('c.isTraite = 0');
        $qb->setMaxResults(1000);

        return $qb->getQuery()->getResult();
    }
}
