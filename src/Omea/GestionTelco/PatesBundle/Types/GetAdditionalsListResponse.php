<?php
namespace Omea\GestionTelco\PatesBundle\Types;

use Omea\GestionTelco\PatesBundle\Types\Common\UserType;

class GetAdditionalsListResponse extends BaseResponse
{
    /**
     * @var array $userList
     */
    public $userList;
    
    /**
     * 
     * @var string
     */
    public $femtoActivationDate;

    /**
     * @param string $responseCode
     * @param array $userList
     * @param string $message
     */
    public function __construct($responseCode, $message, array $userList, $femtoActivationDate)
    {
        $this->userList = $userList;
        $this->femtoActivationDate = $femtoActivationDate;
        
        parent::__construct($responseCode, $message);
    }
}
