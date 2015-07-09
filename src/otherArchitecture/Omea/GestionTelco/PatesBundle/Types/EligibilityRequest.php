<?php
namespace Omea\GestionTelco\PatesBundle\Types;

class EligibilityRequest extends AbstractRequestType
{
    /**
     * Host phone number
     *
     * @var string
     */
    public $msisdn = '';

    /**
     * Flag for extended eligibility tests
     *
     * @var boolean
     */
    public $extendedTest;
}
