<?php

/**
 * Created by PhpStorm.
 * User: rserale
 * Date: 16/06/15
 * Time: 11:30.
 */
namespace Omea\GestionTelco\EvenementBundle\ActeManager;

use Omea\GestionTelco\EvenementBundle\ActeManager\ActeOptionsInterface;

/**
 * Indique que l'acte est configurable.
 */
interface ConfigurableActeInterface
{
    /**
     * Le nom de la class.
     *
     * @return [type] [description]
     */
    public function getOptionsClassname();

    /**
     * Passe la class contenant les options de l'acte.
     *
     * @param ActeOptionsInterface $options
     */
    public function setOptions(ActeOptionsInterface $options);

    /**
     * Valide les options.
     *
     * @return array Un tableau d'erreur
     */
    public function validateOptions();
}
