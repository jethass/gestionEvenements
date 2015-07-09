<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

class DiseModificationEtatAbonneRepository extends EntityRepository
{
    /**
     * Get the last abonnement suspension
     *
     * @param DiseAbonnement $diseAbonnement
     *
     * @return DiseModificationEtatAbonne|null
     */
    public function findLastSuspByAbo(DiseAbonnement $diseAbonnement)
    {
        return $this->createQueryBuilder('dmea')
            ->where('dmea.typeModification = :typeSusp')
            ->setParameter('typeSusp', 'SUSP')
            ->andWhere('dmea.dateHeureEffet != :dateNull')
            ->setParameter('dateNull', '0000-00-00 00:00:00')
            ->andWhere('dmea.diseAbonnement = :diseAbonnement')
            ->setParameter('diseAbonnement', $diseAbonnement->getNumAbo())
            ->orderBy('dmea.dateHeureEffet', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
