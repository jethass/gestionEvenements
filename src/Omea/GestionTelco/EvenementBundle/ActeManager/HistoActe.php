<?php
/**
 * Created by PhpStorm.
 * User: rserale
 * Date: 18/06/15
 * Time: 12:04
 */

namespace Omea\GestionTelco\EvenementBundle\ActeManager;

use Omea\GestionTelco\EvenementBundle\ActeManager\Interfaces\ActeInterface;
use Omea\GestionTelco\EvenementBundle\EvenementManager\Interfaces\EvenementInterface;


class HistoActe implements ActeInterface
{
    public function handle(EvenementInterface $evenement)
    {
        printf("Je pose un histo pour le %s\n", $evenement->getMsisdn());
    }
}