<?php
namespace Omea\GestionTelco\PatesBundle\Types;

class CancellationRequest extends AbstractRequestType
{
    /**
     * Host phone number
     *
     * @var string
     */
    public $msisdn = '';
}
