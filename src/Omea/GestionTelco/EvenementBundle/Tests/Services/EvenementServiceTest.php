<?php

namespace Omea\GestionTelco\EvenementBundle\Tests\Services;

use Omea\GestionTelco\EvenementBundle\Tests\BaseWebTestCase;
use Omea\GestionTelco\EvenementBundle\Types\BaseResponse;
use Omea\GestionTelco\EvenementBundle\Services\EvenementService;
use Omea\GestionTelco\EvenementBundle\Types\SaveEvenementRequest;
use Omea\GestionTelco\EvenementBundle\Exception\NotFoundException;

/**
 *
 * @author hlataoui
 */
class EvenementServiceTest extends BaseWebTestCase {
  
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
        $entityManager= $this->getMockBuilder('Symfony\Bridge\Doctrine\RegistryInterface')->disableOriginalConstructor()->getMock();
        $evenementRepository = $this->getMockBuilder('Omea\GestionTelco\EvenementBundle\Entity\EvenementRepository')->disableOriginalConstructor()->getMock();
        $actesManager=$this->getMockBuilder('Omea\GestionTelco\EvenementBundle\ActeManager\ActesManager')->disableOriginalConstructor()->getMock();
                
        $evenementService = new EvenementService($validator, $logger, $entityManager ,$evenementRepository,$actesManager );

        $saveEvenementRequest = new SaveEvenementRequest('0601092885', 'CODEEVENT1','NOTIFICATION');
        $saveEvenementResponse = $evenementService->saveEvenement($saveEvenementRequest)->willReturn(true);

        $expectedResponse = new BaseResponse(0, '');
        
        $this->assertEquals($expectedResponse, $saveEvenementResponse);

    }

    public function testSaveEvenementKo()
    {
        $validator = $this->getMockBuilder('Symfony\Component\Validator\Validator\ValidatorInterface')->disableOriginalConstructor()->getMock();
        $logger = $this->getMockBuilder('Psr\Log\LoggerInterface')->disableOriginalConstructor()->getMock();
        $entityManager= $this->getMockBuilder('Symfony\Bridge\Doctrine\RegistryInterface')->disableOriginalConstructor()->getMock();
        $evenementRepository = $this->getMockBuilder('Omea\GestionTelco\EvenementBundle\Entity\EvenementRepository')->disableOriginalConstructor()->getMock();
        $actesManager=$this->getMockBuilder('Omea\GestionTelco\EvenementBundle\ActeManager\ActesManager')->disableOriginalConstructor()->getMock();
                
        $evenementService = new EvenementService($validator, $logger, $entityManager ,$evenementRepository,$actesManager );

        $saveEvenementRequest = new SaveEvenementRequest('060', 'CODEFALSE','NOTIFICATION');
        $saveEvenementResponse = $evenementService->saveEvenement($saveEvenementRequest)->will($this->throwException(new \Omea\GestionTelco\EvenementsBundle\Exception\NotFoundException('test KO')));

        $expectedResponse = new BaseResponse(NotFoundException::NOT_FOUND_EXCEPTION, 'test KO');
        
        $this->assertEquals($expectedResponse, $saveEvenementResponse);
    }
    
}
