<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

/**
 */
class PassClientRepository extends EntityRepository
{

    public function nbPassClientActif($idClient,$idPass)
    {
        $date = new \DateTime();

        $qb = $this->_em->createQueryBuilder();
        $qb->select('COUNT(pc.idPass) AS nbPassClient')
           ->from($this->getEntityName(), 'pc')
           ->where($qb->expr()
                ->eq('pc.idClient', ':idClient'))
            ->andWhere($qb->expr()
                ->eq('pc.idPass', ':idPass'))
            ->andWhere($qb->expr()
                ->lte('pc.dateDemande', ':date'))
            ->andWhere($qb->expr()
                ->gte('pc.dateFin', ':date'))
            ->andWhere($qb->expr()
                    ->eq('pc.codeRetour', '0'))
            ->groupBy('pc.idClient')

        ->setParameters(array(
            'idClient' => $idClient,
            'idPass' => $idPass,
            'date' => $date
        ));
        $result = $qb->getQuery()->getResult();
        if (sizeof($result)) {
            return $result[0]['nbPassClient'];
        } else {
            return 0;
        }
    }

    public function PassClientActif($idClient)
    {
        $date = new \DateTime();

        $qb = $this->_em->createQueryBuilder();
        $qb->select('pc')
        ->from($this->getEntityName(), 'pc')
        ->where($qb->expr()
            ->eq('pc.idClient', ':idClient'))
        ->andWhere($qb->expr()
            ->lte('pc.dateDemande', ':date'))
        ->andWhere($qb->expr()
            ->gte('pc.dateFin', ':date'))
        ->andWhere($qb->expr()
            ->eq('pc.codeRetour', '0'))

        ->setParameters(array('idClient' => $idClient, 'date' => $date));

        return $qb->getQuery()->getResult();
    }
}
