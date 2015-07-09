<?php
namespace Omea\GestionTelco\PatesBundle\Types;

class CreateOrderRequest extends AbstractRequestType
{
    /**
     * Host phone number
     *
     * @var string
     */
    public $msisdn = '';

    /**
     * Application code (crm, selfcare,...)
     *
     * @var string
     */
    public $canal = '';
}
