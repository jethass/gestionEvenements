<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="STOCK_STB")
 * @ORM\Entity
 */
class StockStb
{

    /**
     *
     *      @ORM\Column(name="ID", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     *      @ORM\Column(name="ID_ART", type="integer")
     */
    private $idArt;
    
    /**
     * @ORM\ManyToOne(targetEntity="Contrat")
     * @ORM\JoinColumn(name="ID_CONTRAT", referencedColumnName="ID_CONTRAT", nullable=true)
     */
    private $idContrat;

    /**
     *
     *      @ORM\Column(name="ID_CMD", type="integer")
     */
    private $idCmd;
    
    /**
     *
     *      @ORM\Column(name="ID_ENT", type="integer")
     */
    private $idEnt;
    
    /**
     *
     *      @ORM\Column(name="ID_DIS", type="integer")
     */
    private $idDis;
    
    /**
     *
     *      @ORM\Column(name="ID_MAG", type="integer")
     */
    private $idMag;
    
    /**
     *
     *      @ORM\Column(name="ID_CTR", type="integer")
     */
    private $idCtr;
    
    /**
     *
     *      @ORM\Column(name="ID_CET", type="integer")
     */
    private $idCet;
    
    /**
     *
     *      @ORM\Column(name="NUMERO_SN", type="string")
     */
    private $numeroSn;
    
    /**
     *
     *      @ORM\Column(name="NUMERO_PN", type="string")
     */
    private $numeroPn;
    
    /**
     *
     *      @ORM\Column(name="MAC_ADRESSE", type="string")
     */
    private $macAdresse;
    
    /**
     *
     *      @ORM\Column(name="ETAT_LIVRAISON", type="string")
     */
    private $etatLivraison;
    
    /**
     *
     *      @ORM\Column(name="ETAT_COLIS_IBACK", type="string")
     */
    private $etatColisIback;
    
    /**
     *
     *      @ORM\Column(name="DATE_CREATION", type="integer")
     */
    private $dateCreation;
    
    /**
     *
     *      @ORM\Column(name="DATE_MODIFICATION", type="integer")
     */
    private $dateModification;
    
    /**
     *
     *      @ORM\Column(name="TYPE_EQUIPEMENT", type="string")
     */
    private $typeEquipement;
    
    /**
     *
     *      @ORM\Column(name="DATE_ASSOCIATION", type="datetime")
     */
    private $dateAssociation;
    
    /**
     *
     *      @ORM\Column(name="DATE_IMPORT_MOBILTRON", type="datetime")
     */
    private $dateImportMobiltron;
    
    /**
     *
     *      @ORM\Column(name="ID_CDT", type="integer")
     */
    private $idCdt;
    
    /**
     *
     *      @ORM\Column(name="LOT", type="integer")
     */
    private $lot;
    
    /**
     *
     *      @ORM\Column(name="TYPE_GESTION", type="string")
     */
    private $typeGestion;
    
    /**
     *
     *      @ORM\Column(name="ID_ES", type="integer")
     */
    private $idEs;
    
    /**
     *
     *      @ORM\Column(name="DATE_RESTITUTION", type="datetime")
     */
    private $dateRestitution;
    
	/**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

	/**
     * @return the $idArt
     */
    public function getIdArt()
    {
        return $this->idArt;
    }

	/**
     * @return the $idContrat
     */
    public function getIdContrat()
    {
        return $this->idContrat;
    }

	/**
     * @return the $idCmd
     */
    public function getIdCmd()
    {
        return $this->idCmd;
    }

	/**
     * @return the $idEnt
     */
    public function getIdEnt()
    {
        return $this->idEnt;
    }

	/**
     * @return the $idDis
     */
    public function getIdDis()
    {
        return $this->idDis;
    }

	/**
     * @return the $idMag
     */
    public function getIdMag()
    {
        return $this->idMag;
    }

	/**
     * @return the $idCtr
     */
    public function getIdCtr()
    {
        return $this->idCtr;
    }

	/**
     * @return the $idCet
     */
    public function getIdCet()
    {
        return $this->idCet;
    }

	/**
     * @return the $numeroSn
     */
    public function getNumeroSn()
    {
        return $this->numeroSn;
    }

	/**
     * @return the $numeroPn
     */
    public function getNumeroPn()
    {
        return $this->numeroPn;
    }

	/**
     * @return the $macAdresse
     */
    public function getMacAdresse()
    {
        return $this->macAdresse;
    }

	/**
     * @return the $etatLivraison
     */
    public function getEtatLivraison()
    {
        return $this->etatLivraison;
    }

