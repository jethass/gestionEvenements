<?php
namespace Omea\GestionTelco\PatesBundle\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

class IsValidIMEI extends Constraint
{
    public $message = 'The device IMEI must contain 15 digits';

    public function validateBy()
    {
        return get_class($this) . 'Validator';
    }
}
