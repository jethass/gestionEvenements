<?php

/**
 * Created by PhpStorm.
 * User: rserale
 * Date: 18/06/15
 * Time: 11:25.
 */
namespace Omea\Entity\GestionEvenements;

use Omea\GestionTelco\EvenementBundle\ActeManager\EvenementRepositoryInterface;

class EvenementRepository extends \Doctrine\ORM\EntityRepository implements EvenementRepositoryInterface
{
}
