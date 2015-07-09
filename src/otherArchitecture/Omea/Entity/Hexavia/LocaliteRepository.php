<?php
namespace Omea\Entity\Hexavia;

use Doctrine\ORM\EntityRepository;

class LocaliteRepository extends EntityRepository
{
    /**
     * retrieves a city with two different approaches : exact, and approximation
     * exact is used when you need a final validation on a city
     * approximation is used when you need a list of possible cities
     *
     * @param $city
     * @param null $postCode
     * @param bool $exact
     * @return array
     */
    public function fetchCity($city = null, $postCode = null, $maxResult = 100)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('l')
            ->from($this->getEntityName(), 'l');

        //if a city is sepcified
        if ($city !== null) {
            $qb->andWhere($qb->expr()->eq('l.libelleAcheminement', ':city'));
            $qb->setParameter('city', $city);
        }

        //if a post code is specified
        if ($postCode !== null) {
            $qb->andWhere($qb->expr()->eq('l.codePostal', ':postCode'));
            $qb->setParameter('postCode', $postCode); //
        }
        if ($maxResult !== null) {
            $qb->setMaxResults($maxResult);
        }

        return $qb->getQuery()->getArrayResult();
    }

}