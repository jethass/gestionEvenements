<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\Queues;

use Psr\Log\LoggerInterface;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Statement;
use Omea\GestionTelco\PortabilityBundle\Services\MessagingService;

abstract class AbstractQueue
{
    /** @var array */
    protected $config;

    /** @var LoggerInterface */
    protected $logger;

    /** @var Connection */
    protected $mainDb;

    /** @var MessagingService */
    protected $messaging;

    /** @var Statement */
    protected $statement = null;

    /**
     * @param LoggerInterface  $logger
     * @param array            $config
     * @param MessagingService $messaging
     * @param Connection       $mainDb
     */
    public function __construct(LoggerInterface $logger,
                                array $config,
                                MessagingService $messaging,
                                Connection $mainDb)
    {
        $this->logger = $logger;
        $this->config = $config;
        $this->messaging = $messaging;
        $this->mainDb = $mainDb;
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
