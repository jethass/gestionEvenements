<?php
namespace Omea\GestionTelco\PortabilityBundle\Services;

use Psr\Log\LoggerInterface;
use Omea\GestionTelco\PortabilityBundle\Services\Queues\QueueInterface;

class MessageQueueService
{
    /** @var LoggerInterface */
    private $logger;

    /** @var array */
    private $config;

    private $queueList;

    /**
     * @param LoggerInterface $logger
     * @param array           $portabilityConfig
     */
    public function __construct(
        LoggerInterface $logger,
        array $portabilityConfig
    ) {
        $this->logger = $logger;
        $this->config = $portabilityConfig;
    }

    public function addQueue($queueId, QueueInterface $service)
    {
        $this->queueList[$queueId] = $service;
    }

    /**
     * @param string  $queue
     * @param integer $population
     * @param integer $modulo
     */
    public function process($queue, $population = 0, $modulo = 1)
    {
        // Fix parallelization parameters
        if (is_null($population) || !is_numeric($population)) {
            $population = 0;
        }
        if (is_null($modulo) || !is_numeric($modulo) || $modulo < 1) {
            $modulo = 1;
        }
        if ($population < 0 || $population >= $modulo) {
            $population = $population % $modulo;
        }

        if (!array_key_exists($queue, $this->queueList)) {
            throw new \Exception("Unknown queue '$queue'");
        }
        $this->logger->info(sprintf('Starting message queue for %s with population %d / %d', $queue, $population, $modulo));
        $i = 0;

        $oQueue = $this->queueList[$queue];
        try {
            $oQueue->prepare($population, $modulo);
        } catch (\Exception $e) {
            $result = sprintf('Queue %s cannot run : %s', $oQueue, $e->getMessage());
            $this->logger->warning($result);
            echo $result;
            return;
        }
        while (($queueItem = $oQueue->fetch()) !== false) {
            try {
                $oQueue->process($queueItem);
            } catch (\Exception $e) {
                $this->logger->error("{$e->getMessage()}");
            }
            $i++;
        }
        $result = sprintf('End of message queue for %s with population %d / %d - %d items processed', $oQueue, $population, $modulo, $i);
        $this->logger->info($result);
        echo $result;
    }
}
