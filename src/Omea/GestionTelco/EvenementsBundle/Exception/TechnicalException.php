<?php
namespace Omea\GestionTelco\EvenementsBundle\Exception;

/**
 * This exception allow you to signal technical issues
 */
class TechnicalException extends \RuntimeException
{
    const TECHNICAL_EXCEPTION = 1000;
    const NUMABO_MSISDN = 1001;

    /**
     * @param string $message
     * @param integer $code
     * @param \Exception | null $previous
     */
    public function __construct($message, $code = TechnicalException::TECHNICAL_EXCEPTION, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
