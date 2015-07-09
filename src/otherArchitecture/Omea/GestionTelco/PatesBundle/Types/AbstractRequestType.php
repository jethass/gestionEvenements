<?php
namespace Omea\GestionTelco\PatesBundle\Types;

abstract class AbstractRequestType
{
    public function __toString()
    {
        return print_r($this, true);
    }
}
