<?php

namespace Omea\GestionTelco\PatesBundle\Tests\Services;

use Omea\GestionTelco\PatesBundle\Tests\BaseWebTestCase;
use Omea\GestionTelco\PatesBundle\Types\BaseResponse;
use Omea\GestionTelco\PatesBundle\Services\PatesService;
use Omea\GestionTelco\PatesBundle\Types\CreateOrderRequest;
use Omea\GestionTelco\PatesBundle\Exception\NotFoundException;

class PatesServiceTest extends BaseWebTestCase
{
    private $logger;


    public function setUp()
    {
        parent::setUp();

        $this->logger = $this->getMockLogger();

    }

    public function testCreateOrderOk()
    {
        $validator = $this->getMockBuilder(
            'Symfony\Component\Validator\Validator\ValidatorInterface'
        )->disableOriginalConstructor()->getMock();
        $logger = $this->getMockBuilder('Psr\Log\LoggerInterface')->disableOriginalConstructor()->getMock();
        $eligibilityService = $this->getMockBuilder(
            'Omea\GestionTelco\PatesBundle\Services\Femto\EligibilityService'
        )->disableOriginalConstructor()->getMock();
        $deviceService = $this->getMockBuilder(
            'Omea\GestionTelco\PatesBundle\Services\Femto\DeviceService'
        )->disableOriginalConstructor()->getMock();
        $deviceService->method('createOrder')
            ->willReturn(true);
        $femtoUserService = $this->getMockBuilder(
            'Omea\GestionTelco\PatesBundle\Services\Femto\UserService'
        )->disableOriginalConstructor()->getMock();

        $patesService = new PatesService($validator, $logger, $eligibilityService, $deviceService, $femtoUserService);

        $createOrderRequest = new CreateOrderRequest('0601092885', 'CRM');
        $patesResponse = $patesService->createOrder($createOrderRequest);

        $expectedResponse = new BaseResponse(0, '');
        $this->assertEquals($expectedResponse, $patesResponse);

    }

    public function testCreateOrderKo()
    {
        $validator = $this->getMockBuilder(
            'Symfony\Component\Validator\Validator\ValidatorInterface'
        )->disableOriginalConstructor()->getMock();
        $logger = $this->getMockBuilder('Psr\Log\LoggerInterface')->disableOriginalConstructor()->getMock();
        $eligibilityService = $this->getMockBuilder(
            'Omea\GestionTelco\PatesBundle\Services\Femto\EligibilityService'
        )->disableOriginalConstructor()->getMock();
        $deviceService = $this->getMockBuilder(
            'Omea\GestionTelco\PatesBundle\Services\Femto\DeviceService'
        )->disableOriginalConstructor()->getMock();
        $deviceService->method('createOrder')
            ->will($this->throwException(new \Omea\GestionTelco\PatesBundle\Exception\NotFoundException('test KO')));
        $femtoUserService = $this->getMockBuilder(
            'Omea\GestionTelco\PatesBundle\Services\Femto\UserService'
        )->disableOriginalConstructor()->getMock();

        $patesService = new PatesService($validator, $logger, $eligibilityService, $deviceService, $femtoUserService);

        $createOrderRequest = new CreateOrderRequest('0601092885', 'CRM');
        $patesResponse = $patesService->createOrder($createOrderRequest);

        $expectedResponse = new BaseResponse(NotFoundException::NOT_FOUND_EXCEPTION, 'test KO');
        $this->assertEquals($expectedResponse, $patesResponse);
    }
}
