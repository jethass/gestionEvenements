<?php

namespace Omea\Entity\GestionEvenements;

use Doctrine\ORM\Mapping as ORM;
use Omea\GestionTelco\EvenementBundle\ActeManager\EvenementInterface;

/**
 * Evenements.
 *
 * @ORM\Table("EVENEMENTS")
 * @ORM\Entity(repositoryClass="Omea\Entity\GestionEvenements\EvenementRepository")
 */
class Evenement implements EvenementInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_EVENEMENT", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=10)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=45)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_appel", type="datetime", nullable=true)
     */
    private $dateAppel;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_traitement", type="datetime", nullable=true)
     */
    private $dateTraitement;

    /**
     * @var int
     *
     * @ORM\Column(name="msisdn", type="integer", columnDefinition="INT(10) UNSIGNED ZEROFILL")
     */
    private $msisdn;

    /**
     * Get id.
     *
     * @return int
     */
    public function getIdEvenement()
    {
        return $this->idEvenement;
    }

    /**
     * Set code.
     *
     * @param string $code
     *
     * @return Evenements
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set type.
     *
     * @param string $type
     *
     * @return Evenements
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set dateAppel.
     *
     * @param \DateTime $dateAppel
     *
     * @return Evenements
     */
    public function setDateAppel(\DateTime $dateAppel)
    {
        $this->dateAppel = $dateAppel;

        return $this;
    }

    /**
     * Get dateAppel.
     *
     * @return \DateTime
     */
    public function getDateAppel()
    {
        return $this->dateAppel;
    }

    /**
     * Set dateTraitement.
     *
     * @param \DateTime $dateTraitement
     *
     * @return Evenements
     */
    public function setDateTraitement(\DateTime $dateTraitement)
    {
        $this->dateTraitement = $dateTraitement;

        return $this;
    }

    /**
     * Get dateTraitement.
     *
     * @return \DateTime
     */
    public function getDateTraitement()
    {
        return $this->dateTraitement;
    }

    /**
     * Set msisdn.
     *
     * @param int $msisdn
     *
     * @return Evenements
     */
    public function setMsisdn($msisdn)
    {
        $this->msisdn = $msisdn;

        return $this;
    }

    /**
     * Get msisdn.
     *
     * @return int
     */
    public function getMsisdn()
    {
        return $this->msisdn;
    }
}
