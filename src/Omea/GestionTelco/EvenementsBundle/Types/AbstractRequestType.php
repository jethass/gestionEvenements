<?php
namespace Omea\GestionTelco\EvenementsBundle\Types;

abstract class AbstractRequestType
{
    public function __toString()
    {
        return print_r($this, true);
    }
}
