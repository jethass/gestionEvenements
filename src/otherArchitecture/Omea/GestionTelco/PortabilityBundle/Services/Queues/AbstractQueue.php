<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\Queues;

use Psr\Log\LoggerInterface;
use Doctrine\DBAL\Statement;
use Omea\GestionTelco\PortabilityBundle\Services\MessagingService;
use Omea\GestionTelco\PortabilityBundle\Services\MainRepositoryService;

abstract class AbstractQueue
{
    /** @var array */
    protected $config;

    /** @var LoggerInterface */
    protected $logger;

    /** @var MainRepositoryService */
    protected $main;

    /** @var MessagingService */
    protected $messaging;

    /** @var Statement */
    protected $statement = null;

    /**
     * @param LoggerInterface       $logger
     * @param array                 $config
     * @param MessagingService      $messaging
     * @param MainRepositoryService $main
     */
    public function __construct(LoggerInterface $logger,
                                array $config,
                                MessagingService $messaging,
                                MainRepositoryService $main)
    {
        $this->logger = $logger;
        $this->config = $config;
        $this->messaging = $messaging;
        $this->main = $main;
    }

    public function fetch()
    {
        return $this->statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function __toString()
    {
        return get_class($this);
    }
}
