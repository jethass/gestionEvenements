<?php

namespace Omea\GestionTelco\EvenementBundle\Entity;
use Omea\GestionTelco\EvenementBundle\ActeManager\Interfaces\EvenementActesProviderInterface;
use Omea\GestionTelco\EvenementBundle\EvenementManager\Interfaces\Acte;
use Omea\GestionTelco\EvenementBundle\EvenementManager\Interfaces\GestionEvenementErreurRepositoryInterface;

/**
 * GestionEvenementErreurRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GestionEvenementErreurRepository extends \Doctrine\ORM\EntityRepository implements EvenementActesProviderInterface
{
    /**
     * Retourne un tableau d'actes ordonnés par leur poids à partir d'un identifiant événement
     *
     * @param  string $codeEvenement [description]
     * @return [type]                [description]
     */
    public function findActesByEvenementId($evenementId)
    {

       $result = $this->createQueryBuilder('gee')
           ->join('gee.evenement', 'e')
           ->where('e.idEvenement = :idEvenement')
           ->setParameter('idEvenement', $evenementId)
           ->getQuery()
           ->getSingleResult();

        return  $result->getTrame();
    }


}
