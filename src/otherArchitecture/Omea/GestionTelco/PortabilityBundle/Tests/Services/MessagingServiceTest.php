<?php
namespace Omea\GestionTelco\PortabilityBundle\Tests\Services;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Omea\GestionTelco\PortabilityBundle\Types\Message;

/** This is not an actual unit test */
class MessagingServiceTest extends KernelTestCase
{
    const ID_PORTAGE = '710000000000';
    
    public function setUp()
    {
        parent::setUp();
        $this->bootKernel();
        self::$kernel->getContainer()->get('doctrine.dbal.main_connection')->beginTransaction();
        self::$kernel->getContainer()->get('doctrine.dbal.pnm_ppnm_connection')->beginTransaction();
    }
    
    public function tearDown()
    {
        self::$kernel->getContainer()->get('doctrine.dbal.main_connection')->rollback();
        self::$kernel->getContainer()->get('doctrine.dbal.pnm_ppnm_connection')->rollback();
        parent::tearDown();
    }
    
    public function provideTables()
    {
        return array(array('OMG_PNM_IN'),
                     array('OMG_PNM_OUT'),
                     array('OMG_MESSAGE_IN'),
                     array('OMG_MESSAGE_OUT'),
                     );
    }
    
    /** @dataProvider provideTables */
    public function testMessaging($table)
    {
        $message = new Message();
        $message->state = 'SO';
        $message->operation = 'ELI';
        $message->emetteur = 'RR';
        $message->recepteur = 'EG';
        $message->msisdn = '0612341111';
        $message->rio = '12P123456AAA';
        $message->idPortage = self::ID_PORTAGE;
        $message->opr  = '71';
        $message->oprt = '02';
        $message->opd  = '12';
        $message->opdt = '01';
        $message->opa  = '11';
        $message->opat = '03';
        $message->dateDemande = '2015-05-01';
        $message->datePortage = '2015-05-20';
        $message->tranche = '11';
        $message->codeRetour = '100';
        
        $this->assertNotNull("$message");
        
        $messaging = self::$kernel->getContainer()->get('omea_gestion_telco_portability.services.utils.messaging');

        $message->id = $messaging->addMessage($table, $message);
        $this->assertNotNull($message->id);
        
        $messaging->updateState($table, $message->id, 'OK');
        $message->state = 'OK';
        
        $newMessage = $messaging->getMessageByIdPortage($table, $message->idPortage, $message->operation);
        
        $this->assertNotNull($newMessage);
        $this->assertEquals($message, $newMessage);
    }
    
    /** @expectedException \Exception */
    public function testWrongMessagingTable1()
    {
        $message = new Message();
        $messaging = self::$kernel->getContainer()->get('omea_gestion_telco_portability.services.utils.messaging');

        $messaging->addMessage('LOL', $message);
    }
    /** @expectedException \Exception */
    public function testWrongMessagingTable2()
    {
        $messaging = self::$kernel->getContainer()->get('omea_gestion_telco_portability.services.utils.messaging');

        $messaging->updateState('LOL', 0, 'AA');
    }
    /** @expectedException \Exception */
    public function testWrongMessagingTable3()
    {
        $message = new Message();
        $messaging = self::$kernel->getContainer()->get('omea_gestion_telco_portability.services.utils.messaging');

        $messaging->getMessageByIdPortage('LOL', 0, 'AAA');
    }
    /** @expectedException \Exception */
    public function testNonExistantMessage1()
    {
        $messaging = self::$kernel->getContainer()->get('omea_gestion_telco_portability.services.utils.messaging');

        $messaging->updateState('OMG_PNM_IN', 0, 'AA');
    }
    /** @expectedException \Exception */
    public function testNonExistantMessage2()
    {
        $message = new Message();
        $messaging = self::$kernel->getContainer()->get('omea_gestion_telco_portability.services.utils.messaging');

        $messaging->getMessageByIdPortage('OMG_PNM_IN', 0, 'AAA');
    }
    
    /** @expectedException \Exception */
    public function testDuplicateMessage()
    {
        $table = 'OMG_PNM_IN';
        
        $message = new Message();
        $message->state = 'SO';
        $message->operation = 'ELI';
        $message->emetteur = 'RR';
        $message->recepteur = 'EG';
        $message->msisdn = '0612341111';
        $message->rio = '12P123456AAA';
        $message->idPortage = self::ID_PORTAGE;
        $message->opr  = '71';
        $message->oprt = '02';
        $message->opd  = '12';
        $message->opdt = '01';
        $message->opa  = '11';
        $message->opat = '03';
        $message->dateDemande = '2015-05-01';
        $message->datePortage = '2015-05-20';
        $message->tranche = '11';
        $message->codeRetour = '100';
        
        $this->assertNotNull("$message");
        
        $messaging = self::$kernel->getContainer()->get('omea_gestion_telco_portability.services.utils.messaging');

        $message->id = $messaging->addMessage($table, $message);
        
        // Fails because duplicate
        $id2 = $messaging->addMessage($table, $message);
    }
    
    /** @expectedException \Exception */
    public function testInexistantMessageAttribute1()
    {
        $message = new Message();
        $message->lol;
    }
    /** @expectedException \Exception */
    public function testInexistantMessageAttribute2()
    {
        $message = new Message();
        $message->lol = 'whatever';
    }
}
