<?php

/**
 * Created by PhpStorm.
 * User: rserale
 * Date: 16/06/15
 * Time: 11:27.
 */
namespace Omea\GestionTelco\EvenementBundle\ActeManager;

/**
 * Un acte de gestion.
 */
interface ActeInterface
{
    /**
     * Prise en charge de l'évènement.
     *
     * @param Evenement $evenement Un évènement
     * @param int       $id_acte   l'acte concerné
     */
    public function handle(EvenementInterface $evenement, $idClient);
}
