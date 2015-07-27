<?php
namespace Omea\GestionTelco\PortabilityBundle\Services;

use Psr\Log\LoggerInterface;
use Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilityActivityRequest;
use Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilityCancellationRequest;
use Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilityAcknowledgementRequest;
use Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilityBaseResponse;
use Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilityActivityResponse;
use Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilitySoapFault;

class OutgoingPortabilityWebService
{
    /** @var array */
    protected $config;

    /** @var LoggerInterface */
    protected $logger;

    /** @var OutgoingPortabilityService */
    protected $porta;

    /**
     * @param LoggerInterface            $logger
     * @param array                      $config
     * @param IncomingPortabilityService $porta
     */
    public function __construct(LoggerInterface $logger,
                                array $config,
                                OutgoingPortabilityService $porta)
    {
        $this->logger = $logger;
        $this->config = $config;
        $this->porta = $porta;
    }
    
    /** Checks whether there is already an active outgoing portability
     * @param  Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilityActivityRequest  $request
     * @return Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilityActivityResponse
     * @throws Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilitySoapFault
     */
    public function outgoingPortabilityExists(PortabilityActivityRequest $request)
    {
        try {
            $response = new PortabilityActivityResponse();
            $response->activity = $this->porta->checkActiveOutgoingPortability($request->msisdn);
            return $response;
        } catch (\Exception $e) {
            throw new PortabilitySoapFault('Server', $e->getMessage());
        }
    }

    /** Cancel an incoming portability
     * @param  Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilityCancellationRequest $request
     * @return Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilityBaseResponse
     * @throws Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilitySoapFault
     */
    public function cancelOutgoingPortability(PortabilityCancellationRequest $request)
    {
        try {
            $response = new PortabilityBaseResponse();
            $response->idPortage = $this->porta->cancelOutgoingPortability($request->idPortage);
            return $response;
        } catch (\Exception $e) {
            throw new PortabilitySoapFault('Server', $e->getMessage());
        }
    }

    /** Initializes an incoming portability
     * @param  Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilityAcknowledgementRequest $request
     * @return Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilityBaseResponse
     * @throws Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilitySoapFault
     */
    public function acknowledgeOutgoingPortability(PortabilityAcknowledgementRequest $request)
    {
        try {
            $response = new PortabilityBaseResponse();
            $ok = $this->porta->acknowledgeOutgoingPortability($request->idPortage, $request->anomalyCode);
            return $response;
        } catch (\Exception $e) {
            throw new PortabilitySoapFault('Server', $e->getMessage());
        }
    }
}
