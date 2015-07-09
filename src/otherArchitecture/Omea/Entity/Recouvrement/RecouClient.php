<?php
namespace Omea\Entity\Recouvrement;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="RECOU_CLIENT")
 * @ORM\Entity
 */
class RecouClient
{

    /**
     *
     * @var integer $idClient
     *      @ORM\Column(name="ID_CLIENT", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idClient;

    /**
     *
     * @var integer $niveauImp
     *
     *      @ORM\Column(name="NIVEAU_IMP", type="integer")
     */
    private $niveauImp;

    /**
     *
     * @var integer $idEtape
     *
     *      @ORM\Column(name="ID_ETAPE", type="integer")
     */
    private $idEtape;

    /**
     *
     * @var date $dateEcheance
     *
     *      @ORM\Column(name="DATE_ECHEANCE", type="date")
     */
    private $dateEcheance;

    /**
     *
     * @var integer $idEtapeNext
     *
     *      @ORM\Column(name="ID_ETAPE_NEXT", type="integer")
     */
    private $idEtapeNext;

    /**
     *
     * @var date $dateIntegrImp
     *
     *      @ORM\Column(name="DATE_INTEGR_IMP", type="date")
     */
    private $dateIntegrImp;

    /**
     *
     * @var dateTime $dateCreation
     *
     *      @ORM\Column(name="DATE_CREATION", type="datetime")
     */
    private $dateCreation;

    /**
     *
     * @var dateTime $dateModif
     *
     *      @ORM\Column(name="DATE_MODIF", type="datetime")
     */
    private $dateModif;

    /**
     *
     * @var dateTime $dateSuppr
     *
     *      @ORM\Column(name="DATE_SUPPR", type="datetime")
     */
    private $dateSuppr;

    /**
     *
     * @var dateTime $dateInvalidation
     *
     *      @ORM\Column(name="DATE_INVALIDATION", type="datetime")
     */
    private $dateInvalidation;

    /**
     *
     * @var integer $idConseiller
     *
     *      @ORM\Column(name="ID_CONSEILLER", type="integer")
     */
    private $idConseiller;

    /**
     *
     * @var dateTime $dateEtape
     *
     *      @ORM\Column(name="DATE_ETAPE", type="datetime")
     */
    private $dateEtape;

    /**
     *
     * @var integer $idCalendrier
     *
     *      @ORM\Column(name="ID_CALENDRIER", type="integer")
     */
    private $idCalendrier;

    /**
     * @return the $idClient
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * @return the $niveauImp
     */
    public function getNiveauImp()
    {
        return $this->niveauImp;
    }

    /**
     * @return the $idEtape
     */
    public function getIdEtape()
    {
        return $this->idEtape;
    }

    /**
     * @return the $dateEcheance
     */
    public function getDateEcheance()
    {
        return $this->dateEcheance;
    }

    /**
     * @return the $idEtapeNext
     */
    public function getIdEtapeNext()
    {
        return $this->idEtapeNext;
    }

    /**
     * @return the $dateIntegrImp
     */
    public function getDateIntegrImp()
    {
        return $this->dateIntegrImp;
    }

    /**
     * @return the $dateCreation
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @return the $dateModif
     */
    public function getDateModif()
    {
        return $this->dateModif;
    }

    /**
     * @return the $dateSuppr
     */
    public function getDateSuppr()
    {
        return $this->dateSuppr;
    }

    /**
     * @return the $dateInvalidation
     */
    public function getDateInvalidation()
    {
        return $this->dateInvalidation;
    }

    /**
     * @return the $idConseiller
     */
    public function getIdConseiller()
    {
        return $this->idConseiller;
    }

    /**
     * @return the $dateEtape
     */
    public function getDateEtape()
    {
        return $this->dateEtape;
    }

    /**
     * @return the $idCalendrier
     */
    public function getIdCalendrier()
    {
        return $this->idCalendrier;
    }

    /**
     * @param number $idClient
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }

    /**
     * @param number $niveauImp
     */
    public function setNiveauImp($niveauImp)
    {
        $this->niveauImp = $niveauImp;
    }

    /**
     * @param number $idEtape
     */
    public function setIdEtape($idEtape)
    {
        $this->idEtape = $idEtape;
    }

    /**
     * @param \Omea\Entity\Recouvrement\date $dateEcheance
     */
    public function setDateEcheance($dateEcheance)
    {
        $this->dateEcheance = $dateEcheance;
    }

    /**
     * @param number $idEtapeNext
     */
    public function setIdEtapeNext($idEtapeNext)
    {
        $this->idEtapeNext = $idEtapeNext;
    }

    /**
     * @param \Omea\Entity\Recouvrement\date $dateIntegrImp
     */
    public function setDateIntegrImp($dateIntegrImp)
    {
        $this->dateIntegrImp = $dateIntegrImp;
    }

    /**
     * @param \Omea\Entity\Recouvrement\dateTime $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @param \Omea\Entity\Recouvrement\dateTime $dateModif
     */
    public function setDateModif($dateModif)
    {
        $this->dateModif = $dateModif;
    }

    /**
     * @param \Omea\Entity\Recouvrement\dateTime $dateSuppr
     */
    public function setDateSuppr($dateSuppr)
    {
        $this->dateSuppr = $dateSuppr;
    }

    /**
     * @param \Omea\Entity\Recouvrement\dateTime $dateInvalidation
     */
    public function setDateInvalidation($dateInvalidation)
    {
        $this->dateInvalidation = $dateInvalidation;
    }

    /**
     * @param number $idConseiller
     */
    public function setIdConseiller($idConseiller)
    {
        $this->idConseiller = $idConseiller;
    }

    /**
     * @param \Omea\Entity\Recouvrement\dateTime $dateEtape
     */
    public function setDateEtape($dateEtape)
    {
        $this->dateEtape = $dateEtape;
    }

    /**
     * @param number $idCalendrier
     */
    public function setIdCalendrier($idCalendrier)
    {
        $this->idCalendrier = $idCalendrier;
    }

}
