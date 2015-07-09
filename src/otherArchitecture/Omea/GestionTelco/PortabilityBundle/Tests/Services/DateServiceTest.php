<?php
namespace Omea\GestionTelco\PortabilityBundle\Tests\Services;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DateServiceTest extends KernelTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->bootKernel();
    }

    public function testcheckTranche()
    {
        $dateService = self::$kernel->getContainer()->get('omea_gestion_telco_portability.services.date');

        $this->assertTrue($dateService->checkTranche('11', 'in', new \DateTime('2015-01-01 10:00:00')));
    }
}
