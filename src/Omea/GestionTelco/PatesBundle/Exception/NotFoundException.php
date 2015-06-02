<?php
namespace Omea\GestionTelco\PatesBundle\Exception;

/**
 * This exception replace the HttpNotFoundException
 */
class NotFoundException extends \LogicException
{
    const NOT_FOUND_EXCEPTION = 2000;
    const MSISDN = 2001;
    const CLIENT = 2002;
    const ARTICLE = 2003;
    const NUM_ABO = 2004;
    const CLIENT_ACTIVE = 2005;
    const IMSI = 2006;
    const NSCE = 2007;
    const IMEI = 2008;

    /**
     * @param string $message
     * @param integer $code
     * @param \Exception | null $previous
     */
    public function __construct($message, $code = NotFoundException::NOT_FOUND_EXCEPTION, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
