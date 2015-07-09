<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="CLIENT_PRO")
 * @ORM\Entity
 */
class ClientPro
{

    /**
     *
     * @var integer $idClientPro
     *
     *      @ORM\Column(name="ID_CLIENT_PRO", type="integer", length=10)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idClientPro;

    /**
     *
     * @var string $raisonSociale
     *
     *      @ORM\Column(name="RAISON_SOCIALE", type="string", length=100)
     */
    private $raisonSociale;

    /**
     *
     * @var string $siren
     *
     *      @ORM\Column(name="SIREN", type="string", length=9, nullable=true)
     */
    private $siren;

    /**
     *
     * @var string $siret
     *
     *      @ORM\Column(name="SIRET", type="string", length=14, nullable=true)
     */
    private $siret;

    /**
     *
     * @var integer $idSocType
     *
     *      @ORM\Column(name="ID_SOC_TYPE", type="integer", length=10)
     */
    private $idSocType;

    /**
     *
     * @var integer $capitalSociete
     *
     *      @ORM\Column(name="CAPITAL_SOCIETE", type="integer", length=10, nullable=true)
     */
    private $capitalSociete;

    /**
     *
     * @var smallint $scoreSociete
     *
     *      @ORM\Column(name="SCORE_SOCIETE", type="smallint")
     */
    private $scoreSociete;

    /**
     *
     * @var string $statusSociete
     *
     *      @ORM\Column(name="STATUS_SOCIETE", type="string", length=255)
     */
    private $statusSociete;

    /**
     *
     * @var string $statutBaseSiren
     *
     *      @ORM\Column(name="STATUS_BASE_SIREN", type="string", length=255)
     */
    private $statutBaseSiren;

    /**
     *
     * @var date $dateCreationSociete
     *
     *      @ORM\Column(name="DATE_CREATION_SOCIETE", type="date", nullable=true)
     */
    private $dateCreationSociete;

    /**
     *
     * @var date $dateFermetureSociete
     *
     *      @ORM\Column(name="DATE_FERMETURE_SOCIETE", type="date", nullable=true)
     */
    private $dateFermetureSociete;

    /**
     *
     * @var integer $adresse
     *
     *
     *      @ORM\ManyToOne(targetEntity="Adresse", cascade={"persist", "merge"})
     *      @ORM\JoinColumn(name="ID_ADRESSE", referencedColumnName = "ID")
     */
    private $adresse;

    // #------------------------------- Getter et Setter
    public function getIdClientPro()
    {
        return $this->idClientPro;
    }

    public function setIdClientPro($idClientPro)
    {
        $this->idClientPro = $idClientPro;
    }

    public function getRaisonSociale()
    {
        return $this->raisonSociale;
    }

    public function setRaisonSociale($raisonSociale)
    {
        $this->raisonSociale = $raisonSociale;
    }

    public function getSiren()
    {
        return $this->siren;
    }

    public function setSiren($siren)
    {
        $this->siren = $siren;
    }

    public function getSiret()
    {
        return $this->siret;
    }

    public function setSiret($siret)
    {
        $this->siret = $siret;
    }

    public function getIdSocType()
    {
        return $this->idSocType;
    }

    public function setIdSocType($idSocType)
    {
        $this->idSocType = $idSocType;
    }

    public function getCapitalSociete()
    {
        return $this->capitalSociete;
    }

    public function setCapitalSociete($capitalSociete)
    {
        $this->capitalSociete = $capitalSociete;
    }

    public function getScoreSociete()
    {
        return $this->scoreSociete;
    }

    public function setScoreSociete($scoreSociete)
    {
        $this->scoreSociete = $scoreSociete;
    }

    public function getStatutSociete()
    {
        return $this->statutSociete;
    }

    public function setStatutSociete($statutSociete)
    {
        $this->statutSociete = $statutSociete;
    }

    public function getStatutBaseSiren()
    {
        return $this->statutBaseSiren;
    }

    public function setStatutBaseSiren($statutBaseSiren)
    {
        $this->statutBaseSiren = $statutBaseSiren;
    }

    public function getDateCreationSociete()
    {
        return $this->dateCreationSociete;
    }

    public function setDateCreationSociete($dateCreationSociete)
    {
        $this->dateCreationSociete = $dateCreationSociete;
    }

    /*
     * public function getDateMaj() { return $this->dateMaj; } public function setDateMaj($dateMaj) { $this->dateMaj = $dateMaj; }
     */
    public function getDateFermetureSociete()
    {
        return $this->dateFermetureSociete;
    }

    public function setDateFermetureSociete($dateFermetureSociete)
    {
        $this->dateFermetureSociete = $dateFermetureSociete;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }
}
