<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\External;

use Psr\Log\LoggerInterface;

class GenericStubService
{
    /** @var LoggerInterface */
    private $logger;

    /** @var array */
    private $config;

    /**
     * @param LoggerInterface $logger
     * @param array           $portabilityConfig
     */
    public function __construct(LoggerInterface $logger, array $portabilityConfig)
    {
        $this->logger = $logger;
        $this->config = $portabilityConfig;
    }
}
