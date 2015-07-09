<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

/**
 */
class OptionsGroupesRepository extends EntityRepository
{

    /**
     * Recupere l'option associe a l'option groupe
     *
     * @param int $idOptionGroup
     * @return int $idOption
     */
    public function GetIdOptionByOptionGroup($idClient, $idOptionGroup)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('og')
            ->from($this->getEntityName(), 'og')
            ->join('Omea\\Entity\\Main\\Options', 'o', 'WITH', 'o.idOption = og.idOptionFairuseBase or o.idOption = og.idOptionRoamingBase')
            ->join('o.forfaitOptions', 'fo', 'ON')
            ->join('Omea\\Entity\\Main\\StockMsisdn', 'sm', 'WITH', 'fo.idArt = sm.idArt')
            ->join('fo.diseService', 'ds')
            ->where($qb->expr()
                ->eq('fo.inclus', '1'))
            ->andWhere(
				$qb->expr()->orx(
					$qb->expr()->eq('ds.serviceType', ':fairuse'),
					$qb->expr()->eq('ds.serviceType', ':fairuseRoaming')
				)
			)
            ->andWhere($qb->expr()
                ->eq('og.optionGroup', ':idOptionGroup'))
            ->andWhere($qb->expr()
                ->eq('sm.idClient', ':idClient'))

            ->setParameters(array(
                'idClient' => $idClient,
                'idOptionGroup' => $idOptionGroup,
                'fairuse' => 'FAIRUSE',
				'fairuseRoaming' => 'FAIRUSE_ROAMING'
        ));

        $result = $qb->getQuery()->getResult();

        return $result;
    }
}
