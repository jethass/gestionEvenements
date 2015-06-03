<?php

namespace Omea\GestionTelco\EvenementsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Omea\GestionTelco\EvenementsBundle\EvenementManager\EvenementInterface;

/**
 * Evenement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Omea\GestionTelco\EvenementsBundle\Entity\EvenementRepository")
 */
class Evenement implements EvenementInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="msisdn", type="integer")
     */
    private $msisdn;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=10)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=25)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAppel", type="date")
     */
    private $dateAppel;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTraitement", type="date")
     */
    private $dateTraitement;

    /**
     * @var string
     *
     * @ORM\Column(name="codeRetour", type="string", length=15)
     */
    private $codeRetour;


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
     * Set msisdn
     *
     * @param integer $msisdn
     *
     * @return Evenement
     */
    public function setMsisdn($msisdn)
    {
        $this->msisdn = $msisdn;

        return $this;
    }

    /**
     * Get msisdn
     *
     * @return integer
     */
    public function getMsisdn()
    {
        return $this->msisdn;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Evenement
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Evenement
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set dateAppel
     *
     * @param \DateTime $dateAppel
     *
     * @return Evenement
     */
    public function setDateAppel($dateAppel)
    {
        $this->dateAppel = $dateAppel;

        return $this;
    }

    /**
     * Get dateAppel
     *
     * @return \DateTime
     */
    public function getDateAppel()
    {
        return $this->dateAppel;
    }

    /**
     * Set dateTraitement
     *
     * @param \DateTime $dateTraitement
     *
     * @return Evenement
     */
    public function setDateTraitement($dateTraitement)
    {
        $this->dateTraitement = $dateTraitement;

        return $this;
    }

    /**
     * Get dateTraitement
     *
     * @return \DateTime
     */
    public function getDateTraitement()
    {
        return $this->dateTraitement;
    }

    /**
     * Set codeRetour
     *
     * @param string $codeRetour
     *
     * @return Evenement
     */
    public function setCodeRetour($codeRetour)
    {
        $this->codeRetour = $codeRetour;

        return $this;
    }

    /**
     * Get codeRetour
     *
     * @return string
     */
    public function getCodeRetour()
    {
        return $this->codeRetour;
    }
}

