<?php

namespace Omea\GestionTelco\SfrLightMvnoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Omea\GestionTelco\SfrLightMvnoBundle\Entity\StockNsce
 *
 * @ORM\Table(name="STOCK_NSCE")
 * @ORM\Entity()
 */
class StockNsce
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_STOCK_NSCE", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idStockNsce;

    /**
     * @var string
     *
     * @ORM\Column(name="MSISDN", type="string", length=10)
     */
    private $msisdn;

    /**
     * @ORM\ManyToOne(targetEntity="Omea\GestionTelco\SfrLightMvnoBundle\Entity\EtatStock")
     * @ORM\JoinColumn(name="ID_ES", referencedColumnName="ID_ES")
     */
    private $etatStock;

    /**
     * @var string
     *
     * @ORM\Column(name="IMSI", type="string", length=15)
     */
    private $imsi;

    /**
     * @var string
     *
     * @ORM\Column(name="PUK1", type="string", length=8)
     */
    private $puk1;

    /**
     * @var string
     *
     * @ORM\Column(name="PUK2", type="string", length=8)
     */
    private $puk2;

    /**
     * @ORM\ManyToOne(targetEntity="Omea\GestionTelco\SfrLightMvnoBundle\Entity\EtatEntite")
     * @ORM\JoinColumn(name="ETAT", referencedColumnName="ID_ETAT")
     */
    private $etatEntite;

    /**
     * @var string
     *
     * @ORM\Column(name="LOT", type="string", length=20)
     */
    private $lot;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SIM_TYPE", type="integer")
     */
    private $idSimType;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_NETWORK", type="integer")
     */
    private $idNetwork;

    /**
     * @var string
     *
     * @ORM\Column(name="ICCID", type="string", length=14)
     */
    private $iccid;

    const SIM_TYPE_TRIPLE_DECOUPE_AQUISITION = 18;
    const ID_NETWORK_SFR = 2;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idStockNsce
     *
     * @param integer $idStockNsce
     * @return StockNsce
     */
    public function setIdStockNsce($idStockNsce)
    {
        $this->idStockNsce = $idStockNsce;
    
        return $this;
    }

    /**
     * Get idStockNsce
     *
     * @return integer 
     */
    public function getIdStockNsce()
    {
        return $this->idStockNsce;
    }

    /**
     * Set msisdn
     *
     * @param string $msisdn
     * @return StockNsce
     */
    public function setMsisdn($msisdn)
    {
        $this->msisdn = $msisdn;
    
        return $this;
    }

    /**
     * Get msisdn
     *
     * @return string 
     */
    public function getMsisdn()
    {
        return $this->msisdn;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     * @return StockNsce
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    
        return $this;
    }

    /**
     * Get etat
     *
     * @return integer 
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set idEs
     *
     * @param integer $idEs
     * @return StockNsce
     */
    public function setIdEs($idEs)
    {
        $this->idEs = $idEs;
    
        return $this;
    }

    /**
     * Get idEs
     *
     * @return integer 
     */
    public function getIdEs()
    {
        return $this->idEs;
    }

    /**
     * Set imsi
     *
     * @param string $imsi
     * @return StockNsce
     */
    public function setImsi($imsi)
    {
        $this->imsi = $imsi;
    
        return $this;
    }

    /**
     * Get imsi
     *
     * @return string 
     */
    public function getImsi()
    {
        return $this->imsi;
    }

    /**
     * Set puk1
     *
     * @param string $puk1
     * @return StockNsce
     */
    public function setPuk1($puk1)
    {
        $this->puk1 = $puk1;
    
        return $this;
    }

    /**
     * Get puk1
     *
     * @return string 
     */
    public function getPuk1()
    {
        return $this->puk1;
    }

    /**
     * Set puk2
     *
     * @param string $puk2
     * @return StockNsce
     */
    public function setPuk2($puk2)
    {
        $this->puk2 = $puk2;
    
        return $this;
    }

    /**
     * Get puk2
     *
     * @return string 
     */
    public function getPuk2()
    {
        return $this->puk2;
    }

    /**
     * Set lot
     *
     * @param string $lot
     * @return StockNsce
     */
    public function setLot($lot)
    {
        $this->lot = $lot;
    
        return $this;
    }

    /**
     * Get lot
     *
     * @return string 
     */
    public function getLot()
    {
        return $this->lot;
    }

    /**
     * Set isSimType
     *
     * @param integer $isSimType
     * @return StockNsce
     */
    public function setIsSimType($isSimType)
    {
        $this->isSimType = $isSimType;
    
        return $this;
    }

    /**
     * Get isSimType
     *
     * @return integer 
     */
    public function getIsSimType()
    {
        return $this->isSimType;
    }

    /**
     * Set idNetwork
     *
     * @param integer $idNetwork
     * @return StockNsce
     */
    public function setIdNetwork($idNetwork)
    {
        $this->idNetwork = $idNetwork;
    
        return $this;
    }

    /**
     * Get idNetwork
     *
     * @return integer 
     */
    public function getIdNetwork()
    {
        return $this->idNetwork;
    }

    /**
     * @return string
     */
    public function getIccid()
    {
        return $this->iccid;
    }

    /**
     * @param string $iccid
     */
    public function setIccid($iccid)
    {
        $this->iccid = $iccid;

        return $this;
    }


    /**
     * Set idSimType
     *
     * @param integer $idSimType
     * @return StockNsce
     */
    public function setIdSimType($idSimType)
    {
        $this->idSimType = $idSimType;
    
        return $this;
    }

    /**
     * Get idSimType
     *
     * @return integer 
     */
    public function getIdSimType()
    {
        return $this->idSimType;
    }

    /**
     * Set etatStock
     *
     * @param \Omea\GestionTelco\SfrLightMvnoBundle\Entity\EtatStock $etatStock
     * @return StockNsce
     */
    public function setEtatStock(\Omea\GestionTelco\SfrLightMvnoBundle\Entity\EtatStock $etatStock = null)
    {
        $this->etatStock = $etatStock;
    
        return $this;
    }

    /**
     * Get etatStock
     *
     * @return \Omea\GestionTelco\SfrLightMvnoBundle\Entity\EtatStock 
     */
    public function getEtatStock()
    {
        return $this->etatStock;
    }

    /**
     * Set etatEntite
     *
     * @param \Omea\GestionTelco\SfrLightMvnoBundle\Entity\EtatEntite $etatEntite
     * @return StockNsce
     */
    public function setEtatEntite(\Omea\GestionTelco\SfrLightMvnoBundle\Entity\EtatEntite $etatEntite = null)
    {
        $this->etatEntite = $etatEntite;
    
        return $this;
    }

    /**
     * Get etatEntite
     *
     * @return \Omea\GestionTelco\SfrLightMvnoBundle\Entity\EtatEntite 
     */
    public function getEtatEntite()
    {
        return $this->etatEntite;
    }
}