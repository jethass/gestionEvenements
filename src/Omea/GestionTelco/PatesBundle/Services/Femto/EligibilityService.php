<?php
namespace Omea\GestionTelco\PatesBundle\Services\Femto;

use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClientState;

use Omea\GestionTelco\PatesBundle\Types\EligibilityRequest;
use Omea\GestionTelco\PatesBundle\Exception\NotFoundException;
use Omea\GestionTelco\PatesBundle\Exception\AccessDeniedException;
use Omea\GestionTelco\PatesBundle\Exception\TechnicalException;
use Omea\GestionTelco\PatesBundle\Exception\EligibilityException;
use Symfony\Component\Config\Definition\Exception\Exception;

class EligibilityService extends AbstractService
{
    protected $idClient;
    protected $numAbo;

    /**
     * @var EntityManager
     */
    private $emRecou;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @param LoggerInterface $logger
     * @param RegistryInterface $doctrine
     * @param array $patesConfig
     */
    public function __construct(LoggerInterface $logger, RegistryInterface $doctrine, array $patesConfig)
    {
        parent::__construct($logger, $doctrine);

        $this->emRecou = $doctrine->getManager('recou');
        $this->parameters = $patesConfig;
    }

    /**
     * Check Femto eligibility
     *
     * @param EligibilityRequest $request
     * @return boolean
     * @throws \Exception
     */
    public function checkEligibility(EligibilityRequest $request)
    {
        $msisdn = $request->msisdn;
        $extendedTest = false;
        if (!empty($request->extendedTest)) {
            $extendedTest = $request->extendedTest;
        }

        $this->logger->debug(sprintf('CheckFemtoEligibility begins for msisdn: %s', $msisdn));

        $simpleCheck = $this->checkIsFullMVNO($msisdn);

        if (!$extendedTest) {
            return $simpleCheck;
        }

        $extendedCheck = (
            $this->checkAboStatus($this->numAbo)
            && (!($this->checkRecou($this->idClient)))
            && (!($this->checkResiliation($this->idClient)))
        );

        return ($simpleCheck && $extendedCheck);
    }

    /**
     * Check that the client is in the authorized list
     *
     * @param string $msisdn
     * @return boolean
     */
    protected function checkAuthorizedClient($msisdn)
    {
        $stockMsisdn = $this->getStockMsisdn($msisdn);

        $this->idClient = $stockMsisdn->getIdClient();
        $this->numAbo = $stockMsisdn->getNumAbo();

        $this->getFemtoAuthorizedClient($this->idClient);

        return true;
    }

    /**
     * @param integer $clientId
     * @return \Omea\GestionTelco\PatesBundle\Entity\FemtoAuthorizedClient
     */
    public function getFemtoAuthorizedClient($clientId)
    {
        $authorizedClient = $this->em
            ->getRepository('Omea\GestionTelco\PatesBundle\Entity\FemtoAuthorizedClient')
            ->findOneBy(
                array(
                    'clientId' => $clientId
                )
            );
        if (empty($authorizedClient)) {
            throw new EligibilityException(
                'Le client ' . $clientId . ' n\' est pas éligible à l\'option Femto',
                EligibilityException::CLIENT_NOT_AUTHORIZED
            );
        }
        return $authorizedClient;
    }

    /**
     * Check that the client is FullMVNO
     *
     * @param string $msisdn
     * @return boolean
     */
    public function checkIsFullMVNO($msisdn)
    {
        $stockNsce = $this->emMain->getRepository('Omea\Domain\Main\StockNsce')->findBy(
            array(
                'msisdn' => $msisdn,
                'etat' => 1,
                'idNetwork' => 1
            )
        );
        if (empty($stockNsce)) {
            throw new EligibilityException(
                'Le client ' . $msisdn . ' n\' est pas FULL MVNO',
                EligibilityException::CLIENT_NOT_FULL_MVNO
            );
        }
        return true;
    }

    /**
     * Check that the subscription is active
     *
     * @param integer $numAbo
     * @return boolean
     */
    private function checkAboStatus($numAbo)
    {
        $diseAbo = $this->emMain->getRepository('Omea\Domain\Main\DiseAbonnement')->find($numAbo);
        if (!empty($diseAbo)) {
            if ($diseAbo->getStatutAbonnement() == 'A') {
                return true;
            }
        } else {
            throw new NotFoundException('Le numero d\'abonnement n\'existe pas', NotFoundException::NUM_ABO);
        }

        throw new EligibilityException(
            'Le client ' . $numAbo . ' n\'est pas actif.',
            EligibilityException::CLIENT_STATUS_INACTIVE
        );
    }

    /**
     * Check that the client isn't scored (financially)
     *
     * @param integer $idClient
     * @return boolean
     */
    private function checkRecou($idClient)
    {
        $recou = $this->emRecou->getRepository('Omea\Domain\Recouvrement\RecouClient')->find($idClient);
        if (!empty($recou)) {
            throw new EligibilityException(
                'Le client ' . $idClient . ' présente des impayés.',
                EligibilityException::CLIENT_LIABLE
            );
        }
        return false;
    }

    /**
     * Check that the client subscription isn't cancelled
     *
     * @param integer $idClient
     * @return boolean
     */
    private function checkResiliation($idClient)
    {
        $resiliation = $this->emMain->getRepository('Omea\Domain\Main\Resiliation')->findBy(
            array('idClient' => $idClient)
        );
        if (!empty($resiliation)) {
            throw new EligibilityException(
                'Le client ' . $idClient . ' est résilié.',
                EligibilityException::CLIENT_TERMINATED
            );
        }
        return false;
    }
}
