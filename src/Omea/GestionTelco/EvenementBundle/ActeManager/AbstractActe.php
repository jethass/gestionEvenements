<?php
namespace Omea\GestionTelco\EvenementBundle\ActeManager;

use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

use SoapClientBundle\Exception\SoapClientException;
use SoapClientBundle\Services\SoapClientService;


class AbstractActe
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
     * @var SoapClientService
     */
    private $soapClient;
    
   
    /**
     * @param LoggerInterface $logger
     * @param RegistryInterface $doctrine
     * @param SoapClientService $soapClient
     */
    public function __construct(LoggerInterface $logger, RegistryInterface $doctrine,SoapClientService $soapClient)
    {
        $this->logger = $logger;
        $this->em = $doctrine->getManager();
        $this->emMain = $doctrine->getManager('main');
        $this->soapClient = $soapClient;
    }

   /**
     * @param string $msisdn
     * @return \Omea\Domain\Main\StockMsisdn
     * @throws NotFoundException
     */
    public function getStockMsisdn($msisdn)
    {
        $stockMsisdn = $this->emMain->getRepository('Omea\Domain\Main\StockMsisdn')->find($msisdn);
        if (empty($stockMsisdn)) {
            throw new NotFoundException('Le MSISDN ' . $msisdn . ' n\'existe pas', NotFoundException::MSISDN);
        }
        return $stockMsisdn;
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

}
