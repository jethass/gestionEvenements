<?php

namespace Omea\Entity\Hexavia;

use Doctrine\ORM\EntityRepository;

/**
 * AdresseReposutory
 *
 */
class AdresseRepository extends EntityRepository
{
    /**
     * retrieves an address with two different approaches : exact, and approximation
     * exact is used when you need a final validation on a street name
     * approximation is used when you need a list of possible streets.
     *
     * @param $inseeCode
     * @param  null  $lastElemStreetName
     * @param  null  $streetName
     * @param  bool  $exact
     * @param  int   $maxResults
     * @return array
     */
    public function fetchAddress($inseeCode, $lastElemStreetName = null, $streetName = null, $exact = false, $maxResults = 100)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('a')
            ->from($this->getEntityName(), 'a')
            ->where($qb->expr()->eq('a.codeInseeLocalite', ':inseeCode'))
            ->setParameter('inseeCode', $inseeCode); //

        if ($lastElemStreetName !== null) {
            $qb->andWhere($qb->expr()->eq('a.dernierElementVoie', ':lastElemStreetName'));
            $qb->setParameter('lastElemStreetName', $lastElemStreetName); //
        }

        if ($streetName !== null && $exact) { //check directly on the street name field
            $qb->andWhere($qb->expr()->eq('a.libelleVoie', ':streetName'));
            $qb->setParameter('streetName', $streetName);
        } elseif ($streetName !== null) { //check with like
            $qb->andWhere($qb->expr()->like('a.libelleVoie', ':streetName'));
            $qb->setParameter('streetName', '%' . $streetName . '%');
        }

        if ($maxResults !== null) {
            $qb->setMaxResults($maxResults);
        }

        return $qb->getQuery()->getArrayResult();
    }

    public function fetchPhoneticAddress($inseeCode, $lastPhoneticP, $streetName = null, $maxResults = 100)
    {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('a')
            ->from($this->getEntityName(), 'a')
            ->where($qb->expr()->eq('a.codeInseeLocalite', ':inseeCode'))
            ->setParameter('inseeCode', $inseeCode); //

        $qb->andWhere($qb->expr()->eq('a.dernierPhonetiqueP', ':lastPhoneticP'));
        $qb->setParameter('lastPhoneticP', $lastPhoneticP);

        if ($streetName !== null) {
            $qb->andWhere($qb->expr()->like('a.libelleVoie', ':streetName'));
            $qb->setParameter('streetName', '%' . $streetName . '%');
        }
        if ($maxResults !== null) {
            $qb->setMaxResults($maxResults);
        }

        return $qb->getQuery()->getArrayResult();
    }

}
