<?php
namespace Omea\GestionTelco\PatesBundle\Exception;

/**
 * This exception replace the HttpNotFoundException
 */
class EligibilityException extends \LogicException
{
    const CLIENT_NOT_ELIGIBLE = 5000;
    const CLIENT_NOT_AUTHORIZED = 5100;
    const CLIENT_NOT_FULL_MVNO = 5200;
    const FEMTO_ALREADY_ACTIVE = 5300;
    const FEMTO_OPTION_ACTIVE = 5400;
    const CLIENT_STATUS_INACTIVE = 5500;
    const CLIENT_LIABLE = 5600;
    const CLIENT_TERMINATED = 5700;

    /**
     * @param string $message
     * @param integer $code
     * @param \Exception | null $previous
     */
    public function __construct($message, $code = EligibilityException::CLIENT_NOT_ELIGIBLE, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
