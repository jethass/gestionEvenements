<?php

namespace Omea\GestionTelco\EvenementsBundle\Tests\Services;

use Omea\GestionTelco\EvenementsBundle\Tests\BaseWebTestCase;
use Omea\GestionTelco\EvenementsBundle\Types\BaseResponse;
use Omea\GestionTelco\EvenementsBundle\Services\EvenementsService;
use Omea\GestionTelco\EvenementsBundle\Types\SaveEvenementRequest;
use Omea\GestionTelco\EvenementsBundle\Exception\NotFoundException;

/**
 * Description of SaveEvenementServiceTest
 *
 * @author hlataoui
 */
class EvenementsServiceTest extends BaseWebTestCase {
  
    private $logger;


    public function setUp()
    {
        parent::setUp();

        $this->logger = $this->getMockLogger();

    }
    
    public function testSaveEvenementOk()
    {
        $validator = $this->getMockBuilder('Symfony\Component\Validator\Validator\ValidatorInterface')->disableOriginalConstructor()->getMock();
        $logger = $this->getMockBuilder('Psr\Log\LoggerInterface')->disableOriginalConstructor()->getMock();
        
        $saveEvenementService = $this->getMockBuilder('Omea\GestionTelco\EvenementsBundle\Services\SaveEvenementService')->disableOriginalConstructor()->getMock();
        $saveEvenementService->method('saveEvenement')->willReturn(true);

        $evenementManager= $this->getMockBuilder('Omea\GestionTelco\EvenementsBundle\EvenementManager\EvenementManager')->disableOriginalConstructor()->getMock();
        $evenementRepository = $this->getMockBuilder('Omea\GestionTelco\EvenementsBundle\Entity\EvenementRepository')->disableOriginalConstructor()->getMock();
        
        
        $evenementsService = new EvenementsService($validator, $logger, $saveEvenementService, $evenementManager ,$evenementRepository );

        $saveEvenementRequest = new SaveEvenementRequest('0601092885', 'CODEEVENT1','NOTIFICATION');
        $saveEvenementResponse = $evenementsService->saveEvenement($saveEvenementRequest);

        $expectedResponse = new BaseResponse(0, '');
        
        $this->assertEquals($expectedResponse, $saveEvenementResponse);

    }

    public function testSaveEvenementKo()
    {
        $validator = $this->getMockBuilder('Symfony\Component\Validator\Validator\ValidatorInterface')->disableOriginalConstructor()->getMock();
        $logger = $this->getMockBuilder('Psr\Log\LoggerInterface')->disableOriginalConstructor()->getMock();
        
        $saveEvenementService = $this->getMockBuilder('Omea\GestionTelco\EvenementsBundle\Services\SaveEvenementService')->disableOriginalConstructor()->getMock();
        $saveEvenementService->method('saveEvenement')->will($this->throwException(new \Omea\GestionTelco\EvenementsBundle\Exception\NotFoundException('test KO')));
        
        $evenementManager= $this->getMockBuilder('Omea\GestionTelco\EvenementsBundle\EvenementManager\EvenementManager')->disableOriginalConstructor()->getMock();
        $evenementRepository = $this->getMockBuilder('Omea\GestionTelco\EvenementsBundle\Entity\EvenementRepository')->disableOriginalConstructor()->getMock();
            
        $evenementsService = new EvenementsService($validator, $logger, $saveEvenementService, $evenementManager ,$evenementRepository );

        $saveEvenementRequest = new SaveEvenementRequest('0601092885', 'CODEEVENT1','NOTIFICATION');
        $saveEvenementResponse = $evenementsService->saveEvenement($saveEvenementRequest);

        $expectedResponse = new BaseResponse(NotFoundException::NOT_FOUND_EXCEPTION, 'test KO');
        
        $this->assertEquals($expectedResponse, $saveEvenementResponse);
    }
    
}
