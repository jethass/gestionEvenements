<?php
namespace Omea\GestionTelco\PortabilityBundle\Services;

use Psr\Log\LoggerInterface;
use Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilityActivityRequest;
use Omea\GestionTelco\PortabilityBundle\Types\WS\IncomingPortabilityCreationRequest;
use Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilityCancellationRequest;
use Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilityAcknowledgementRequest;
use Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilityBaseResponse;
use Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilityActivityResponse;
use Omea\GestionTelco\PortabilityBundle\Types\WS\IncomingPortabilityCreationResponse;
use Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilitySoapFault;

class IncomingPortabilityWebService
{
    /** @var array */
    protected $config;

    /** @var LoggerInterface */
    protected $logger;

    /** @var IncomingPortabilityService */
    protected $porta;

    /**
     * @param LoggerInterface            $logger
     * @param array                      $config
     * @param IncomingPortabilityService $porta
     */
    public function __construct(LoggerInterface $logger,
                                array $config,
                                IncomingPortabilityService $porta)
    {
        $this->logger = $logger;
        $this->config = $config;
        $this->porta = $porta;
    }
    
    /** Checks whether there is already an active portability
     * @param  Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilityActivityRequest  $request
     * @return Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilityActivityResponse
     * @throws Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilitySoapFault
     */
    public function incomingPortabilityExists(PortabilityActivityRequest $request)
    {
        try {
            $response = new PortabilityActivityResponse();
            $response->activity = $this->porta->checkActiveIncomingPortability($request->msisdn);
            return $response;
        } catch (\Exception $e) {
            throw new PortabilitySoapFault('Server', $e->getMessage());
        }
    }

    /** Initializes an incoming portability
     * @param  Omea\GestionTelco\PortabilityBundle\Types\WS\IncomingPortabilityCreationRequest  $request
     * @return Omea\GestionTelco\PortabilityBundle\Types\WS\IncomingPortabilityCreationResponse
     * @throws Omea\GestionTelco\PortabilityBundle\Types\WS\PortabilitySoapFault
     */
    public function createIncomingPortability(IncomingPortabilityCreationRequest $request)
    {
        try {
            $response = new IncomingPortabilityCreationResponse();
            $response->idPortage = $this->porta->createIncomingPortability($request->idClient, $request->msisdn, $request->rio, $request->dateDemande, $request->datePortage, $request->tranche);
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
    public function cancelIncomingPortability(PortabilityCancellationRequest $request)
    {
        try {
            $response = new PortabilityBaseResponse();
            $response->idPortage = $this->porta->cancelIncomingPortability($request->idPortage);
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
    public function acknowledgeIncomingPortability(PortabilityAcknowledgementRequest $request)
    {
        try {
            $response = new PortabilityBaseResponse();
            $ok = $this->porta->acknowledgeIncomingPortability($request->idPortage, $request->anomalyCode);
            return $response;
        } catch (\Exception $e) {
            throw new PortabilitySoapFault('Server', $e->getMessage());
        }
    }
}
