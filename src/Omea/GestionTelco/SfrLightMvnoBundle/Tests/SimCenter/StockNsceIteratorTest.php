<?php
namespace Omea\GestionTelco\SfrLightMvnoBundle\Tests\SimCenter;

use Omea\GestionTelco\SfrLightMvnoBundle\Entity\StockNsce;
use Omea\GestionTelco\SfrLightMvnoBundle\SimCenter\StockNsceIterator;

class StockNsceIteratorTest extends \PHPUnit_Framework_TestCase
{
    private $batchNumber = 1234;

    public function testSimCenterIteration()
    {
        $stockNsce1 = new StockNsce();
        $stockNsce2 = new StockNsce();
        $stockNsce3 = new StockNsce();

        $expected = array(
            $stockNsce1
                ->setImsi('482163719587025')
                ->setIccid('73466515343665')
                ->setPuk1('18428923')
                ->setPuk2('08849730')
                ->setLot($this->batchNumber),
            $stockNsce2
                ->setImsi('922473367754256')
                ->setIccid('99485229828521')
                ->setPuk1('76117844')
                ->setPuk2('31528050')
                ->setLot($this->batchNumber),
            $stockNsce3
                ->setImsi('668563778402656')
                ->setIccid('66847957745521')
                ->setPuk1('53342587')
                ->setPuk2('33351026')
                ->setLot($this->batchNumber),
        );

        $handle = fopen(dirname(__DIR__) . '/Fixtures/valid_sim_center.txt', 'rb');
        $iterator = new StockNsceIterator($handle, $this->batchNumber);

        $actual = array();
        foreach ($iterator as $stockNsce) {
            $actual[] = $stockNsce;
        }

        $this->assertEquals($expected, $actual);
    }

    public function testGetCount()
    {
        $handle = fopen(dirname(__DIR__) . '/Fixtures/valid_sim_center.txt', 'rb');
        $iterator = new StockNsceIterator($handle, $this->batchNumber);
        $this->assertEquals(3, $iterator->count());
    }
}