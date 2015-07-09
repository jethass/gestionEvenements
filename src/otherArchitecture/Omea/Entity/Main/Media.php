<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="MEDIA")
 * @ORM\Entity
 */
class Media
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_MEDIA", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idMedia;

    /**
     * @var string
     *
     * @ORM\Column(name="CODE", type="string", length=4)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="LIBELLE", type="string", length=20)
     */
    private $libelle;

    /**
     * @var integer
     *
     * @ORM\Column(name="STATUT", type="integer")
     */
    private $statut;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRIORITE", type="integer")
     */
    private $priorite;

    /**
     * @var integer
     *
     * @ORM\Column(name="DATE_CREATION", type="date")
     */
    private $dateCreation;

    /**
     * @var integer
     *
     * @ORM\Column(name="DATE_MAJ", type="date")
     */
    private $dateMaj;

    /**
     * @var integer
     *
     * @ORM\Column(name="DATE_SUPPR", type="date")
     */
    private $dateSuppr;

    /**
     * @var boolean
     *
     * @ORM\Column(name="MEDIA_INTERNE", type="boolean")
     */
    private $mediaInterne;

    /**
     * Gets the value of idMedia.
     *
     * @return integer
     */
    public function getIdMedia()
    {
        return $this->idMedia;
    }

    /**
     * Sets the value of idMedia.
     *
     * @param integer $idMedia the id media
     *
     * @return self
     */
    public function setIdMedia($idMedia)
    {
        $this->idMedia = $idMedia;

        return $this;
    }

    /**
     * Gets the value of code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Sets the value of code.
     *
     * @param string $code the code
     *
     * @return self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Gets the value of libelle.
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Sets the value of libelle.
     *
     * @param string $libelle the libelle
     *
     * @return self
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Gets the value of statut.
     *
     * @return integer
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Sets the value of statut.
     *
     * @param integer $statut the statut
     *
     * @return self
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Gets the value of priorite.
     *
     * @return integer
     */
    public function getPriorite()
    {
        return $this->priorite;
    }

    /**
     * Sets the value of priorite.
     *
     * @param integer $priorite the priorite
     *
     * @return self
     */
    public function setPriorite($priorite)
    {
        $this->priorite = $priorite;

        return $this;
    }

    /**
     * Gets the value of dateCreation.
     *
     * @return integer
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Sets the value of dateCreation.
     *
     * @param integer $dateCreation the date creation
     *
     * @return self
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Gets the value of dateMaj.
     *
     * @return integer
     */
    public function getDateMaj()
    {
        return $this->dateMaj;
    }

    /**
     * Sets the value of dateMaj.
     *
     * @param integer $dateMaj the date maj
     *
     * @return self
     */
    public function setDateMaj($dateMaj)
    {
        $this->dateMaj = $dateMaj;

        return $this;
    }

    /**
     * Gets the value of dateSuppr.
     *
     * @return integer
     */
    public function getDateSuppr()
    {
        return $this->dateSuppr;
    }

    /**
     * Sets the value of dateSuppr.
     *
     * @param integer $dateSuppr the date suppr
     *
     * @return self
     */
    public function setDateSuppr($dateSuppr)
    {
        $this->dateSuppr = $dateSuppr;

        return $this;
    }

    /**
     * Gets the value of mediaInterne.
     *
     * @return boolean
     */
    public function getMediaInterne()
    {
        return $this->mediaInterne;
    }

    /**
     * Sets the value of mediaInterne.
     *
     * @param boolean $mediaInterne the media interne
     *
     * @return self
     */
    public function setMediaInterne($mediaInterne)
    {
        $this->mediaInterne = $mediaInterne;

        return $this;
    }
}
