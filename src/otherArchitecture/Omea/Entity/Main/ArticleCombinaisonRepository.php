<?php
/**
 * Created by PhpStorm.
 * User: blegrand
 * Date: 09/09/14
 * Time: 17:53
 */

namespace Omea\Entity\Main;


use Doctrine\ORM\EntityRepository;

class ArticleCombinaisonRepository extends EntityRepository{
    /**
     * Retourne un tableau listant l'ensemble des articles fils associés à
     * l'article père.
     *
     * @param $articlePereId
     *
     * @return array
     */
    public function getArticlesFilsFromArticlePereId($articlePereId){
        $qb = $this->_em->createQueryBuilder();
        $qb->select("ac.idArtFils")
           ->from($this->getEntityName(), 'ac')
           ->where($qb->expr()->eq('ac.idArtPere', $articlePereId));

        return $qb->getQuery()->getArrayResult();
    }

    /**
     * Retourne le forfait lie a un article pere
     * l'article père.
     *
     * @param $articlePereId
     *
     * @return array
     */
    public function getForfaitFromArticle($articlePereId){
        $qb = $this->_em->createQueryBuilder();
        $qb->select("ac.idArtFils")
        ->from($this->getEntityName(), 'ac')
        ->innerJoin('ac.article', 'a')
        ->innerJoin('a.forfait', 'f')
        ->where($qb->expr()->eq('ac.idArtPere', $articlePereId))
        ->setMaxResult(1);

        return $qb->getQuery()->getOneOrNullResult();
    }
}