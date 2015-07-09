<?php
namespace Omea\GestionTelco\PatesBundle\Tests\Validator\Constraint;

use Symfony\Component\Validator\Tests\Constraints\AbstractConstraintValidatorTest;
use Symfony\Component\Validator\Validation;

use Omea\GestionTelco\PatesBundle\Validator\Constraint\IsValidIMSI;
use Omea\GestionTelco\PatesBundle\Validator\Constraint\IsValidIMSIValidator;

class IsValidIMSIValidatorTest extends AbstractConstraintValidatorTest
{
    protected function getApiVersion()
    {
        return Validation::API_VERSION_2_5;
    }

    protected function createValidator()
    {
        return new IsValidIMSIValidator();
    }

    /**
     * @dataProvider getValidElements
     */
    public function testValidateOk($value)
    {
        $constraint = new IsValidIMSI();
        $this->validator->validate($value, $constraint);
        $this->assertNoViolation();
    }

    /**
     * @dataProvider getInvalidElements
     */
    public function testValidateFail($value)
    {
        $constraint = new IsValidIMSI();
        $this->validator->validate($value, $constraint);
        $this->buildViolation('The IMSI code must be composed by 15 digits')
            ->setParameter('%string%', $value)
            ->assertRaised();
    }

    public function getValidElements()
    {
        return array(
            array('000000000000000'),
            array('012345678901234'),
            array('111111111111111'),
            array('999999999999999')
        );
    }

    public function getInvalidElements()
    {
        return array(
            array('00000000000000'),
            array('fail'),
            array('------'),
            array('9999999999999999999999')
        );
    }
}
