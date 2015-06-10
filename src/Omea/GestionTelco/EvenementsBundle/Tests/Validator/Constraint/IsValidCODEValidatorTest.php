<?php
namespace Omea\GestionTelco\EvenementsBundle\Tests\Validator\Constraint;

use Symfony\Component\Validator\Tests\Constraints\AbstractConstraintValidatorTest;
use Symfony\Component\Validator\Validation;

use Omea\GestionTelco\EvenementsBundle\Validator\Constraint\IsValidCODE;
use Omea\GestionTelco\EvenementsBundle\Validator\Constraint\IsValidCODEValidator;

class IsValidCODEValidatorTest extends AbstractConstraintValidatorTest
{
    protected function getApiVersion()
    {
        return Validation::API_VERSION_2_5;
    }

    protected function createValidator()
    {
        return new IsValidCODEValidator();
    }

    /**
     * @dataProvider getValidElements
     */
    public function testValidateOk($value)
    {
        $constraint = new IsValidCODE();
        $this->validator->validate($value, $constraint);
        $this->assertNoViolation();
    }

    /**
     * @dataProvider getInvalidElements
     */
    public function testValidateFail($value)
    {
        $constraint = new IsValidCODE();
        $this->validator->validate($value, $constraint);
        $this->buildViolation('The CODE must be composed by 10 caracters')
            ->setParameter('%string%', $value)
            ->assertRaised();
    }

    public function getValidElements()
    {
        return array(
            array('codetest01'),
            array('codetest02'),
            array('codetest03'),
            array('codetest04')
        );
    }

    public function getInvalidElements()
    {
        return array(
            array('codetest'),
            array('fail'),
            array('------'),
            array('codetestfaiiiiiiiiiil')
        );
    }
}
