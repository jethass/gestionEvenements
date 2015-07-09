<?php
namespace Omea\GestionTelco\SfrLightMvnoBundle\Tests\SimCenter;

use Omea\GestionTelco\SfrLightMvnoBundle\SimCenter\SimCenterParser;

class SimCenterParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SimCenterParser
     */
    protected $invalidSimCenter;

    /**
     * @var SimCenterParser
     */
    protected $validSimCenter;

    public function setUp()
    {
        $this->invalidSimCenter = new SimCenterParser(dirname(__DIR__) . '/Fixtures/invalid_sim_center.txt');
        $this->validSimCenter = new SimCenterParser(dirname(__DIR__) . '/Fixtures/valid_sim_center.txt');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testMissingStream()
    {
        new SimCenterParser(null);
    }

    public function testGetStream()
    {
        $this->assertTrue(is_resource($this->validSimCenter->getStream()));
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testGetStreamWithUnexistingFilename()
    {
        $simCenterParser = new SimCenterParser('unexisting_filename');
        $simCenterParser->getStream();
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testGetStreamWithInvalidSimCenter()
    {
        $this->invalidSimCenter->getStream();
    }

    public function testGetBatchNumber()
    {
        $batchNumber = $this->validSimCenter->getBatchNumber();
        $this->assertEquals(12345, $batchNumber);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testGetBatchNumberWithMissingBatchNumber()
    {
        $this->invalidSimCenter->getBatchNumber();
    }

    public function testGetChecksum()
    {
        $this->assertEquals(1234, $this->validSimCenter->getChecksum());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testGetChecksumWithInvalidChecksum()
    {
        $this->invalidSimCenter->getChecksum();
    }

    public function testGetStockNsceIterator()
    {
        $this->assertInstanceOf(
            'Omea\GestionTelco\SfrLightMvnoBundle\SimCenter\StockNsceIterator',
            $this->validSimCenter->getStockNsceIterator()
        );
    }

    public function testIsValid()
    {
        $this->assertTrue($this->validSimCenter->isValid());
    }

    public function testIsValidWithInvalidSimCenter()
    {
        $this->assertFalse($this->invalidSimCenter->isValid());
    }
}