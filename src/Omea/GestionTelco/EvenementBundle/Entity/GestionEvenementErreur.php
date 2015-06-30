<?php

namespace Omea\GestionTelco\EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestionEvenementErreur
 *
 * @ORM\Table("GESTION_EVENEMENT_ERREUR")
 * @ORM\Entity(repositoryClass="Omea\GestionTelco\EvenementBundle\Entity\GestionEvenementErreurRepository")
 */
class GestionEvenementErreur
{
    /**
     * Ne pas abandonner la gestion de l'événement
     */
    const ABANDON_NON = 0;

    /**
     * Abandonner la gestion de l'événement
     */
    const ABANDON_OUI = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_GESTION_EVENEMENT_ERREUR", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne (targetEntity="Omea\GestionTelco\EvenementBundle\Entity\Evenement")
     * @ORM\JoinColumn(name="ID_EVENEMENT", referencedColumnName="ID_EVENEMENT")
     */
    private $evenement;

    /**
     * @ORM\ManyToOne (targetEntity="Omea\GestionTelco\EvenementBundle\Entity\Acte")
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
     * @var integer
     *
     * @ORM\Column(name="ABANDON", type="integer")
     */
    private $abandon;

    /**
     * @ORM\Column(name="TRAME", type="text")
     *
     * @var \Omea\GestionTelco\EvenementBundle\Types\TrameType
     */
    private $trame;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set evenement
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
     * Get evenement
     *
     * @return \stdClass
     */
    public function getEvenement()
    {
        return $this->evenement;
    }

    /**
     * Set acteKo
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
     * Get acteKo
     *
     * @return \stdClass
     */
    public function getActeKo()
    {
        return $this->acteKo;
    }

    /**
     * Set dateErreur
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
     * Get dateErreur
     *
     * @return \DateTime
     */
    public function getDateErreur()
    {
        return $this->dateErreur;
    }

    /**
     * Set erreurMessage
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
     * Get erreurMessage
     *
     * @return string
     */
    public function getErreurMessage()
    {
        return $this->erreurMessage;
    }

    /**
     * Set abandon
     *
     * @param integer $abandon
     *
     * @return GestionEvenementErreur
     */
    public function setAbandon($abandon)
    {
        $this->abandon = $abandon;

        return $this;
    }

    /**
     * Get abandon
     *
     * @return integer
     */
    public function getAbandon()
    {
        return $this->abandon;
    }

    /**
     * Set trame
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
     * Get trame
     *
     * @return string
     */
    public function getTrame()
    {
        return $this->trame;
    }
}
