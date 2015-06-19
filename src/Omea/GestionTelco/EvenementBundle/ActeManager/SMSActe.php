<?php
/**
 * Created by PhpStorm.
 * User: rserale
 * Date: 16/06/15
 * Time: 16:57
 */

namespace Omea\GestionTelco\EvenementBundle\ActeManager;
use Omea\GestionTelco\EvenementBundle\ActeManager\Interfaces\ActeInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\Interfaces\ConfigurableActeInterface;
use Omea\GestionTelco\EvenementBundle\EvenementManager\Interfaces\EvenementInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\Interfaces\ActeOptionsInterface;

/**
 * Exemple d'acte configurable
 */
class SMSActe implements ActeInterface, ConfigurableActeInterface
{
    private $options;

    public function handle(EvenementInterface $evenement)
    {
        printf(
            "J'envoi un sms (code:%d) pour le %s\n",
            $this->options->code,
            $evenement->getMsisdn()
        );
    }

    public function getOptionsClassname()
    {
        return 'SMSActeOptions';
    }

    public function setOptions(ActeOptionsInterface $options)
    {
        $this->options = $options;
    }

    public function validateOptions()
    {
        return array();
    }
}