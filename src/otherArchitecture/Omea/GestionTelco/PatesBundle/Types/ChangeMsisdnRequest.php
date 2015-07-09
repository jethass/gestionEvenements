<?php
namespace Omea\GestionTelco\PatesBundle\Types;

class ChangeMsisdnRequest extends AbstractRequestType
{
    /**
     * Old host phone number
     *
     * @var string
     */
    public $oldMsisdn = '';

    /**
     * New host phone number
     *
     * @var string
     */
    public $newMsisdn = '';
}
