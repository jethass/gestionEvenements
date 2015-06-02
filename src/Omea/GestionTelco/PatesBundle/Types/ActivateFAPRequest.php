<?php
namespace Omea\GestionTelco\PatesBundle\Types;

class ActivateFAPRequest extends AbstractRequestType
{
    /**
     * Host phone number
     *
     * @var string
     */
    public $msisdn = '';

    /**
     * Device imei number
     *
     * @var string
     */
    public $imei = '';
}
