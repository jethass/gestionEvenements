<?php
/**
 * Created by PhpStorm.
 * User: rserale
 * Date: 22/06/15
 * Time: 15:09
 */

namespace Omea\GestionTelco\EvenementBundle\ActeManager\DTO;


use Omea\GestionTelco\EvenementBundle\ActeManager\ActeDefinitionInterface;

class ActeDefinition implements ActeDefinitionInterface
{

    private $name;

    private $options;

    /**
     * @param string $name
     * @param string $options
     */
    function __construct($name, $options)
    {
        $this->name = $name;
        $this->options = $options;
    }


    /**
     * Nom de l'option
     * @return [type] [description]
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Options de l'acte sérialisé
     * @return string
     */
    public function getOptions()
    {
        return $this->options;
    }

}