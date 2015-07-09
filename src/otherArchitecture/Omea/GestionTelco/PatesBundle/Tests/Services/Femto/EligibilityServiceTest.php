<?php

namespace Omea\GestionTelco\PatesBundle\Tests\Services\Femto;

use Omea\GestionTelco\PatesBundle\Tests\BaseWebTestCase;
use Omea\GestionTelco\PatesBundle\Services\Femto\EligibilityService;
use Omea\GestionTelco\PatesBundle\Types\EligibilityRequest;

class EligibilityServiceTest extends BaseWebTestCase
{
    private $logger;
    private $patesConfig;

    public function setUp()
    {
        parent::setUp();

        $this->logger = $this->getMockLogger();
        $this->patesConfig = array('option_id' => 683);
    }

    public function testGetStockMsisdnOk()
    {
        $stockMsisdn = new \Omea\Entity\Main\StockMsisdn();
        $stockMsisdnRepository = $this->getMockRepository($stockMsisdn);
        $em = $this->getMockEntityManager($stockMsisdnRepository);
        $doctrine = $this->getMockDoctrine($em);

        $eligibilityService = new EligibilityService($this->logger, $doctrine, $this->patesConfig);

        $stockMsisdn = $eligibilityService->getStockMsisdn('0601004848');

        $this->assertInstanceOf(
            'Omea\Entity\Main\StockMsisdn',
            $stockMsisdn
        );
    }

    /**
     * @expectedException Omea\GestionTelco\PatesBundle\Exception\NotFoundException
     */
    public function testGetStockMsisdnKo()
    {
        $stockMsisdn = null;
        $stockMsisdnRepository = $this->getMockRepository($stockMsisdn);
        $em = $this->getMockEntityManager($stockMsisdnRepository);
        $doctrine = $this->getMockDoctrine($em);

        $eligibilityService = new EligibilityService($this->logger, $doctrine, $this->patesConfig);

        $eligibilityService->getStockMsisdn('0601004848');
    }

    public function testGetFemtoAuthorizedClientOk()
    {
        $femtoAuthorizedClient = new \Omea\GestionTelco\PatesBundle\Entity\FemtoAuthorizedClient();
        $femtoAuthorizedClientRepository = $this->getMockRepository($femtoAuthorizedClient);
        $em = $this->getMockEntityManager($femtoAuthorizedClientRepository);
        $doctrine = $this->getMockDoctrine($em);
        $eligibilityService = new EligibilityService($this->logger, $doctrine, $this->patesConfig);

        $femtoAuthorizedClient = $eligibilityService->getFemtoAuthorizedClient('7579452');
        $this->assertInstanceOf(
            'Omea\GestionTelco\PatesBundle\Entity\FemtoAuthorizedClient',
            $femtoAuthorizedClient
        );
    }

    /**
     * @expectedException Omea\GestionTelco\PatesBundle\Exception\EligibilityException
     */
    public function testGetFemtoAuthorizedClientKo()
    {
        $femtoAuthorizedClient = null;
        $femtoAuthorizedClientRepository = $this->getMockRepository($femtoAuthorizedClient);
        $em = $this->getMockEntityManager($femtoAuthorizedClientRepository);
        $doctrine = $this->getMockDoctrine($em);

        $eligibilityService = new EligibilityService($this->logger, $doctrine, $this->patesConfig);

        $eligibilityService->getFemtoAuthorizedClient('7579452');
    }


    public function testCheckIsFullMvnoOk()
    {
        $stockNsce = $this->getMockStockNsce('0601013198', '208230003219438', '1', '1');
        $stockNsceRepository = $this->getMockRepository($stockNsce);
        $em = $this->getMockEntityManager($stockNsceRepository);
        $doctrine = $this->getMockDoctrine($em);

        $eligibilityService = new EligibilityService($this->logger, $doctrine, $this->patesConfig);

        $isFullMvno = $eligibilityService->checkIsFullMVNO('0601013198');
        $this->assertTrue($isFullMvno);
    }

    /**
     * @expectedException Omea\GestionTelco\PatesBundle\Exception\EligibilityException
     */
    public function testCheckIsFullMvnoKo()
    {
        $stockNsce = null;
        $stockNsceRepository = $this->getMockRepository($stockNsce);
        $em = $this->getMockEntityManager($stockNsceRepository);
        $doctrine = $this->getMockDoctrine($em);

        $eligibilityService = new EligibilityService($this->logger, $doctrine, $this->patesConfig);

        $eligibilityService->checkIsFullMVNO('0601013198');
    }

    protected function getMockStockMsisdn($msisdn, $numAbo, $idClient, $etat = 1)
    {
        $mockStockMsisdn = $this->getMock('Omea\Entity\Main\StockMsisdn');
        $mockStockMsisdn->expects($this->any())
            ->method('getMsisdn')
            ->will($this->returnValue($msisdn));
        $mockStockMsisdn->expects($this->any())
            ->method('getNumAbo')
            ->will($this->returnValue($numAbo));
        $mockStockMsisdn->expects($this->any())
            ->method('getIdClient')
            ->will($this->returnValue($idClient));
        $mockStockMsisdn->expects($this->any())
            ->method('getEtat')
            ->will($this->returnValue($etat));
        return $mockStockMsisdn;
    }

    protected function getMockFemtoAuthorizedClient($facId, $clientId)
    {
        $mockFemtoAuthorizedClient = $this->getMock('Omea\GestionTelco\PatesBundle\Entity\FemtoAuthorizedClient');
        $mockFemtoAuthorizedClient->expects($this->any())
            ->method('getFacId')
            ->will($this->returnValue($facId));
        $mockFemtoAuthorizedClient->expects($this->any())
            ->method('getClientId')
            ->will($this->returnValue($clientId));
        return $mockFemtoAuthorizedClient;
    }

    protected function getMockStockNsce($msisdn, $imsi, $etat, $idNetwork)
    {
        $mockStockNsce = $this->getMock('Omea\GestionTelco\PatesBundle\Entity\FemtoAuthorizedClient');
        $mockStockNsce->expects($this->any())
            ->method('getMsisdn')
            ->will($this->returnValue($msisdn));
        $mockStockNsce->expects($this->any())
            ->method('getImsi')
            ->will($this->returnValue($imsi));
        $mockStockNsce->expects($this->any())
            ->method('getEtat')
            ->will($this->returnValue($etat));
        $mockStockNsce->expects($this->any())
            ->method('getIdNetwork')
            ->will($this->returnValue($idNetwork));

        return $mockStockNsce;
    }
}
