<?php
namespace Omea\GestionTelco\EvenementsBundle\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

class IsValidTYPE extends Constraint
{
    public $message = 'The TYPE must be equal at "NOTIFICATION" ';

    public function validateBy()
    {
        return get_class($this).'Validator';
    }
}
