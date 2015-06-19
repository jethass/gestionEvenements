<?php
/**
 * Created by PhpStorm.
 * User: rserale
 * Date: 16/06/15
 * Time: 11:33
 */

namespace Omea\GestionTelco\EvenementBundle\ActeManager\Interfaces;


interface ActeDefinitionRepositoryInterface
{
    /**
     * retourne un tableau de définition d'actes ordonné par leur poids
     * @param  string $codeEvenement [description]
     * @return [type]                [description]
     */
    public function findActesByCodeEvenement($codeEvenement);
}