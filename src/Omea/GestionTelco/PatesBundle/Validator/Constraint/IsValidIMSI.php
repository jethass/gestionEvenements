<?php
namespace Omea\GestionTelco\PatesBundle\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

class IsValidIMSI extends Constraint
{
    public $message = 'The IMSI code must be composed by 15 digits';

    public function validateBy()
    {
        return get_class($this).'Validator';
    }
}
