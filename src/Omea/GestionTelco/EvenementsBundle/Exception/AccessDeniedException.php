<?php
namespace Omea\GestionTelco\EvenementsBundle\Exception;

/**
 * This exception replace the AccessDeniedException
 */
class AccessDeniedException extends \RuntimeException
{
    const ACCESS_DENIED_EXCEPTION = 3000;

    /**
     * @param string $message
     * @param integer $code
     * @param \Exception | null $previous
     */
    public function __construct($message, $code = AccessDeniedException::ACCESS_DENIED_EXCEPTION, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
