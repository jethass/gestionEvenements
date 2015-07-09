<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="BOUQUET_TV_CONFIG")
 * @ORM\Entity
 */
class BouquetTvConfig
{

    /**
     *
     * @var string $codeSFR
     *
     *      @ORM\Column(name="CODE_SFR", type="string")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codeSfr;

    /**
     *
     * @var integer $idOption
     *
     *      @ORM\Column(name="ID_OPTION", type="integer")
     */
    private $idOption;
    
	/**
     * @return the $codeSfr
     */
    public function getCodeSfr()
    {
        return $this->codeSfr;
    }

	/**
     * @return the $idOption
     */
    public function getIdOption()
    {
        return $this->idOption;
    }

	/**
     * @param string $codeSfr
     */
    public function setCodeSfr($codeSfr)
    {
        $this->codeSfr = $codeSfr;
    }

	/**
     * @param number $idOption
     */
    public function setIdOption($idOption)
    {
        $this->idOption = $idOption;
    }
}
