<?php
namespace Omea\GestionTelco\PatesBundle\Types;

class ChangeImsiRequest extends AbstractRequestType
{
    /**
     * Host phone number
     *
     * @var string
     */
    public $msisdn = '';

    /**
     * New SIM number
     *
     * @var string
     */
    public $newImsi = '';
}
