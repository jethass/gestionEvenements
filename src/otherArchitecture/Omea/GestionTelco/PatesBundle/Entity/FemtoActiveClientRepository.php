<?php
namespace Omea\GestionTelco\PatesBundle\Entity;

use Doctrine\ORM\EntityRepository;

class FemtoActiveClientRepository extends EntityRepository
{
    /**
     * @param string $numAbo
     * @param null|string $states
     * @return null|FemtoActiveClient
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getClientByNumAboAndState($numAbo, $states = null)
    {
        $qb = $this->createQueryBuilder('fac');
        $qb->where('fac.numAbo = :numAbo')
            ->setParameter('numAbo', $numAbo)
            ;

        if (null !== $states) {
            /*
            $qb->andWhere('fac.state IN (:states)')
                ->setParameter('states', $states)
            ;
            */
            $qb->andWhere($qb->expr()->in('fac.state', explode(',', $states)));
        }

        $qb->orderBy('fac.activeAt', 'desc');

        return $qb->getQuery()->getResult();
    }
}
