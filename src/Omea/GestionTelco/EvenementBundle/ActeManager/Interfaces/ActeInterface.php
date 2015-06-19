<?php
/**
 * Created by PhpStorm.
 * User: rserale
 * Date: 16/06/15
 * Time: 11:27
 */

namespace Omea\GestionTelco\EvenementBundle\ActeManager\Interfaces;

use Omea\GestionTelco\EvenementBundle\EvenementManager\Interfaces\EvenementInterface;

/**
 * Un acte de gestion
 */
interface ActeInterface
{

    /**
     * Prise en charge de l'évènement
     * @param  Evenement $evenement Un évènement
     * @return void
     */
    public function handle(EvenementInterface $evenement);
}