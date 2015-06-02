<?php
namespace Omea\GestionTelco\PatesBundle\Actions;

use Doctrine\ORM\EntityManager;
use Omea\GestionTelco\PatesBundle\Exception\NotFoundException;
use Symfony\Bridge\Doctrine\RegistryInterface;
use SoapClientBundle\Services\SoapClientService;
use Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoring;

abstract class AbstractAction
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityManager
     */
    protected $emMain;

    /**
     * @var EntityManager
     */
    protected $emHexavia;

    /**
     * @var SoapClientService
     */
    protected $soapClient;

    /**
     * @var array
     */
    protected $femtoConfig;

    /**
     * @var array
     */
    protected $servicesConfig;

    /**
     * @param RegistryInterface $doctrine
     * @param SoapClientService $clientService
     * @param array $femtoConfig
     * @param array $servicesConfig
     */
    public function __construct(RegistryInterface $doctrine, SoapClientService $clientService, array $femtoConfig, array $servicesConfig)
    {
        $this->em = $doctrine->getManager();
        $this->emMain = $doctrine->getManager('main');
        $this->emHexavia = $doctrine->getManager('hexavia');
        $this->soapClient = $clientService;
        $this->femtoConfig = $femtoConfig;
        $this->servicesConfig = $servicesConfig;
    }

    /**
     * Transform a complement string into an associative array
     *
     * @param string $complement
     * @return array
     */
    public function transformComplementToArray($complement)
    {
        $array = array();

        if (empty($complement)) {
            return $array;
        }

        $complementExplode = explode(';', $complement);

        foreach ($complementExplode as $parameter) {
            $keyValue = explode(':', $parameter);
            $array[$keyValue[0]] = $keyValue[1];
        }

        return $array;
    }

    /**
     * @param string $msisdn
     * @return string
     * @throws NotFoundException
     */
    public function getImsiByMsisdn($msisdn)
    {
        $stockNsce = $this->emMain->getRepository('Omea\Domain\Main\StockNsce')->findOneBy(
            array(
                'msisdn' => $msisdn,
                'etat' => 1
            )
        );

        if (!empty($stockNsce) && null !== $stockNsce->getImsi()) {
            return $stockNsce->getImsi();
        }

        // If the imsi doesn't exists in our DB, try; to get it from sfr
        $this->soapClient->setOptions('uri', $this->servicesConfig['parameters']['paws']['ws']['location']);
        $this->soapClient->setOptions('location', $this->servicesConfig['parameters']['paws']['ws']['location']);
        $this->soapClient->setOptions('soap_version', SOAP_1_1);
        $this->soapClient->setPathWsdl($this->servicesConfig['parameters']['paws']['ws']['wsdl']);
        $this->soapClient->setServiceName('getTerminal');

        $result = $this->soapClient->send(
            array(
                array(
                    'MSISDN' => $msisdn,
                )
            )
        );

        if ($result->reasonCode === '0' && null !== $result->imsi) {
            return $result->imsi;
        }

        throw new NotFoundException('The imsi for the msisdn: '.$msisdn.' does not exists', NotFoundException::IMSI);
    }

    /**
     * @param integer $numAbo
     * @return \Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClient
     * @throws NotFoundException
     */
    public function getActiveClients($numAbo, $states = null)
    {
        $activeClients = $this->em
            ->getRepository('Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClient')
            ->getClientByNumAboAndState($numAbo, $states);

        return $activeClients;
    }
    
    /**
     * Called when shit happens
     *
     * @param FemtoProvisioningMonitoring $fpm
     * @return mixed
     */
    public function callbackOnFailure(FemtoProvisioningMonitoring $fpm)
    {
        // Sometimes, we don't really know what we should do, but we do
    }
}
