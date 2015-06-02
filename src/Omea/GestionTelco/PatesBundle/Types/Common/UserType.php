<?php
namespace Omea\GestionTelco\PatesBundle\Types\Common;

class UserType
{
    /**
     * @var string
     */
    public $msisdn;

    /**
     * @var string
     */
    public $imsi;

    /**
     * @var integer
     */
    public $etat;

    /**
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param int $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return string
     */
    public function getImsi()
    {
        return $this->imsi;
    }

    /**
     * @param string $imsi
     */
    public function setImsi($imsi)
    {
        $this->imsi = $imsi;
    }

    /**
     * @return string
     */
    public function getMsisdn()
    {
        return $this->msisdn;
    }

    /**
     * @param string $msisdn
     */
    public function setMsisdn($msisdn)
    {
        $this->msisdn = $msisdn;
    }
}
