<?php
/**
 * Created by PhpStorm.
 * User: blegrand
 * Date: 09/09/14
 * Time: 16:48
 */

namespace Omea\Entity\Main;


use Doctrine\ORM\EntityRepository;

class AvancesClientRepository extends EntityRepository
{
    public function getProduitsByCommandesId($commandesId)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select("c")
           ->from($this->getEntityName(), 'c')
           ->innerJoin('c.article', 'a')
           ->where($qb->expr()->eq('c.idCmd', $commandesId));
        die(print_r($qb->getQuery()->getSQL(), true));
        return $qb->getQuery()->getArrayResult();
    }
} 