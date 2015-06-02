<?php
namespace Omea\GestionTelco\EvenementsBundle\Validator\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsValidTYPEValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value!= "NOTIFICATION") {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }
}
