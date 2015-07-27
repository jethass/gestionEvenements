<?php
namespace Omea\GestionTelco\PortabilityBundle\Tests\Services;

use Omea\GestionTelco\PortabilityBundle\Services\DateService;
use Psr\Log\NullLogger;

class DateServiceTest extends \PHPUnit_Framework_TestCase
{
    public function trancheProvider()
    {
        return array(array('test', 'in', '2015-01-15 10:30:20', false, false),
                     array('test', 'in', '2015-01-15 11:30:20', true, false),
                     array('test', 'in', '2015-01-15 12:30:20', false, false),
                     array('test', 'out', '2015-01-15 12:30:20', null, true),
                     array('random', 'in', '2015-01-15 12:30:20', null, true),
                    );
    }
    
    /** @dataProvider trancheProvider */
    public function testcheckTranche($tranche, $direction, $currentDate, $expected, $exception)
    {
        $logger = new NullLogger();
        $params = array('tranches' => array('test' => array('in' => array('start' => '11:00', 'end' => '12:00'))));
        $mainRepository = $this->getMockBuilder('Omea\GestionTelco\PortabilityBundle\Services\MainRepositoryService')->disableOriginalConstructor()->getMock();
        
        $date = new DateService($logger, $params, $mainRepository);
        
        if ($exception) {
            $this->setExpectedException('\Exception');
        }
        $result = $date->checkTranche($tranche, $direction, new \DateTime($currentDate));
        $this->assertEquals($result, $expected);
    }
    
    public function testcheckOpenDate()
    {
        $logger = new NullLogger();
        $params = array();
        $mainRepository = $this->getMockBuilder('Omea\GestionTelco\PortabilityBundle\Services\MainRepositoryService')->disableOriginalConstructor()->getMock();
        $mainRepository->expects($this->once())->method('getParametrage')->with($this->equalTo('PNM_JOURS_FERIES'))->willReturn('01-01;14-07');
        
        $date = new DateService($logger, $params, $mainRepository);
        
        $potentialDates = array('2015-01-01' => false, // Holiday
                                '2015-01-02' => true,  // Friday
                                '2015-01-04' => false, // Sunday
                                '2015-07-14' => false, // Holiday
                                );
        
        foreach ($potentialDates as $aDate => $ok) {
            $this->assertEquals($ok, $date->checkOpenDate(new \DateTime($aDate)), $aDate);
        }
    }
    
    public function openDaysProvider()
    {
        return array(array('2015-01-02', 0, '2015-01-02'), // Friday + 0 = original date
                     array('2015-01-02', 1, '2015-01-03'), // Friday + 1 = Saturday
                     array('2015-01-02', 2, '2015-01-05'), // Friday + 2 = Monday
                     array('2015-01-02', 6, '2015-01-09'), // Friday + 6 = Friday
                     array('2015-01-01', 0, '2015-01-02'), // Holiday + 0 = the next day
                     );
    }
    
    /** @dataProvider openDaysProvider */
    public function testAddOpenDays($initialDate, $nbDays, $expectedDate)
    {
        $logger = new NullLogger();
        $params = array();
        $mainRepository = $this->getMockBuilder('Omea\GestionTelco\PortabilityBundle\Services\MainRepositoryService')->disableOriginalConstructor()->getMock();
        $mainRepository->expects($this->once())->method('getParametrage')->with($this->equalTo('PNM_JOURS_FERIES'))->willReturn('01-01;14-07');
        
        $date = new DateService($logger, $params, $mainRepository);
        
        $expected = new \DateTime($expectedDate);

        $this->assertEquals($expected->format('Y-m-d'), $date->addOpenDays(new \DateTime($initialDate), $nbDays)->format('Y-m-d'));
    }
}
