<?php
namespace Omea\GestionTelco\PatesBundle\Types;

class SetAdditionalsListRequest extends AbstractRequestType
{
    /**
     * Host phone number
     *
     * @var string
     */
    public $msisdn = '';

    /**
     * @var array $userList
     */
    public $userList = '';
}
