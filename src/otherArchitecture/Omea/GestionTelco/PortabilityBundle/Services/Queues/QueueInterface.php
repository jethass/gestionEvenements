<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\Queues;

interface QueueInterface
{
    /**
     * @param int $population
     * @param int $modulo
     */
    public function prepare($population, $modulo);

    public function fetch();

    public function process(array $queueItem);
}
