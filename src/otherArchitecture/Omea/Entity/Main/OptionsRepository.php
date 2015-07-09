<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

/**
 */
class OptionsRepository extends EntityRepository
{
    /**
     * Recupere les forfaits compatible a la migration
     * @param integer $idArt
     * @return array forfaits
     */
    public function getOptionsFromForfait($idArt){
        $qb = $this->_em->createQueryBuilder();
        $qb->select("o,oi,fo")
        ->from($this->getEntityName(), 'o')
        ->innerJoin('o.forfaitOptions', 'fo')
        ->leftJoin('o.optionsIncompatible1', 'oi')
        ->where($qb->expr()->eq('fo.idArt', $idArt));
        
        return $qb->getQuery()->getArrayResult();
    }
}
