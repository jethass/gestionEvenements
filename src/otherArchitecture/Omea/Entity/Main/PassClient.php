<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="PASS_CLIENT")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\PassClientRepository")
 */
class PassClient
{

    /**
     *
     * @var integer $idPc
     *      @ORM\Column(name="ID_PC", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idPc;

    /**
     *
     * @var integer $idPass
     *
     *      @ORM\Column(name="ID_PASS", type="integer")
     */
    private $idPass;

    /**
     * @ORM\ManyToOne(targetEntity="Pass", inversedBy="passClient")
     * @ORM\JoinColumn(name="ID_PASS", referencedColumnName = "ID_PASS")
     */
    private $pass;

    /**
     *
     * @var integer $idClient
     *
     *      @ORM\Column(name="ID_CLIENT", type="integer")
     */
    private $idClient;

    /**
     * @ORM\ManyToOne(targetEntity="Client", cascade={"persist", "merge"}, inversedBy="passClient")
     * @ORM\JoinColumn(name="ID_CLIENT", referencedColumnName = "ID_CLIENT")
     */
    private $client;

    /**
     *
     * @var date $dateDemande
     *
     *      @ORM\Column(name="DATE_DEMANDE", type="datetime")
     */
    private $dateDemande;

    /**
     *
     * @var date $dateFin
     *
     *      @ORM\Column(name="DATE_FIN", type="datetime")
     */
    private $dateFin;

    /**
     *
     * @var integer $coderetour
     *
     *      @ORM\Column(name="CODE_RETOUR", type="integer")
     */
    private $codeRetour;

    /**
     * @return the $pass
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param field_type $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return the $option
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * @return the $client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param field_type $option
     */
    public function setOption($option)
    {
        $this->option = $option;
    }

    /**
     * @param field_type $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return the $idPc
     */
    public function getIdPc()
    {
        return $this->idPc;
    }

    /**
     * @return the $idPass
     */
    public function getIdPass()
    {
        return $this->idPass;
    }

    /**
     * @return the $idClient
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * @return the $dateDemande
     */
    public function getDateDemande()
    {
        return $this->dateDemande;
    }

    /**
     * @return the $dateFin
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @return the $codeRetour
     */
    public function getCodeRetour()
    {
        return $this->codeRetour;
    }

    /**
     * @param integer $idPc
     */
    public function setIdPc($idPc)
    {
        $this->idPc = $idPc;
    }

    /**
     * @param integer $idPass
     */
    public function setIdPass($idPass)
    {
        $this->idPass = $idPass;
    }

    /**
     * @param integer $idClient
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }

    /**
     * @param date $dateDemande
     */
    public function setDateDemande($dateDemande)
    {
        $this->dateDemande = $dateDemande;
    }

    /**
     * @param date $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @param integer $codeRetour
     */
    public function setCodeRetour($codeRetour)
    {
        $this->codeRetour = $codeRetour;
    }

}
