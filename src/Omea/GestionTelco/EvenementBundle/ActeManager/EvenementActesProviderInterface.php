<?php
/**
 * Created by PhpStorm.
 * User: rserale
 * Date: 16/06/15
 * Time: 11:33
 */

namespace Omea\GestionTelco\EvenementBundle\ActeManager;

/**
 * Interface EvenementActesProviderInterface
 *
 * @package Omea\GestionTelco\EvenementBundle\ActeManager\Interfaces
 */
interface EvenementActesProviderInterface
{
    /**
     * Retourne un tableau d'actes ordonnés par leur poids à partir d'un identifiant événement
     *
     * @param  string $codeEvenement [description]
     * @return [type]                [description]
     */
    public function findActesByEvenementId($evenementId);
}