<?php
namespace Omea\GestionTelco\EvenementsBundle\Validator\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsValidCODEValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (strlen($value) != 10) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }
}
