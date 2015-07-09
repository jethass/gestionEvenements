<?php
namespace Omea\GestionTelco\PatesBundle\Services\Femto;

use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

use Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoring;

use Omea\GestionTelco\PatesBundle\Exception\NotFoundException;
use Omea\GestionTelco\PatesBundle\Exception\TechnicalException;

class AbstractService
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityManager
     */
    protected $emMain;
    
    /**
     * @var array
     */
    protected $localCache = array();

    /**
     * @param LoggerInterface $logger
     * @param RegistryInterface $doctrine
     */
    public function __construct(LoggerInterface $logger, RegistryInterface $doctrine)
    {
        $this->logger = $logger;
        $this->em = $doctrine->getManager();
        $this->emMain = $doctrine->getManager('main');
    }

    /**
     * Insert a new FemtoProvisioningMonitoring with the given params
     *
     * @param integer $femtoProvisioningAction
     * @param integer $femtoProvisioningStep
     * @param string $msisdn
     * @param array $arguments
     *
     * @return FemtoProvisioningMonitoring
     * @throws \Exception
     */
    public function generateFemtoProvisioningMonitoring(
        $femtoProvisioningAction,
        $femtoProvisioningStep,
        $msisdn = null,
        $numAbo = null,
        $arguments = null
    ) {
        // Add a new FPM
        $fpm = new FemtoProvisioningMonitoring();
        $fpm->setTypeAction(
            $this->em
                ->getRepository('OmeaGestionTelcoPatesBundle:FemtoProvisioningMonitoringAction')
                ->find($femtoProvisioningAction)
        );
        $fpm->setStep(
            $this->em
                ->getRepository('OmeaGestionTelcoPatesBundle:FemtoProvisioningMonitoringStep')
                ->find($femtoProvisioningStep)
        );

        if ($msisdn !== null) {
            $fpm->setMsisdn($msisdn);
        }

        if ($numAbo !== null) {
            $fpm->setNumAbo($numAbo);
        }

        $complement = $this->transformArrayToComplement($arguments);

        if ($complement !== '') {
            $fpm->setComplement($complement);
        }

        $this->em->persist($fpm);
        $this->em->flush();

        return $fpm;
    }

    /**
     * Update a FemtoProvisioningMonitoring with the given parameters
     *
     * @param FemtoProvisioningMonitoring $fpm
     * @param integer $femtoProvisioningStep
     * @param string|null $numAbo
     * @param string|null $responseCode
     * @param array|null $arguments
     * @return FemtoProvisioningMonitoring
     */
    public function updateFemtoProvisioningMonitoring(
        $fpm,
        $femtoProvisioningStep,
        $numAbo = null,
        $responseCode = null,
        array $arguments = null
    ) {
        $fpm->setStep(
            $this->em
                ->getRepository('OmeaGestionTelcoPatesBundle:FemtoProvisioningMonitoringStep')
                ->find($femtoProvisioningStep)
        );

        if (null !== $numAbo) {
            $fpm->setNumAbo($numAbo);
        }

        if (null !== $responseCode) {
            $fpm->setCodeRetour($responseCode);
        }

        if (null !== $arguments) {
            $fpm->setComplement($this->transformArrayToComplement($arguments));
        }

        $this->em->flush();
        return $fpm;
    }

    /**
     * Transform an array to a string for the field complement in FemtoProvisioningMonitoring
     *
     * @param array $array
     * @return string
     */
    public function transformArrayToComplement(array $array)
    {
        $complement = '';

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = '['.$this->transformArrayToComplement($value).']';
            }
            $complement .= $key.':'.$value.';';
        }
        // Remove the last ";"
        $complement = substr($complement, 0, -1);

        return $complement;
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
        $complementExplode = explode(';', $complement);

        foreach ($complementExplode as $parameter) {
            $keyValue = explode(':', $parameter);
            $array[$keyValue[0]] = $keyValue[1];
        }

        return $array;
    }

    /**
     * @param string $msisdn
     * @return \Omea\Entity\Main\StockMsisdn
     * @throws NotFoundException
     */
    public function getStockMsisdn($msisdn)
    {
        $stockMsisdn = $this->emMain->getRepository('Omea\Entity\Main\StockMsisdn')->find($msisdn);
        if (empty($stockMsisdn)) {
            throw new NotFoundException('Le MSISDN ' . $msisdn . ' n\'existe pas', NotFoundException::MSISDN);
        }
        return $stockMsisdn;
    }

    /**
     * @param string $msisdn
     * @return string
     * @throws NotFoundException
     */
    public function getActivatedStockNsceFromMsisdn($msisdn)
    {
        $stockNsce = $this->emMain->getRepository('Omea\Entity\Main\StockNsce')->findOneBy(
            array(
                'msisdn' => $msisdn,
                'etat' => 1
            )
        );
        if (empty($stockNsce)) {
            throw new NotFoundException(
                'Le MSISDN ' . $msisdn . ' n\'est pas présent dans STOCK_NSCE',
                NotFoundException::NSCE
            );
        }
        return $stockNsce;
    }

    /**
     * Check if MSISDN exist and if is for only one num_abo.
     * @param string $msisdn
     * @return string
     * @throws \Exception
     */
    public function getNumAboFromMsisdn($msisdn)
    {
        if (isset($this->localCache[__FUNCTION__][$msisdn])) {
            return $this->localCache[__FUNCTION__][$msisdn];
        }
        
        $stockMsisdn = $this->getStockMsisdn($msisdn);

        if (null === $stockMsisdn) {
            $stockMsisdnErr = 'Le MSISDN ' . $msisdn . ' n\'a pas été trouvé.';
            $this->logger->error($stockMsisdnErr);
            throw new NotFoundException($stockMsisdnErr, NotFoundException::MSISDN);
        } elseif (null === $stockMsisdn->getNumAbo()) {
            $stockMsisdnErr = 'Le MSISDN ' . $msisdn . ' est associé à aucun num_abo.';
            $this->logger->error($stockMsisdnErr);
            throw new TechnicalException($stockMsisdnErr, TechnicalException::NUMABO_MSISDN);
        }
        $this->localCache[__FUNCTION__][$msisdn] = $stockMsisdn->getNumAbo();
        
        return $stockMsisdn->getNumAbo();
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
}
