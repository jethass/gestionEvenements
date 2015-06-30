<?php

namespace Omea\GestionTelco\EvenementBundle\ActeManager;

/**
* Repository
*/
interface GestionEvenementErreurRepositoryInterface
{
/**
* Retourne la liste ordonnée des actes restant à éxécuter pour un événement
*
* @return  Acte[]
*/
public function findActeRestantByEvenementId($evenementId);
}