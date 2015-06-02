<?php
namespace Omea\GestionTelco\EvenementsBundle\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

class IsValidCODE extends Constraint
{
    public $message = 'The CODE must be composed by 10 caracters';

    public function validateBy()
    {
        return get_class($this).'Validator';
    }
}
