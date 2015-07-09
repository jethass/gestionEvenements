<?php
namespace Omea\GestionTelco\PatesBundle\Types;

class GetAdditionalsListRequest extends AbstractRequestType
{
    /**
     * Host phone number
     *
     * @var string
     */
    public $msisdn = '';
}
