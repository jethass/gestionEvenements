<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\External;

use Psr\Log\LoggerInterface;
use SoapClientBundle\Services\SoapClientService;

abstract class GenericProxyService
{
    /** @var LoggerInterface */
    private $logger;

    /** @var array */
    private $config;

    /** @var SoapClientService */
    private $soapClient;

    /** @var string */
    private $serviceUrl;

    /**
     * @param LoggerInterface   $logger
     * @param array             $portabilityConfig
     * @param SoapClientService $soapClient
     * @param string            $serviceUrl
     */
    public function __construct(
        LoggerInterface $logger,
        array $portabilityConfig,
        SoapClientService $soapClient,
        $serviceUrl
    ) {
        $this->logger = $logger;
        $this->config = $portabilityConfig;
        $this->soapClient = $soapClient;
        $this->serviceUrl = $serviceUrl;
    }

    /** Initializes the proxy's method calling (for legacy services)
     * (should be called at the start of every method call, as the SOAP service may be shared with other proxies)
     * @param string $method
     */
    protected function setLegacyMethod($method)
    {
        $this->soapClient->setPathWsdl($this->serviceUrl . '?wsdl');
        $this->soapClient->setOptions('location', $this->serviceUrl);
        $this->soapClient->setServiceName($method);
    }

    /** Initializes the proxy's method calling
     * (should be called at the start of every method call, as the SOAP service may be shared with other proxies)
     * @param string $method
     */
    protected function setMethod($method)
    {
        $this->soapClient->setOptions('uri', $this->serviceUrl);
        $this->soapClient->setOptions('location', $this->serviceUrl);
        $this->soapClient->setOptions('soap_version', SOAP_1_1);
        $this->soapClient->setPathWsdl($this->serviceUrl . '/wsdl');
        $this->soapClient->setServiceName($method);
    }
}
