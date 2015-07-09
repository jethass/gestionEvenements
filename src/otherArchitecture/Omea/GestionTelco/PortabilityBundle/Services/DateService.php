<?php
namespace Omea\GestionTelco\PortabilityBundle\Services;

use Psr\Log\LoggerInterface;
use Doctrine\DBAL\Connection;

class DateService
{
    /** @var LoggerInterface */
    private $logger;

    /** @var array */
    private $config;

    /** @var Connection */
    private $mainDb;

    /** @var array */
    private $holidays = null;

    /**
     * @param LoggerInterface $logger
     * @param Connection      $mainDb
     * @param array           $portabilityConfig
     */
    public function __construct(
        LoggerInterface $logger,
        Connection $mainDb,
        array $portabilityConfig
    ) {
        $this->logger = $logger;
        $this->mainDb = $mainDb;
        $this->config = $portabilityConfig;
    }

    /** Calculates a date X open days after a given one
     * @param \DateTime the original date
     * @param int the number of open days to add [default = 0 => this returns either the current day if open, or the next open day]
     * @return \DateTime the new date
     */
    public function addOpenDays(\DateTime $date, $nbDays = 0)
    {
        $newDate = clone $date;
        while (!($open = $this->checkOpenDate($newDate)) && $nbDays > 0) {
            $newDate->add(new \DateInterval('P1D'));
            if ($open) {
                $nbDays--;
            }
        }
        return $newDate;
    }

    /** Check whether portability is possible on a given day
     * @param  DateTime $date
     * @return boolean
     */
    public function checkOpenDate(\DateTime $date)
    {
        $holidays = $this->getHolidays();
        if ($date->format('w') == '0') {
            // Sundays are a no-go
            return false;
        } elseif (in_array($date->format('d-m'), $holidays)) {
            // Holidays are a no-go too
            return false;
        } else {
            return true;
        }
    }

    private function getHolidays()
    {
        if (empty($this->holidays)) {
            $queryHolidays = 'SELECT VALEUR FROM PARAMETRAGE WHERE ID = ?';
            $holidays = $this->mainDb->fetchColumn($queryHolidays, array('PNM_JOURS_FERIES'), 0);
            $this->holidays = explode(';', $holidays);
        }
        return $this->holidays;
    }

    /** Checks whether a given date is within the allowed timeperiod for a given tranche
     * @param string   $tranche   the value of the tranche
     * @param string   $direction Whether we're in outgoing or incoming portability ('in' or 'out')
     * @param DateTime $date      the given date
     *                            return boolean
     */
    public function checkTranche($tranche, $direction, \DateTime $date)
    {
        if (!array_key_exists($tranche, $this->config['tranches']) || !array_key_exists($direction, $this->config['tranches'][$tranche])) {
            throw new \Exception("Unknown tranche {$tranche}");
        }
        $limits = $this->config['tranches'][$tranche][$direction];
        $hour = $date->format('H:i');
        if ($limits['start'] > $hour || $limits['end'] < $hour) {
            return false;
        } else {
            return true;
        }
    }
}
