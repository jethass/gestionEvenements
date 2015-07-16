<?php

namespace Omea\Entity\GestionEvenements;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestionEvenementErreur.
 *
 * @ORM\Table("GESTION_EVENEMENT_ERREUR")
 * @ORM\Entity(repositoryClass="Omea\Entity\GestionEvenements\GestionEvenementErreurRepository")
 */
class GestionEvenementErreur
{
    /**
     * la gestion de l'événement est a l'etat abandone.
     */
    const ETAT_ABANDON = -1;

    /**
     * la gestion de l'événement est a traite.
     */
    const ETAT_A_TRAITE = 0;
    
    /**
     * la gestion de l'événement est traite.
     */
    const ETAT_TRAITE = 1;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_GESTION_EVENEMENT_ERREUR", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne (targetEntity="Omea\Entity\GestionEvenements\Evenement")
     * @ORM\JoinColumn(name="ID_EVENEMENT", referencedColumnName="ID_EVENEMENT")
     */
    private $evenement;

    /**
     * @ORM\ManyToOne (targetEntity="Omea\Entity\GestionEvenements\Acte")
     * @ORM\JoinColumn(name="ID_ACTE_KO", referencedColumnName="ID_ACTE")
     */
    private $acteKo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE_ERREUR", type="datetime")
     */
    private $dateErreur;

    /**
     * @var text
     *
     * @ORM\Column(name="MESSAGE_ERREUR", type="text")
     */
    private $erreurMessage;

    /**
     * @var int
     *
     * @ORM\Column(name="ETAT", type="integer")
     */
    private $etat;

    /**
     * @ORM\Column(name="TRAME", type="trame_type")
     *
     * @var \Omea\Types\TrameType
     */
    private $trame;

    /**
     * @return the $etat
     */
    public function getEtat()
    {
        return $this->etat;
    }

	/**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

	/**
     * @param number $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

	/**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set evenement.
     *
     * @param \stdClass $evenement
     *
     * @return GestionEvenementErreur
     */
    public function setEvenement($evenement)
    {
        $this->evenement = $evenement;

        return $this;
    }

    /**
     * Get evenement.
     *
     * @return \stdClass
     */
    public function getEvenement()
    {
        return $this->evenement;
    }

    /**
     * Set acteKo.
     *
     * @param \stdClass $acteKo
     *
     * @return GestionEvenementErreur
     */
    public function setActeKo($acteKo)
    {
        $this->acteKo = $acteKo;

        return $this;
    }

    /**
     * Get acteKo.
     *
     * @return \stdClass
     */
    public function getActeKo()
    {
        return $this->acteKo;
    }

    /**
     * Set dateErreur.
     *
     * @param \DateTime $dateErreur
     *
     * @return GestionEvenementErreur
     */
    public function setDateErreur($dateErreur)
    {
        $this->dateErreur = $dateErreur;

        return $this;
    }

    /**
     * Get dateErreur.
     *
     * @return \DateTime
     */
    public function getDateErreur()
    {
        return $this->dateErreur;
    }

    /**
     * Set erreurMessage.
     *
     * @param string $erreurMessage
     *
     * @return GestionEvenementErreur
     */
    public function setErreurMessage($erreurMessage)
    {
        $this->erreurMessage = $erreurMessage;

        return $this;
    }

    /**
     * Get erreurMessage.
     *
     * @return string
     */
    public function getErreurMessage()
    {
        return $this->erreurMessage;
    }

    /**
     * Set trame.
     *
     * @param string $trame
     *
     * @return GestionEvenementErreur
     */
    public function setTrame($trame)
    {
        $this->trame = $trame;

        return $this;
    }

    /**
     * Get trame.
     *
     * @return string
     */
    public function getTrame()
    {
        return $this->trame;
    }
}
