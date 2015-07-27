<?php

namespace Omea\GestionTelco\PortabilityBundle\Tests\Services;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Omea\GestionTelco\PortabilityBundle\Types\PortabilityStatus;

/** This is not an actual unit test */
class MainRepositoryServiceTest extends KernelTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->bootKernel();
        self::$kernel->getContainer()->get('omea_gestion_telco_portability.services.utils.main')->beginTransaction();
    }
    
    public function tearDown()
    {
        if (self::$kernel->getContainer()->get('omea_gestion_telco_portability.services.utils.main')->isTransactionActive()) {
            self::$kernel->getContainer()->get('omea_gestion_telco_portability.services.utils.main')->rollback();
        }
        parent::tearDown();
    }
    
    
    public function testParametrage()
    {
        $main = self::$kernel->getContainer()->get('omea_gestion_telco_portability.services.utils.main');
        
        // Parametrage key '' should not exist
        $this->assertEquals(null, $main->getParametrage(''));
    }
    
    public function testPortabilityStatus()
    {
        $expectedStatus = new PortabilityStatus();
        $expectedStatus->portabilityType = 'PE';
        $expectedStatus->idClient = 900;
        $expectedStatus->msisdn = '0612340000';
        $expectedStatus->rio = '11P123456AAA';
        $expectedStatus->idPortage = '710000000000';
        $expectedStatus->dateDemande = '2015-05-01';
        $expectedStatus->datePortage = '2015-05-20';
        $expectedStatus->tranche = '11';
        
        $this->assertNotNull("$expectedStatus");
        
        $main = self::$kernel->getContainer()->get('omea_gestion_telco_portability.services.utils.main');
        
        // We haven't created the portabilitystatus in DB yet
        $this->assertEquals(null, $main->getLastPortabilityStatusByMsisdn($expectedStatus->msisdn, $expectedStatus->portabilityType));
        $this->assertEquals(null, $main->getLastPortabilityStatusByIdPortage($expectedStatus->idPortage, $expectedStatus->portabilityType));

        // Test INSERT
        $expectedStatus->idPao = $main->createPortabilityStatus($expectedStatus->portabilityType, $expectedStatus->idClient, $expectedStatus->msisdn, $expectedStatus->rio, $expectedStatus->idPortage, $expectedStatus->dateDemande->format('Y-m-d'), $expectedStatus->datePortage->format('Y-m-d'), $expectedStatus->tranche);
        
        $this->assertEquals($expectedStatus, $main->getLastPortabilityStatusByMsisdn($expectedStatus->msisdn, $expectedStatus->portabilityType));
        $this->assertEquals($expectedStatus, $main->getLastPortabilityStatusByIdPortage($expectedStatus->idPortage, $expectedStatus->portabilityType));
        
        // Test UPDATE 1
        $expectedStatus->lastOperationIn = 'ELI';
        $expectedStatus->lastReturnCodeIn = '125';
        
        $main->updatePortabilityStatusWithIncomingMessage($expectedStatus->msisdn, $expectedStatus->idPortage, $expectedStatus->lastOperationIn, $expectedStatus->lastReturnCodeIn);
        
        // Let's cheat for the LastDateIn param
        $statusByMsisdn = $main->getLastPortabilityStatusByMsisdn($expectedStatus->msisdn, $expectedStatus->portabilityType);
        $expectedStatus->lastDateIn = $statusByMsisdn->lastDateIn->format('Y-m-d H:i:s');
        
        $this->assertEquals($expectedStatus, $main->getLastPortabilityStatusByMsisdn($expectedStatus->msisdn, $expectedStatus->portabilityType));
        $this->assertEquals($expectedStatus, $main->getLastPortabilityStatusByIdPortage($expectedStatus->idPortage, $expectedStatus->portabilityType));
        
        // Test UPDATE 2
        $expectedStatus->numAbo = '100000000';
        
        $main->updatePortabilityStatusWithNumAbo($expectedStatus->idPortage, $expectedStatus->numAbo);
        
        $this->assertEquals($expectedStatus, $main->getLastPortabilityStatusByMsisdn($expectedStatus->msisdn, $expectedStatus->portabilityType));
        $this->assertEquals($expectedStatus, $main->getLastPortabilityStatusByIdPortage($expectedStatus->idPortage, $expectedStatus->portabilityType));
        
        // Test UPDATE 3
        $expectedStatus->acq = '1';
        $expectedStatus->anomalyCode = 1100;
        
        $main->updateFinalPortabilityStatus($expectedStatus->idPao, $expectedStatus->acq, $expectedStatus->anomalyCode);

        $this->assertEquals($expectedStatus, $main->getLastPortabilityStatusByMsisdn($expectedStatus->msisdn, $expectedStatus->portabilityType));
        $this->assertEquals($expectedStatus, $main->getLastPortabilityStatusByIdPortage($expectedStatus->idPortage, $expectedStatus->portabilityType));
    }
    
        /** @expectedException \Exception */
    public function testInexistantStatusAttribute1()
    {
        $status = new PortabilityStatus();
        $status->lol;
    }
    /** @expectedException \Exception */
    public function testInexistantStatusAttribute2()
    {
        $status = new PortabilityStatus();
        $status->lol = 'whatever';
    }
    
    public function testTransactionStatus()
    {
        $mainDb = self::$kernel->getContainer()->get('doctrine.dbal.main_connection');
        $main = self::$kernel->getContainer()->get('omea_gestion_telco_portability.services.utils.main');
        
        $idTrans = 6000;
        $transactionStatus = 11;
        
        $mainDb->executeUpdate('INSERT INTO TRANSACTION (ID_TRANS) VALUES (?)', array($idTrans));
        
        $this->assertEquals(1, $main->updateTransactionStatus($idTrans, $transactionStatus));
        $this->assertEquals($transactionStatus, $mainDb->fetchColumn('SELECT ID_TRANS_STATUT FROM TRANSACTION_ETAT WHERE ID_TRANS = ? ORDER BY ID_TRANS_ETAT DESC LIMIT 1', array($idTrans), 0));
        
        $this->assertEquals(0, $main->updateTransactionStatus($idTrans, $transactionStatus));
    }
    
    public function testDisePnmIn()
    {
        $mainDb = self::$kernel->getContainer()->get('doctrine.dbal.main_connection');
        $main = self::$kernel->getContainer()->get('omea_gestion_telco_portability.services.utils.main');
        
        $idClient = 3000;
        $idPortage = '710000011111';
        
        $this->assertEquals(1, $main->insertDisePnmIn($idClient, $idPortage));
        $this->assertEquals($idPortage, $mainDb->fetchColumn('SELECT IDPORTAGE FROM DISE_PNM_IN WHERE ID_CLIENT = ? ORDER BY ID_DPI DESC LIMIT 1', array($idClient), 0));
    }

    public function testPnmAbandon()
    {
        $mainDb = self::$kernel->getContainer()->get('doctrine.dbal.main_connection');
        $main = self::$kernel->getContainer()->get('omea_gestion_telco_portability.services.utils.main');
        
        $idClient = 3000;
        
        $this->assertEquals(1, $main->insertPnmAbandon($idClient));
        $this->assertNotNull($mainDb->fetchColumn('SELECT ID_CLIENT FROM PNM_ABANDON WHERE ID_CLIENT = ? LIMIT 1', array($idClient), 0));
    }
}
