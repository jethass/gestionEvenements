<?php
namespace Omea\GestionTelco\EvenementBundle\Tests\Services;
use Omea\GestionTelco\EvenementBundle\Tests\BaseWebTestCase;
use Omea\GestionTelco\EvenementBundle\Types\BaseResponse;
use Omea\GestionTelco\EvenementBundle\Services\EvenementService;
use Omea\GestionTelco\EvenementBundle\Types\SaveEvenementRequest;
use Omea\GestionTelco\EvenementBundle\Exception\NotFoundException;
use Symfony\Component\Intl\Exception\RuntimeException;
use Omea\GestionTelco\EvenementBundle\Types\SaveEvenementResponse;

/**
 *
 * @author hlataoui
 */
class EvenementServiceTest extends BaseWebTestCase
{
  
    
    
    private $logger;


    public function setUp()
    {
        parent::setUp();

        $this->logger = $this->getMockLogger();

    }
    
    public function testSaveEvenementOk()
    {
        $validator = $this->getMockBuilder('Symfony\Component\Validator\Validator\ValidatorInterface')->disableOriginalConstructor()->getMock();
        $logger =  new \Psr\Log\NullLogger;
        $entityManager= $this->getMockBuilder('Symfony\Bridge\Doctrine\RegistryInterface')->disableOriginalConstructor()->getMock();
        $evenementRepository = $this->getMockBuilder('Omea\GestionTelco\EvenementBundle\Entity\EvenementRepository')->disableOriginalConstructor()->getMock();
        $actesManager=$this->getMockBuilder('Omea\GestionTelco\EvenementBundle\ActeManager\ActesManager')->disableOriginalConstructor()->getMock();
                
        $evenementService = new EvenementService($validator, $logger, $entityManager ,$evenementRepository,$actesManager );
        //$evenementService->method('saveEvenement')->willReturn(true);

        $saveEvenementRequest = new SaveEvenementRequest('0601092885', 'CODEEVENT1','NOTIFICATION');
        $saveEvenementResponse = $evenementService->saveEvenement($saveEvenementRequest);

        $expectedResponse =  new SaveEvenementResponse(0, '',false);

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
      //  $evenementService->method('saveEvenement')->will($this->throwException(new \Omea\GestionTelco\EvenementBundle\Exception\NotFoundException('test KO')));

        $saveEvenementRequest = new SaveEvenementRequest('06', 'CODEFALSE','TYPE');
        $saveEvenementResponse = $evenementService->saveEvenement($saveEvenementRequest);

        $expectedResponse = new SaveEvenementResponse(NotFoundException::NOT_FOUND_EXCEPTION, 'test KO',false);

        $this->assertEquals($expectedResponse, $saveEvenementResponse);
    }
    
    
    
//    public function testHandleEvenementsOk(){
//        $expectedResponse =  new BaseResponse(0, '');
//    }
//    
//    public function testHandleEvenementsKo(){
//        $expectedResponse = new BaseResponse(new RuntimeException('test KO') );
//    }
    
}
