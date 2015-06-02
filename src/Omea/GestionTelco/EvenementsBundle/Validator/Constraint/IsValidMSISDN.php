<?php
namespace Omea\GestionTelco\EvenementsBundle\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

class IsValidMSISDN extends Constraint
{
    public $message = 'The MSISDN must be composed by 10 digits';

    public function validateBy()
    {
        return get_class($this).'Validator';
    }
}
