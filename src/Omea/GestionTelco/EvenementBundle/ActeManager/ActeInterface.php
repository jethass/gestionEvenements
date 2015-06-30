<?php
/**
 * Created by PhpStorm.
 * User: rserale
 * Date: 16/06/15
 * Time: 11:27
 */

namespace Omea\GestionTelco\EvenementBundle\ActeManager;

use Omea\GestionTelco\EvenementBundle\ActeManager\EvenementInterface;

/**
 * Un acte de gestion
 */
interface ActeInterface
{

    /**
     * Prise en charge de l'évènement
     * @param  Evenement $evenement Un évènement
     * @param  integer $id_acte l'acte concerné
     * @return void
     */
    public function handle(EvenementInterface $evenement, $id_acte);
}