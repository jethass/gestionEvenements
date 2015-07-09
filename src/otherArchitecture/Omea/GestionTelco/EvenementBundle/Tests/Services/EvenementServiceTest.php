<?php

namespace Omea\GestionTelco\EvenementBundle\Tests\Services;

use Omea\GestionTelco\EvenementBundle\Services\EvenementService;
use Omea\GestionTelco\EvenementBundle\Types\SaveEvenementRequest;
use Omea\GestionTelco\EvenementBundle\Exception\InvalidArgumentException;
use Omea\GestionTelco\EvenementBundle\Types\BaseResponse;
use Omea\GestionTelco\EvenementBundle\Types\SaveEvenementResponse;

/**
 * @author hlataoui
 */
class EvenementServiceTest extends \PHPUnit_Framework_TestCase
{
    private $logger;
    private $validator;
    private $doctrine;

    public function setUp()
    {
         parent::setUp();
         $this->logger = $this->getMockBuilder('Psr\Log\LoggerInterface')->disableOriginalConstructor()->getMock();
         $this->validator=$this->getMockBuilder('Symfony\Component\Validator\Validator\ValidatorInterface')->getMock();
         $entityManager = $this->getMockBuilder('\Doctrine\ORM\EntityManager')->disableOriginalConstructor()->getMock();        
         $this->doctrine = $this->getMockBuilder('Symfony\Bridge\Doctrine\RegistryInterface')->disableOriginalConstructor()->getMock();
         $this->doctrine->expects($this->once())->method('getManager')->will($this->returnValue($entityManager));
    }

    
    
    public function testSaveEvenementOk()
    {
        $evenementService = new EvenementService($this->validator, $this->logger, $this->doctrine);
        $saveEvenementRequest = new SaveEvenementRequest();
        $saveEvenementRequest->msisdn='0685478554';
        $saveEvenementRequest->code='Alerte_HIS';
        $saveEvenementRequest->type='NOTIFICATION';
        $saveEvenementResponse = $evenementService->saveEvenement($saveEvenementRequest);
        $expectedResponse =new SaveEvenementResponse('0','Inserted OK',1);
        $this->assertEquals($expectedResponse, $saveEvenementResponse);
    }

    public function testSaveEvenementKo()
    {
        $evenementService = new EvenementService($this->validator, $this->logger, $this->doctrine);
        $saveEvenementRequest = new SaveEvenementRequest();
        $saveEvenementRequest->msisdn=null;
        $saveEvenementRequest->code=null;
        $saveEvenementRequest->type=null;
        $saveEvenementResponse = $evenementService->saveEvenement($saveEvenementRequest);
        $expectedResponse =new SaveEvenementResponse(InvalidArgumentException::INVALID_ARGUMENT_EXCEPTION,'Inserted KO',0);
        $this->assertEquals($expectedResponse, $saveEvenementResponse);
    }

}
