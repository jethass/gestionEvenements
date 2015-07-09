<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

class OtAdslRepository extends EntityRepository
{
    public function getOtAdslResil($idLigneAdsl)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('oa')
            ->from($this->getEntityName(), 'oa')
            ->where('oa.ligneAdsl = :ligneAdsl')
            ->andWhere("oa.verbe = 'RESILIER'")
            ->andWhere('oa.statutCode != 15')
            ->andWhere('oa.statutCode != 13')
            ->setParameter('ligneAdsl', $idLigneAdsl);

        $result = $qb->getQuery()->getArrayResult();
        return (isset($result[0])) ? $result[0] : null;
    }
}