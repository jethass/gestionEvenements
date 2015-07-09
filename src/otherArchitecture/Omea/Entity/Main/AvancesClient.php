<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="AVANCES_CLIENT")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\AvancesClientRepository")
 */
class AvancesClient
{
    /**
     *
     * @var integer $id
     * @ORM\Column(name="ID_AC", type="integer", precision=10)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idAvanceClient;

    /**
     *
     * @var integer $idArt
     * @ORM\Column(name="ID_ART", type="integer", precision=10, nullable=false)
     */
    private $idArt;

    /**
     *
     * @var integer $idTrans
     * @ORM\Column(name="ID_TRANS", type="integer", precision=10, nullable=false)
     */
    private $idTrans;

    /**
     *
     * @var string $typeAvance
     * @ORM\Column(name="TYPE_AVANCE", type="string", length=3, nullable=false)
     */
    private $typeAvance;

    /**
     * @var AvancesType $avancesType
     * @ORM\OneToOne(targetEntity="AvancesType")
     * @ORM\JoinColumn(name="TYPE_AVANCE", referencedColumnName="TYPE_AVANCE")
     */
    private $avancesType;

    /**
     *
     * @var float $montant
     * @ORM\Column(name="MONTANT", type="float", nullable=false)
     */
    private $montant;

    /**
     *
     * @var string $codeMedia
     * @ORM\Column(name="CODE_MEDIA", type="string", length=4, nullable=false)
     */
    private $codeMedia;

    /**
     *
     * @var datetime $dateCreation
     * @ORM\Column(name="DATE_CREATION", type="datetime", nullable=false)
     */
    private $dateCreation;

    /**
     *
     * @var datetime $dateModification
     * @ORM\Column(name="DATE_MODIFICATION", type="datetime", nullable=false)
     */
    private $dateModification;

    /**
     *
     * @var datetime $dateMailRelance
     * @ORM\Column(name="DATE_MAIL_RELANCE", type="datetime", nullable=false)
     */
    private $dateMailRelance;

    /**
     *
     * @var integer $etat
     * @ORM\Column(name="ETAT", type="integer", precision=10, nullable=false)
     */
    private $etat;

    /**
     * @param string $codeMedia
     */
    public function setCodeMedia( $codeMedia )
    {
        $this->codeMedia = $codeMedia;
    }

    /**
     * @return string
     */
    public function getCodeMedia()
    {
        return $this->codeMedia;
    }

    /**
     * @param \Omea\Entity\Main\datetime $dateCreation
     */
    public function setDateCreation( $dateCreation )
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return \Omea\Entity\Main\datetime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param \Omea\Entity\Main\datetime $dateMailRelance
     */
    public function setDateMailRelance( $dateMailRelance )
    {
        $this->dateMailRelance = $dateMailRelance;
    }

    /**
     * @return \Omea\Entity\Main\datetime
     */
    public function getDateMailRelance()
    {
        return $this->dateMailRelance;
    }

    /**
     * @param \Omea\Entity\Main\datetime $dateModification
     */
    public function setDateModification( $dateModification )
    {
        $this->dateModification = $dateModification;
    }

    /**
     * @return \Omea\Entity\Main\datetime
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * @param int $etat
     */
    public function setEtat( $etat )
    {
        $this->etat = $etat;
    }

    /**
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param int $idArt
     */
    public function setIdArt( $idArt )
    {
        $this->idArt = $idArt;
    }

    /**
     * @return int
     */
    public function getIdArt()
    {
        return $this->idArt;
    }

    /**
     * @param int $idAvanceClient
     */
    public function setIdAvanceClient( $idAvanceClient )
    {
        $this->idAvanceClient = $idAvanceClient;
    }

    /**
     * @return int
     */
    public function getIdAvanceClient()
    {
        return $this->idAvanceClient;
    }

    /**
     * @param int $idTrans
     */
    public function setIdTrans( $idTrans )
    {
        $this->idTrans = $idTrans;
    }

    /**
     * @return int
     */
    public function getIdTrans()
    {
        return $this->idTrans;
    }

    /**
     * @param float $montant
     */
    public function setMontant( $montant )
    {
        $this->montant = $montant;
    }

    /**
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param string $typeAvance
     */
    public function setTypeAvance( $typeAvance )
    {
        $this->typeAvance = $typeAvance;
    }

    /**
     * @return string
     */
    public function getTypeAvance()
    {
        return $this->typeAvance;
    }

    /**
     * @param \Omea\Entity\Main\AvancesType $avancesType
     */
    public function setAvancesType( $avancesType )
    {
        $this->avancesType = $avancesType;
    }

    /**
     * @return \Omea\Entity\Main\AvancesType
     */
    public function getAvancesType()
    {
        return $this->avancesType;
    }


}