<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

class ForfaitRepository extends EntityRepository
{
     /**
     * Recupere le forfaits du client
     * @param string $refSap
     * @return forfait
     */
    public function getForfaitAdsl($refSap)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select("f,rmf,a")
        ->from($this->getEntityName(), 'f')
        ->innerJoin('f.article', 'a')
        ->innerJoin('a.referentielMaterielsForfait', 'rmf')
        ->where($qb->expr()->eq('f.refSap', ':refSap'));

        $qb->setParameter('refSap', $refSap);
//         echo $qb->getQuery()->getSql();
        return $qb->getQuery()->getArrayResult();
    }

    /**
     * Récupère le forfait du client en fonction de la refSap et du canal d'accés
     * pour la récuparation du matériel associé.
     * @param string $refSap
     * @param string $canalAcces
     */
    public function getForfaitByOffreCible($refSap, $canalAcces)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select("f,rmf,a")
        ->from($this->getEntityName(), 'f')
        ->innerJoin('f.article', 'a')
        ->innerJoin('a.referentielMaterielsForfait', 'rmf')
        ->where($qb->expr()
            ->eq('f.refSap', ':refSap'))
            ->andWhere($qb->expr()->in('rmf.canalAcces', $canalAcces));

        $qb->setParameters(array('refSap'=> $refSap));

        return $qb->getQuery()->getArrayResult()[0];
    }
}
