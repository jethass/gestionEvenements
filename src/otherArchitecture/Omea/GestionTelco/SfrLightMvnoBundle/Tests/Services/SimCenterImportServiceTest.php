<?php
namespace Omea\GestionTelco\SfrLightMvnoBundle\Tests\Services;

use Omea\Entity\Hexavia\AdresseRepository;
use Omea\GestionTelco\SfrLightMvnoBundle\Services\SimCenterImportService;
use org\bovigo\vfs\vfsStream;
use Symfony\Component\HttpKernel\Log\NullLogger;

class SimCenterImportServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \org\bovigo\vfs\vfsStreamDirectory
     */
    protected $streamRoot;

    public function setUp()
    {
        $this->streamRoot = vfsStream::setup('DATA', 777, array(
            'ERROR' => array(),
            'DONE' => array(),
            'TO_DO' => array(
                'valid_sim_center.txt' => file_get_contents(dirname(__DIR__) . '/Fixtures/valid_sim_center.txt'),
                'invalid_sim_center.txt' => file_get_contents(dirname(__DIR__) . '/Fixtures/invalid_sim_center.txt')
            ),
        ));
    }

    private function getRegistryMock()
    {
        $connectionMock = $this
            ->getMockBuilder('Doctrine\DBAL\Connection')
            ->disableOriginalConstructor()
            ->getMock();
        $connectionMock
            ->expects($this->any())
            ->method('beginTransaction')
            ->will($this->returnValue(null));
        $connectionMock
            ->expects($this->any())
            ->method('commit')
            ->will($this->returnValue(null));
        $connectionMock
            ->expects($this->any())
            ->method('rollback')
            ->will($this->returnValue(null));

        $repositoryMock = $this
            ->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $repositoryMock
            ->expects($this->any())
            ->method('find')
            ->will($this->returnValue(null));

        $entityManagerMock = $this
            ->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();
        $entityManagerMock
            ->expects($this->any())
            ->method('getConnection')
            ->will($this->returnValue($connectionMock));
        $entityManagerMock
            ->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($repositoryMock));
        $entityManagerMock
            ->expects($this->any())
            ->method('persist')
            ->will($this->returnValue(null));
        $entityManagerMock
            ->expects($this->any())
            ->method('flush')
            ->will($this->returnValue(null));
        $entityManagerMock
            ->expects($this->any())
            ->method('clear')
            ->will($this->returnValue(null));

        $registryMock = $this
            ->getMockBuilder('Symfony\Bridge\Doctrine\RegistryInterface')
            ->disableOriginalConstructor()
            ->getMock();
        $registryMock
            ->expects($this->any())
            ->method('getManager')
            ->will($this->returnValue($entityManagerMock));

        return $registryMock;
    }

    public function testImport()
    {
        $simCenterImportService = new SimCenterImportService(
            new NullLogger(),
            $this->getRegistryMock(),
            array('data_path' => $this->streamRoot->url())
        );

        $this->assertTrue($simCenterImportService->import(vfsStream::SCHEME."://".$this->streamRoot->path()));
        $this->assertTrue($this->streamRoot->hasChild('ERROR/invalid_sim_center.txt'));
        $this->assertTrue($this->streamRoot->hasChild('DONE/valid_sim_center.txt'));
    }
}