<?php
/**
 * Created by PhpStorm.
 * User: rserale
 * Date: 16/06/15
 * Time: 11:32
 */

namespace Omea\GestionTelco\EvenementBundle\ActeManager\Interfaces;


interface ActeDefinitionInterface
{
    /**
     * Nom de l'option
     * @return [type] [description]
     */
    public function getName();

    /**
     * Options de l'acte s�rialis�
     * @return string
     */
    public function getOptions();
}
