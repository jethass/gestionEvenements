<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="PROMO_TV_CONFIG")
 * @ORM\Entity
 */
class PromoTvConfig
{

    /**
     *
     * @var string $codeSFR
     *
     *      @ORM\Column(name="CODE_BOUQUET_SFR", type="string")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codeBouquetSfr;

    /**
     *
     * @var integer $codePromoSfr
     *
     *      @ORM\Column(name="CODE_PROMO_SFR", type="integer")
     */
    private $codePromoSfr;

    /**
     *
     * @var integer $idOption
     *
     *      @ORM\Column(name="ID_OPTION", type="integer")
     */
    private $idOption;

    /**
     *
     * @var integer $dlv
     *
     *      @ORM\Column(name="DLV", type="integer")
     */
    private $dlv;

	/**
     * @return the $codeBouquetSfr
     */
    public function getCodeBouquetSfr()
    {
        return $this->codeBouquetSfr;
    }

	/**
     * @return the $codePromoSfr
     */
    public function getCodePromoSfr()
    {
        return $this->codePromoSfr;
    }

	/**
     * @return the $idOption
     */
    public function getIdOption()
    {
        return $this->idOption;
    }

	/**
     * @return the $dlv
     */
    public function getDlv()
    {
        return $this->dlv;
    }

	/**
     * @param string $codeBouquetSfr
     */
    public function setCodeBouquetSfr($codeBouquetSfr)
    {
        $this->codeBouquetSfr = $codeBouquetSfr;
    }

	/**
     * @param number $codePromoSfr
     */
    public function setCodePromoSfr($codePromoSfr)
    {
        $this->codePromoSfr = $codePromoSfr;
    }

	/**
     * @param number $idOption
     */
    public function setIdOption($idOption)
    {
        $this->idOption = $idOption;
    }

	/**
     * @param number $dlv
     */
    public function setDlv($dlv)
    {
        $this->dlv = $dlv;
    }


}