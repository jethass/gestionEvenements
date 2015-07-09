<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Omea\Entity\Fidelisation\AcceptationActe;

/**
 * @ORM\Table(name="OPTIONS_CLIENT")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\OptionsClientRepository")
 */
class OptionsClient
{

    /**
     * @var integer $idOc
     * @ORM\Column(name="ID_OC", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idOc;

    /**
     *
     * @var integer $idClient
     * @ORM\Column(name="ID_CLIENT", type="integer")
     */
    private $idClient;

    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="optionsClient")
     * @ORM\JoinColumn(name="ID_CLIENT", referencedColumnName = "ID_CLIENT")
     */
    private $client;

    /**
     *
     * @var integer $idForfaitOption
     * @ORM\Column(name="ID_FORFAIT_OPTION", type="integer")
     */
    private $idForfaitOption;

    /**
     * @ORM\ManyToOne(targetEntity="ForfaitOptions", inversedBy="optionsClient")
     * @ORM\JoinColumn(name="ID_FORFAIT_OPTION", referencedColumnName = "ID_FORFAIT_OPTION")
     */
    private $forfaitOption;

    /**
     *
     * @var integer $dateDebut
     *
     * @ORM\Column(name="DATE_DEBUT", type="datetime")
     */
    private $dateDebut;

    /**
     *
     * @var integer $dateFin
     *
     * @ORM\Column(name="DATE_FIN", type="datetime")
     */
    private $dateFin;

    /**
     *
     * @var integer $provisioningAuto
     *
     * @ORM\Column(name="PROVISIONING_AUTO", type="datetime")
     */
    private $provisioningAuto;

    /**
     *
     * @var integer $deprovisioningAuto
     *
     * @ORM\Column(name="DEPROVISIONING_AUTO", type="datetime", nullable=true)
     */
    private $deprovisioningAuto;

    /**
     *
     * @var integer $idSeg
     *
     * @ORM\Column(name="ID_SEG", type="integer")
     */
    private $idSeg;

    /**
     *
     * @var integer $idMig
     *
     * @ORM\Column(name="ID_MIG", type="integer")
     */
    private $idMig;

    /**
     *
     * @var integer $idSegDelaiFinOption
     *
     * @ORM\Column(name="ID_SEG_DELAI_FIN_OPTION", type="integer")
     */
    private $idSegDelaiFinOption;

    /**
     *
     * @var integer $dlv
     *
     * @ORM\Column(name="DLV", type="integer")
     */
    private $dlv;

    /**
     *
     * @var integer $dateDemande
     *
     * @ORM\Column(name="DATE_DEMANDE", type="datetime")
     */
    private $dateDemande;

    /**
     *
     * @var integer $idConseiller
     *
     * @ORM\Column(name="ID_CONSEILLER", type="integer")
     */
    private $idConseiller;

    /**
     *
     * @var integer $idActivite
     *
     * @ORM\Column(name="ID_ACTIVITE", type="integer")
     */
    private $idActivite;

    /**
     * @return ForfaitOptions $forfaitOption
     */
    public function getForfaitOption()
    {
        return $this->forfaitOption;
    }

    /**
     * @param field_type $forfaitOption
     */
    public function setForfaitOption($forfaitOption)
    {
        $this->forfaitOption = $forfaitOption;
    }

    /**
     *
     * @return the $client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     *
     * @param field_type $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     *
     * @return the $idOc
     */
    public function getIdOc()
    {
        return $this->idOc;
    }

    /**
     *
     * @return the $idClient
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     *
     * @return the $idForfaitOption
     */
    public function getIdForfaitOption()
    {
        return $this->idForfaitOption;
    }

    /**
     *
     * @return the $dateDebut
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     *
     * @return the $dateFin
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     *
     * @return the $provisioningAuto
     */
    public function getProvisioningAuto()
    {
        return $this->provisioningAuto;
    }

    /**
     *
     * @return the $deprovisioningAuto
     */
    public function getDeprovisioningAuto()
    {
        return $this->deprovisioningAuto;
    }

    /**
     *
     * @return the $idSeg
     */
    public function getIdSeg()
    {
        return $this->idSeg;
    }

    /**
     *
     * @return the $idMig
     */
    public function getIdMig()
    {
        return $this->idMig;
    }

    /**
     *
     * @return the $idSegDelaiFinOption
     */
    public function getIdSegDelaiFinOption()
    {
        return $this->idSegDelaiFinOption;
    }

    /**
     *
     * @return the $dlv
     */
    public function getDlv()
    {
        return $this->dlv;
    }

    /**
     *
     * @return the $dateDemande
     */
    public function getDateDemande()
    {
        return $this->dateDemande;
    }

    /**
     *
     * @return the $idConseiller
     */
    public function getIdConseiller()
    {
        return $this->idConseiller;
    }

    /**
     *
     * @return the $idActivite
     */
    public function getIdActivite()
    {
        return $this->idActivite;
    }

    /**
     *
     * @param integer $idOc
     */
    public function setIdOc($idOc)
    {
        $this->idOc = $idOc;
    }

    /**
     *
     * @param field_type $idClient
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }

    /**
     *
     * @param integer $idForfaitOption
     */
    public function setIdForfaitOption($idForfaitOption)
    {
        $this->idForfaitOption = $idForfaitOption;
    }

    /**
     *
     * @param date $dateDebut
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     *
     * @param date $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    /**
     *
     * @param date $provisioningAuto
     */
    public function setProvisioningAuto($provisioningAuto)
    {
        $this->provisioningAuto = $provisioningAuto;
    }

    /**
     *
     * @param date $deprovisioningAuto
     */
    public function setDeprovisioningAuto($deprovisioningAuto)
    {
        $this->deprovisioningAuto = $deprovisioningAuto;
    }

    /**
     *
     * @param date $idSeg
     */
    public function setIdSeg($idSeg)
    {
        $this->idSeg = $idSeg;
    }

    /**
     *
     * @param date $idMig
     */
    public function setIdMig($idMig)
    {
        $this->idMig = $idMig;
    }

    /**
     *
     * @param date $idSegDelaiFinOption
     */
    public function setIdSegDelaiFinOption($idSegDelaiFinOption)
    {
        $this->idSegDelaiFinOption = $idSegDelaiFinOption;
    }

    /**
     *
     * @param date $dlv
     */
    public function setDlv($dlv)
    {
        $this->dlv = $dlv;
    }

    /**
     *
     * @param date $dateDemande
     */
    public function setDateDemande($dateDemande)
    {
        $this->dateDemande = $dateDemande;
    }

    /**
     *
     * @param date $idConseiller
     */
    public function setIdConseiller($idConseiller)
    {
        $this->idConseiller = $idConseiller;
    }

    /**
     *
     * @param date $idActivite
     */
    public function setIdActivite($idActivite)
    {
        $this->idActivite = $idActivite;
    }
}
