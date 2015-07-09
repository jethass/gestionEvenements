<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

class ForfaitRemisePrepaiementRepository extends EntityRepository
{
    /**
     * @param $idArt
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findEligiblePlansByArtId($idArt)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('frp')
            ->from($this->getEntityName(), 'frp')
            ->innerJoin('frp.article', 'a')
            ->innerJoin('frp.option', 'o')
            ->innerJoin('o.forfaitOptions', 'fo')
            ->andWhere($qb->expr()->eq('a.idArticle', ':artId'))
            ->andWhere($qb->expr()->eq('fo.actif', 1))
            ;
        $qb->setParameter('artId', $idArt);

        return $qb->getQuery()->getResult();
    }

}
