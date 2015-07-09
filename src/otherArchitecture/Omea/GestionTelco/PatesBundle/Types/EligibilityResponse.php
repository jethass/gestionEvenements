<?php
namespace Omea\GestionTelco\PatesBundle\Types;

class EligibilityResponse extends BaseResponse
{

    /**
     * @var boolean
     */
    public $eligibility = '';

    /**
     * @param string $responseCode
     * @param string $message
     * @param boolean $eligibility
     */
    public function __construct($responseCode, $message, $eligibility)
    {
        $this->eligibility = $eligibility;

        parent::__construct($responseCode, $message);
    }
}
