<?php

namespace Omea\Entity\Hexavia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZabpqZne
 *
 * @ORM\Table(name="ZABPQ_ZNE")
 * @ORM\Entity
 */
class ZabpqZne
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ZABPQ", type="string", length=20, nullable=true)
     */
    private $zabpq;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE_CHANGEMENT_ETAT", type="datetime", nullable=true)
     */
    private $dateChangementEtat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE_DEBUT", type="datetime", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE_FIN", type="datetime", nullable=true)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="CODE_ATTRIBUTAIRE", type="string", length=20, nullable=true)
     */
    private $codeAttributaire;

    /**
     * @var string
     *
     * @ORM\Column(name="ATTRIBUTAIRE", type="string", length=200, nullable=true)
     */
    private $attributaire;

    /**
     * @var string
     *
     * @ORM\Column(name="ETAT_ATRIBUTAIRE", type="string", length=20, nullable=true)
     */
    private $etatAtributaire;

    /**
     * @var string
     *
     * @ORM\Column(name="CODE_RESEAU", type="string", length=20, nullable=true)
     */
    private $codeReseau;

    /**
     * @var string
     *
     * @ORM\Column(name="CODE_ATTRIBUTAIRE_PRENEUR", type="string", length=20, nullable=true)
     */
    private $codeAttributairePreneur;

    /**
     * @var string
     *
     * @ORM\Column(name="ATTRIBUTAIRE_PRENEUR", type="string", length=20, nullable=true)
     */
    private $attributairePreneur;

    /**
     * @var string
     *
     * @ORM\Column(name="ETAT_ATRIBUTAIRE_PRENEUR", type="string", length=20, nullable=true)
     */
    private $etatAtributairePreneur;

    /**
     * @var string
     *
     * @ORM\Column(name="CODE_RESEAU_PRENEUR", type="string", length=20, nullable=true)
     */
    private $codeReseauPreneur;

    /**
     * @var string
     *
     * @ORM\Column(name="CODE_COMMUTATEUR", type="string", length=20, nullable=true)
     */
    private $codeCommutateur;

    /**
     * @var string
     *
     * @ORM\Column(name="COMMENTAIRE_COMMUTATEUR", type="string", length=200, nullable=true)
     */
    private $commentaireCommutateur;

    /**
     * @var string
     *
     * @ORM\Column(name="PREFIXE_PORTABILITE", type="string", length=20, nullable=true)
     */
    private $prefixePortabilite;

    /**
     * @var string
     *
     * @ORM\Column(name="NUMERO_ZNE", type="string", length=20, nullable=true)
     */
    private $numeroZne;

    /**
     * @var string
     *
     * @ORM\Column(name="CHEFLIEU_ZNE", type="string", length=200, nullable=true)
     */
    private $cheflieuZne;

    /**
     * @var string
     *
     * @ORM\Column(name="NUMERO_ZLT", type="string", length=20, nullable=true)
     */
    private $numeroZlt;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_ZLT", type="string", length=20, nullable=true)
     */
    private $nomZlt;

    /**
     * @var string
     *
     * @ORM\Column(name="COMMENTAIRE_BLOC", type="string", length=200, nullable=true)
     */
    private $commentaireBloc;

    /**
     * @param string $attributaire
     */
    public function setAttributaire($attributaire)
    {
        $this->attributaire = $attributaire;
    }

    /**
     * @return string
     */
    public function getAttributaire()
    {
        return $this->attributaire;
    }

    /**
     * @param string $attributairePreneur
     */
    public function setAttributairePreneur($attributairePreneur)
    {
        $this->attributairePreneur = $attributairePreneur;
    }

    /**
     * @return string
     */
    public function getAttributairePreneur()
    {
        return $this->attributairePreneur;
    }

    /**
     * @param string $cheflieuZne
     */
    public function setCheflieuZne($cheflieuZne)
    {
        $this->cheflieuZne = $cheflieuZne;
    }

    /**
     * @return string
     */
    public function getCheflieuZne()
    {
        return $this->cheflieuZne;
    }

    /**
     * @param string $codeAttributaire
     */
    public function setCodeAttributaire($codeAttributaire)
    {
        $this->codeAttributaire = $codeAttributaire;
    }

    /**
     * @return string
     */
    public function getCodeAttributaire()
    {
        return $this->codeAttributaire;
    }

    /**
     * @param string $codeAttributairePreneur
     */
    public function setCodeAttributairePreneur($codeAttributairePreneur)
    {
        $this->codeAttributairePreneur = $codeAttributairePreneur;
    }

    /**
     * @return string
     */
    public function getCodeAttributairePreneur()
    {
        return $this->codeAttributairePreneur;
    }

    /**
     * @param string $codeCommutateur
     */
    public function setCodeCommutateur($codeCommutateur)
    {
        $this->codeCommutateur = $codeCommutateur;
    }

    /**
     * @return string
     */
    public function getCodeCommutateur()
    {
        return $this->codeCommutateur;
    }

    /**
     * @param string $codeReseau
     */
    public function setCodeReseau($codeReseau)
    {
        $this->codeReseau = $codeReseau;
    }

    /**
     * @return string
     */
    public function getCodeReseau()
    {
        return $this->codeReseau;
    }

    /**
     * @param string $codeReseauPreneur
     */
    public function setCodeReseauPreneur($codeReseauPreneur)
    {
        $this->codeReseauPreneur = $codeReseauPreneur;
    }

    /**
     * @return string
     */
    public function getCodeReseauPreneur()
    {
        return $this->codeReseauPreneur;
    }

    /**
     * @param string $commentaireBloc
     */
    public function setCommentaireBloc($commentaireBloc)
    {
        $this->commentaireBloc = $commentaireBloc;
    }

    /**
     * @return string
     */
    public function getCommentaireBloc()
    {
        return $this->commentaireBloc;
    }

    /**
     * @param string $commentaireCommutateur
     */
    public function setCommentaireCommutateur($commentaireCommutateur)
    {
        $this->commentaireCommutateur = $commentaireCommutateur;
    }

    /**
     * @return string
     */
    public function getCommentaireCommutateur()
    {
        return $this->commentaireCommutateur;
    }

    /**
     * @param \DateTime $dateChangementEtat
     */
    public function setDateChangementEtat($dateChangementEtat)
    {
        $this->dateChangementEtat = $dateChangementEtat;
    }

    /**
     * @return \DateTime
     */
    public function getDateChangementEtat()
    {
        return $this->dateChangementEtat;
    }

    /**
     * @param \DateTime $dateDebut
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param \DateTime $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param string $etatAtributaire
     */
    public function setEtatAtributaire($etatAtributaire)
    {
        $this->etatAtributaire = $etatAtributaire;
    }

    /**
     * @return string
     */
    public function getEtatAtributaire()
    {
        return $this->etatAtributaire;
    }

    /**
     * @param string $etatAtributairePreneur
     */
    public function setEtatAtributairePreneur($etatAtributairePreneur)
    {
        $this->etatAtributairePreneur = $etatAtributairePreneur;
    }

    /**
     * @return string
     */
    public function getEtatAtributairePreneur()
    {
        return $this->etatAtributairePreneur;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $nomZlt
     */
    public function setNomZlt($nomZlt)
    {
        $this->nomZlt = $nomZlt;
    }

    /**
     * @return string
     */
    public function getNomZlt()
    {
        return $this->nomZlt;
    }

    /**
     * @param string $numeroZlt
     */
    public function setNumeroZlt($numeroZlt)
    {
        $this->numeroZlt = $numeroZlt;
    }

    /**
     * @return string
     */
    public function getNumeroZlt()
    {
        return $this->numeroZlt;
    }

    /**
     * @param string $numeroZne
     */
    public function setNumeroZne($numeroZne)
    {
        $this->numeroZne = $numeroZne;
    }

    /**
     * @return string
     */
    public function getNumeroZne()
    {
        return $this->numeroZne;
    }

    /**
     * @param string $prefixePortabilite
     */
    public function setPrefixePortabilite($prefixePortabilite)
    {
        $this->prefixePortabilite = $prefixePortabilite;
    }

    /**
     * @return string
     */
    public function getPrefixePortabilite()
    {
        return $this->prefixePortabilite;
    }

    /**
     * @param string $zabpq
     */
    public function setZabpq($zabpq)
    {
        $this->zabpq = $zabpq;
    }

    /**
     * @return string
     */
    public function getZabpq()
    {
        return $this->zabpq;
    }

}
