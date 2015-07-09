<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

/**
 */
class ClientBloqueRepository extends EntityRepository
{

    public function isClientBloque($idClient)
    {
        return $this->clientHasLigne($idClient)
            ->andWhere('cb.dateBlocage IS NOT NULL')
            ->getQuery()
            ->getResult();
    }

    public function getLigne($idClient)
    {
        $result = $this->clientHasLigne($idClient)
            ->getQuery()
            ->getResult();
        if(sizeof($result)){
            return $result[0];
        }else{
            return false;
        } 
    }

    protected function clientHasLigne($idClient)
    {
        return $this->createQueryBuilder('cb')
            ->where('cb.idClient = :idClient')
            ->setParameter('idClient', $idClient)
            ->andWhere('cb.dateDeblocage IS NULL');
    }
}
