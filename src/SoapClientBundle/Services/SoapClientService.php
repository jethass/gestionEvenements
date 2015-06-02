<?php
namespace SoapClientBundle\Services;

use Zend\Soap\Client;
use SoapClientBundle\Exception\SoapClientArgumentsException;
use SoapClientBundle\Exception\SoapClientException;
use Psr\Log\LoggerInterface;

/**
 * Class SoapClientService
 * @package Omea\SoapClientBundle\Services
 */
class SoapClientService
{

    /**
     * @var
     */
    private $pathWsdl;
    /**
     * @var
     */
    private $serviceName;
    /**
     * @var array
     */
    private $options = array();

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger ;
    }

    /**
     * @param $trame
     * @return mixed
     * @throws \Omea\SoapClientBundle\Exception\SoapClientException
     */
    public function send($trame)
    {
        try {
            //Verifier les arguments d'entree
            if (($this->pathWsdl == '' && $this->options['uri'] == '') || $this->serviceName == '') {
                throw new SoapClientArgumentsException(
                    'ServiceName : ' . $this->serviceName
                    . ' , PathWsdl : ' . $this->pathWsdl
                );
            }

            //Instanciation du client SOAP
            $wsdl = ($this->pathWsdl == '' || is_null($this->pathWsdl)) ? null : $this->pathWsdl;

            $options = $this->options;

            $soapClient = new Client($wsdl, $options);

            $method = $this->serviceName;

            $result = $soapClient->call($method, $trame);

            return $result;

        } catch (SoapClientArgumentsException $e) {

            $this->logger->warning('Arguments Error : ' . $e->getMessage());
            throw new SoapClientException('Arguments Error : ' . $e->getMessage());

        } catch (\Exception $e) {
            $this->logger->error('Generique Error : ' . $e->getMessage());
            throw new SoapClientException('Generique error : ' . $e->getMessage());
        }

    }

    /**
     * @return mixed
     */
    public function getPathWsdl()
    {
        return $this->pathWsdl;
    }

    /**
     * @param $pathWsdl
     * @return $this
     */
    public function setPathWsdl($pathWsdl)
    {
        $this->pathWsdl = $pathWsdl;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getServiceName()
    {
        return $this->serviceName;
    }

    /**
     * @param $serviceName
     * @return $this
     */
    public function setServiceName($serviceName)
    {
        $this->serviceName = $serviceName;

        return $this;
    }

    /**
     * @param $options
     * @return mixed
     */
    public function getOptions($options)
    {
        return $this->options[$options];
    }

    /**
     * @param $options
     * @param $value
     */
    public function setOptions($options, $value)
    {
        $this->options[$options] = $value;
    }

    /**
     * Initialize options, wsdl & service name
     */
    public function reset()
    {
        $this->options = array();
        $this->setPathWsdl('');
        $this->setServiceName('');
    }
}
