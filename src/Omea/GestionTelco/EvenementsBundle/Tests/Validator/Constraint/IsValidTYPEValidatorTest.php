<?php
namespace Omea\GestionTelco\EvenementsBundle\Tests\Validator\Constraint;

use Symfony\Component\Validator\Tests\Constraints\AbstractConstraintValidatorTest;
use Symfony\Component\Validator\Validation;

use Omea\GestionTelco\EvenementsBundle\Validator\Constraint\IsValidTYPE;
use Omea\GestionTelco\EvenementsBundle\Validator\Constraint\IsValidTYPEValidator;

class IsValidTYPEValidatorTest extends AbstractConstraintValidatorTest
{
    protected function getApiVersion()
    {
        return Validation::API_VERSION_2_5;
    }

    protected function createValidator()
    {
        return new IsValidTYPEValidator();
    }

    /**
     * @dataProvider getValidElements
     */
    public function testValidateOk($value)
    {
        $constraint = new IsValidTYPE();
        $this->validator->validate($value, $constraint);
        $this->assertNoViolation();
    }

    /**
     * @dataProvider getInvalidElements
     */
    public function testValidateFail($value)
    {
        $constraint = new IsValidTYPE();
        $this->validator->validate($value, $constraint);
        $this->buildViolation('The TYPE must be equal at "NOTIFICATION')
            ->setParameter('%string%', $value)
            ->assertRaised();
    }

    public function getValidElements()
    {
        return array(
            array('NOTIFICATION')           
        );
    }

    public function getInvalidElements()
    {
        return array(
            array('NOTIFICATIONXXX'),
            array('fail'),
            array('------'),
            array('NOTIFICATIONXXXL')
        );
    }
}
