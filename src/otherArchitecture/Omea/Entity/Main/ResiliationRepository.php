<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

class ResiliationRepository extends EntityRepository
{
    /**
     * Retourne true / false suivant si le client est Resilie ou non depuis 1 an
     *
     * @param int $idClient
     *
     * @return boolean
     */
    public function isResilier1An($idClient)
    {
        $singleResult = $this->createQueryBuilder('r')
            ->select('COUNT(r.idResiliation) as nb')
            ->where('r.idClient = :idClient')
            ->andWhere('r.dateResiliation <= :date')
            ->andWhere('r.typeResil != :typeResilPrepaye')
            ->setParameters(array(
                'idClient'         => $idClient,
                'date'             => new \DateTime('-1 year'),
                'typeResilPrepaye' => 4,
            ))
            ->getQuery()
            ->getSingleResult();

        return ($singleResult['nb'] > 0);
    }
}
