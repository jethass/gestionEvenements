<?php
/**
 * Created by PhpStorm.
 * User: smekkaoui
 * Date: 11/06/2015
 * Time: 15:16
 */

namespace Omea\Entity\Main;
use Doctrine\ORM\EntityRepository;

class OmdPnmOutRepository extends EntityRepository {

    /**
     * @param integer $msisdn
     * @param string $dateIas
     * @return bool
     */
    public function isPortaSortanteByMsisdn($msisdn, $dateIas)
    {
        $qb = $this->_em->createQueryBuilder();

        $qb
            ->select('o.idOpo')
            ->from($this->getEntityName(), "o")
            ->leftJoin('o.omdPnmIn', "i", "WITH", "i.codeRetour = 999 AND i.operation in ('ANR', 'IND')" )
            ->where("o.operation = 'ELI'")
            ->andWhere("o.emetteur = 'DD'")
            ->andWhere("o.codeRetour = 999")
            ->andwhere("i.msisdn is null")
            ->andwhere("o.msisdn = ".$msisdn)
            ->andwhere("o.datePortage > '".$dateIas."'")
        ;


        $result = $qb->getQuery()->getArrayResult();

        if($result && count($result)) {
            return true;
        }

        return false;
    }
}