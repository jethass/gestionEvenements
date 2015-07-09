<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

class MigrationInternetRepository extends EntityRepository
{

    /**
     * Recupere les forfaits compatible a la migration
     * 
     * @param string $refSap            
     * @return array forfaits
     */
    public function getForfaitMigration($refSap, $canal, $canalAcces)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select("f,a,rmf,fm")
            ->from($this->getEntityName(), 'fm')
            ->innerJoin('fm.forfaitCible', 'f')
            ->innerJoin('f.article', 'a')
            ->innerJoin('a.referentielMaterielsForfait', 'rmf')
            ->where($qb->expr()
                ->eq('fm.offreSource', ':refSap'))
            ->andWhere($qb->expr()
                ->eq('fm.canal', ':canal'))
            ->andWhere($qb->expr()
                ->in('rmf.canalAcces', $canalAcces));
        
        $qb->setParameters(array(
            'refSap'=> $refSap,
            'canal' => $canal
        ));
        
        return $qb->getQuery()->getArrayResult();
    }
}
