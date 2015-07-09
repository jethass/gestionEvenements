<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    /**
     * Get the article Sim from its SimType
     *
     * @param integer $idSimType
     *
     * @return array|ArrayCollection
     */
    public function findFromSimType($idSimType)
    {
        return $this->createQueryBuilder('a')
            ->innerJoin('a.simTypes', 'st')
            ->innerJoin('st.simFormats', 'sf')
            ->where('st.idSimType = :idSimType')
            ->setParameter('idSimType', $idSimType)
            ->getQuery()
            ->getResult();
    }

    public function getTypeEntiteByArticleId($idArticle)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('te.libelle, te.typeOffre')
           ->from($this->getEntityName(), 'a')
           ->innerJoin('a.typeEntite', 'te')
           ->where($qb->expr()->eq('a.idArticle', $idArticle));

        return $qb->getQuery()->getSingleResult();
    }

    /**
     * @param array $articles
     *
     * @return null|object
     */
    public function getForfaitsForArticles($articlesArray)
    {
        $forfaits = array();
        foreach ($articlesArray as $i=>$article) {
            $idArt = $article->getIdArticle();
            $qb->select('')
               ->from($this->getEntityName(), 'a')
               ->innerJoin('a.typeEntite', 'te')
               ->where($qb->expr()->eq('a.idArticle', $idArticle));
        }
    }
}
