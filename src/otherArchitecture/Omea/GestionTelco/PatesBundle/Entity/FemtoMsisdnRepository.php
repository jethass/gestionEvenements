<?php
namespace Omea\GestionTelco\PatesBundle\Entity;

use Doctrine\ORM\EntityRepository;

class FemtoMsisdnRepository extends EntityRepository
{
    /**
     * @param string $numAbo
     * @param string $states
     * @return array
     */
    public function getMsisdnListByNumAbo($numAbo, $states = null)
    {
        $qb = $this->createQueryBuilder('fm')
            ->innerJoin('fm.fac', 'fac')
            ->where('fac.numAbo = :numAbo');

        if (null !== $states) {
            $qb->andWhere($qb->expr()->in('fm.state', explode(',', $states)));
        }
        $qb->setParameter('numAbo', $numAbo);

        return $qb->getQuery()->getResult();
    }
}
