<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

/**
 */
class DiseServiceRepository extends EntityRepository
{

    /**
     * Recupere le faire use brut includs dans le forfait du client
     * @param  int $idClient
     * @return int $fairUse
     */
    public function GetFairUseInclusByClient($idClient)
    {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('ds.realValue')
        ->from($this->getEntityName(), 'ds')
        ->join('ds.forfaitOption','fo')
        ->join('Omea\\Entity\\Main\\StockMsisdn','sm', 'WITH','fo.idArt = sm.idArt' )
        ->where($qb->expr()
            ->eq('sm.idClient', ':idClient'))
        ->andWhere($qb->expr()
             ->eq('fo.inclus', '1'))
        ->andWhere($qb->expr()
              ->eq('ds.serviceType', ':serviceType'))

        ->setParameters(array(
            'idClient' => $idClient,
            'serviceType' => 'FAIRUSE'
        ));

        $result = $qb->getQuery()->getResult();

        if ($result) {
            return $result[0]['realValue'];
        } else {
            return null;
        }
    }

    /**
     * Recupere le faire use brut includs dans le forfait du client
     * @param  int $idClient
     * @return int $fairUse
     */
    public function GetFairUseRoamingInclusByClient($idClient)
    {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('ds.realValue')
        ->from($this->getEntityName(), 'ds')
        ->join('ds.forfaitOption','fo')
        ->join('Omea\\Entity\\Main\\StockMsisdn','sm', 'WITH','fo.idArt = sm.idArt' )
        ->where($qb->expr()
            ->eq('sm.idClient', ':idClient'))
        ->andWhere($qb->expr()
             ->eq('fo.inclus', '1'))
        ->andWhere($qb->expr()
              ->eq('ds.serviceType', ':serviceType'))

        ->setParameters(array(
            'idClient' => $idClient,
            'serviceType' => 'FAIRUSE_ROAMING'
        ));

        $result = $qb->getQuery()->getResult();

        if ($result) {
            return $result[0]['realValue'];
        } else {
            return null;
        }
    }

}