	/**
     * @return the $etatColisIback
     */
    public function getEtatColisIback()
    {
        return $this->etatColisIback;
    }

	/**
     * @return the $dateCreation
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

	/**
     * @return the $dateModification
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

	/**
     * @return the $typeEquipement
     */
    public function getTypeEquipement()
    {
        return $this->typeEquipement;
    }

	/**
     * @return the $dateAssociation
     */
    public function getDateAssociation()
    {
        return $this->dateAssociation;
    }

	/**
     * @return the $dateImportMobiltron
     */
    public function getDateImportMobiltron()
    {
        return $this->dateImportMobiltron;
    }

	/**
     * @return the $idCdt
     */
    public function getIdCdt()
    {
        return $this->idCdt;
    }

	/**
     * @return the $lot
     */
    public function getLot()
    {
        return $this->lot;
    }

	/**
     * @return the $typeGestion
     */
    public function getTypeGestion()
    {
        return $this->typeGestion;
    }

	/**
     * @return the $idEs
     */
    public function getIdEs()
    {
        return $this->idEs;
    }

	/**
     * @return the $dateRestitution
     */
    public function getDateRestitution()
    {
        return $this->dateRestitution;
    }

	/**
     * @param field_type $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

	/**
     * @param field_type $idArt
     */
    public function setIdArt($idArt)
    {
        $this->idArt = $idArt;
    }

	/**
     * @param field_type $idContrat
     */
    public function setIdContrat($idContrat)
    {
        $this->idContrat = $idContrat;
    }

	/**
     * @param field_type $idCmd
     */
    public function setIdCmd($idCmd)
    {
        $this->idCmd = $idCmd;
    }

	/**
     * @param field_type $idEnt
     */
    public function setIdEnt($idEnt)
    {
        $this->idEnt = $idEnt;
    }

	/**
     * @param field_type $idDis
     */
    public function setIdDis($idDis)
    {
        $this->idDis = $idDis;
    }

	/**
     * @param field_type $idMag
     */
    public function setIdMag($idMag)
    {
        $this->idMag = $idMag;
    }

	/**
     * @param field_type $idCtr
     */
    public function setIdCtr($idCtr)
    {
        $this->idCtr = $idCtr;
    }

	/**
     * @param field_type $idCet
     */
    public function setIdCet($idCet)
    {
        $this->idCet = $idCet;
    }

	/**
     * @param field_type $numeroSn
     */
    public function setNumeroSn($numeroSn)
    {
        $this->numeroSn = $numeroSn;
    }

	/**
     * @param field_type $numeroPn
     */
    public function setNumeroPn($numeroPn)
    {
        $this->numeroPn = $numeroPn;
    }

	/**
     * @param field_type $macAdresse
     */
    public function setMacAdresse($macAdresse)
    {
        $this->macAdresse = $macAdresse;
    }

	/**
     * @param field_type $etatLivraison
     */
    public function setEtatLivraison($etatLivraison)
    {
        $this->etatLivraison = $etatLivraison;
    }

	/**
     * @param field_type $etatColisIback
     */
    public function setEtatColisIback($etatColisIback)
    {
        $this->etatColisIback = $etatColisIback;
    }

	/**
     * @param field_type $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

	/**
     * @param field_type $dateModification
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;
    }

	/**
     * @param field_type $typeEquipement
     */
    public function setTypeEquipement($typeEquipement)
    {
        $this->typeEquipement = $typeEquipement;
    }

	/**
     * @param field_type $dateAssociation
     */
    public function setDateAssociation($dateAssociation)
    {
        $this->dateAssociation = $dateAssociation;
    }

	/**
     * @param field_type $dateImportMobiltron
     */
    public function setDateImportMobiltron($dateImportMobiltron)
    {
        $this->dateImportMobiltron = $dateImportMobiltron;
    }

	/**
     * @param field_type $idCdt
     */
    public function setIdCdt($idCdt)
    {
        $this->idCdt = $idCdt;
    }

	/**
     * @param field_type $lot
     */
    public function setLot($lot)
    {
        $this->lot = $lot;
    }

	/**
     * @param field_type $typeGestion
     */
    public function setTypeGestion($typeGestion)
    {
        $this->typeGestion = $typeGestion;
    }

	/**
     * @param field_type $idEs
     */
    public function setIdEs($idEs)
    {
        $this->idEs = $idEs;
    }

	/**
     * @param field_type $dateRestitution
     */
    public function setDateRestitution($dateRestitution)
    {
        $this->dateRestitution = $dateRestitution;
    }

    
    
    
    
    
}
