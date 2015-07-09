<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="C010")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\C010Repository")
 */

class C010
{

    /**
     * @ORM\Column(name="ID_CLIENT", type="integer")
     * @ORM\Id
     *
     */
    private $idClient;

    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="transaction")
     * @ORM\JoinColumn(name="ID_CLIENT", referencedColumnName = "ID_CLIENT")
     */
    private $client;

    /**
     * @ORM\Column(name="TYPE_RESI", type="integer", nullable=true)
     */
    private $typeResi;

    /**
     * @ORM\Column(name="CYCLE", type="integer", nullable=false)
    */
    private $cycle;

    /**
     * @ORM\Column(name="TYPE_CONTRAT", type="string", length=8, nullable=false)
     */
    private $typeContrat;

    /**
     * @ORM\Column(name="CIVILITE", type="integer", nullable=false)
     */
    private $civilite;

    /**
     * @ORM\Column(name="NOM", type="string", length=120, nullable=false)
     */
    private $nom;

    /**
     * @ORM\Column(name="PRENOM", type="string", length=120, nullable=false)
     */
    private $prenom;

    /**
     * @ORM\Column(name="NUM_ABO", type="integer", nullable=false)
     */
    private $numAbo;

    /**
     * @ORM\Column(name="MSISDN", type="integer", nullable=true)
     */
    private $msisdn;

    /**
     * @ORM\Column(name="CODE_BANQUE", type="integer", nullable=true)
     */
    private $codeBanque;

    /**
     * @ORM\Column(name="CODE_GUICHET", type="integer", nullable=true)
     */
    private $codeGuichet;

    /**
     * @ORM\Column(name="NUM_COMPTE", type="string", length=11, nullable=true)
     */
    private $numCompte;

    /**
     * @ORM\Column(name="CLE_RIB", type="integer", nullable=true)
     */
    private $cleRib;

    /**
     * @ORM\Column(name="BALANCE_CLIENT", type="decimal", nullable=true)
     */
    private $balanceClient;

    /**
     * @ORM\Column(name="ID_PA", type="string", length=120, nullable=true)
     */
    private $idPa;

    /**
     * @ORM\Column(name="NNE", type="string", length=6, nullable=false)
     */
    private $nne;

    /**
     * @ORM\Column(name="DATE_INSERTION", type="integer", nullable=true)
     */
    private $dateInsertion;

    /**
     * @ORM\Column(name="ID_FLUX", type="integer", nullable=true)
     */
    private $idFlux;

    /**
     * @ORM\Column(name="REMB_PAR_CHQ", type="integer", nullable=true)
     */
    private $rembParChq;

    /**
     * @ORM\Column(name="NUMERO_USUEL", type="integer", nullable=true)
     */
    private $numeroUsuel;

    /**
     * @ORM\Column(name="Is_TRAITE", type="integer", nullable=false)
     */
    private $isTraite;

    /**
     * @param mixed $isTraite
     */
    public function setIsTraite($isTraite)
    {
        $this->isTraite = $isTraite;
    }

    /**
     * @return mixed
     */
    public function getIsTraite()
    {
        return $this->isTraite;
    }

    /**
     * @param mixed $balanceClient
     */
    public function setBalanceClient($balanceClient)
    {
        $this->balanceClient = $balanceClient;
    }

    /**
     * @return mixed
     */
    public function getBalanceClient()
    {
        return $this->balanceClient;
    }

    /**
     * @param mixed $civilite
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;
    }

    /**
     * @return mixed
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * @param mixed $cleRib
     */
    public function setCleRib($cleRib)
    {
        $this->cleRib = $cleRib;
    }

    /**
     * @return mixed
     */
    public function getCleRib()
    {
        return $this->cleRib;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $codeBanque
     */
    public function setCodeBanque($codeBanque)
    {
        $this->codeBanque = $codeBanque;
    }

    /**
     * @return mixed
     */
    public function getCodeBanque()
    {
        return $this->codeBanque;
    }

    /**
     * @param mixed $codeGuichet
     */
    public function setCodeGuichet($codeGuichet)
    {
        $this->codeGuichet = $codeGuichet;
    }

    /**
     * @return mixed
     */
    public function getCodeGuichet()
    {
        return $this->codeGuichet;
    }

    /**
     * @param mixed $cycle
     */
    public function setCycle($cycle)
    {
        $this->cycle = $cycle;
    }

    /**
     * @return mixed
     */
    public function getCycle()
    {
        return $this->cycle;
    }

    /**
     * @param mixed $dateInsertion
     */
    public function setDateInsertion($dateInsertion)
    {
        $this->dateInsertion = $dateInsertion;
    }

    /**
     * @return mixed
     */
    public function getDateInsertion()
    {
        return $this->dateInsertion;
    }

    /**
     * @param mixed $idClient
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }

    /**
     * @return mixed
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * @param mixed $idFlux
     */
    public function setIdFlux($idFlux)
    {
        $this->idFlux = $idFlux;
    }

    /**
     * @return mixed
     */
    public function getIdFlux()
    {
        return $this->idFlux;
    }

    /**
     * @param mixed $idPa
     */
    public function setIdPa($idPa)
    {
        $this->idPa = $idPa;
    }

    /**
     * @return mixed
     */
    public function getIdPa()
    {
        return $this->idPa;
    }

    /**
     * @param mixed $msisdn
     */
    public function setMsisdn($msisdn)
    {
        $this->msisdn = $msisdn;
    }

    /**
     * @return mixed
     */
    public function getMsisdn()
    {
        return $this->msisdn;
    }

    /**
     * @param mixed $nne
     */
    public function setNne($nne)
    {
        $this->nne = $nne;
    }

    /**
     * @return mixed
     */
    public function getNne()
    {
        return $this->nne;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $numAbo
     */
    public function setNumAbo($numAbo)
    {
        $this->numAbo = $numAbo;
    }

    /**
     * @return mixed
     */
    public function getNumAbo()
    {
        return $this->numAbo;
    }

    /**
     * @param mixed $numCompte
     */
    public function setNumCompte($numCompte)
    {
        $this->numCompte = $numCompte;
    }

    /**
     * @return mixed
     */
    public function getNumCompte()
    {
        return $this->numCompte;
    }

    /**
     * @param mixed $numeroUsuel
     */
    public function setNumeroUsuel($numeroUsuel)
    {
        $this->numeroUsuel = $numeroUsuel;
    }

    /**
     * @return mixed
     */
    public function getNumeroUsuel()
    {
        return $this->numeroUsuel;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $rembParChq
     */
    public function setRembParChq($rembParChq)
    {
        $this->rembParChq = $rembParChq;
    }

    /**
     * @return mixed
     */
    public function getRembParChq()
    {
        return $this->rembParChq;
    }

    /**
     * @param mixed $typeContrat
     */
    public function setTypeContrat($typeContrat)
    {
        $this->typeContrat = $typeContrat;
    }

    /**
     * @return mixed
     */
    public function getTypeContrat()
    {
        return $this->typeContrat;
    }

    /**
     * @param mixed $typeResi
     */
    public function setTypeResi($typeResi)
    {
        $this->typeResi = $typeResi;
    }

    /**
     * @return mixed
     */
    public function getTypeResi()
    {
        return $this->typeResi;
    }
}
