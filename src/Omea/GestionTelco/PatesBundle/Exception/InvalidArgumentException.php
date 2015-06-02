<?php
namespace Omea\GestionTelco\PatesBundle\Exception;

use \InvalidArgumentException as PHPInvalidArgumentException;

/**
 * This exception replace the InvalidArgumentException
 */
class InvalidArgumentException extends PHPInvalidArgumentException
{
    const INVALID_ARGUMENT_EXCEPTION = 4000;

    /**
     * @param string $message
     * @param integer $code
     * @param \Exception | null $previous
     */
    public function __construct(
        $message,
        $code = InvalidArgumentException::INVALID_ARGUMENT_EXCEPTION,
        $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
