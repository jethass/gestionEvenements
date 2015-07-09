<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * Omea\Entity\Cycle
 *
 * @ORM\Table(name="CYCLES")
 * @ORM\Entity
 */
class Cycle
{
    /**
     * @var integer $cycle
     * @ORM\Id
     * @ORM\Column(name="CYCLE", type="integer")
     *
     */
    private $cycle;

    /**
     * @var string $libelle
     *
     * @ORM\Column(name="LIBELLE", type="string", length=255)
     */
    private $libelle;

    /**
     * @var integer $jourRemiseZero
     *
     * @ORM\Column(name="JOUR_REMISE_ZERO", type="integer")
     *
     */
    private $jourRemiseZero;

    /**
     * @var integer $datePrelevement
     *
     * @ORM\Column(name="DATE_PRELEVEMENT", type="integer")
     *
     */
    private $datePrelevement;

    /**
     * @var integer $jourDebut
     *
     * @ORM\Column(name="JOUR_DEBUT", type="integer")
     *
     */
    private $jourDebut;

    /**
     * @var integer $jourFin
     *
     * @ORM\Column(name="JOUR_FIN", type="integer")
     *
     */
    private $jourFin;

    /**
     * @param int $cycle
     */
    public function setCycle($cycle)
    {
        $this->cycle = $cycle;
    }

    /**
     * @return int
     */
    public function getCycle()
    {
        return $this->cycle;
    }

    /**
     * @param int $datePrelevement
     */
    public function setDatePrelevement($datePrelevement)
    {
        $this->datePrelevement = $datePrelevement;
    }

    /**
     * @return int
     */
    public function getDatePrelevement()
    {
        return $this->datePrelevement;
    }

    /**
     * @return  \DateTime
     */
    public function getProchaineDatePrelevement()
    {
        $date = new \DateTime();

        if ($date->format('d') > $this->datePrelevement) {
            $date->modify('+1 month');
        }

        return $date->setDate($date->format('Y'), $date->format('m'), $this->datePrelevement);
    }

    /**
     * @param int $jourDebut
     */
    public function setJourDebut($jourDebut)
    {
        $this->jourDebut = $jourDebut;
    }

    /**
     * @return int
     */
    public function getJourDebut()
    {
        return $this->jourDebut;
    }

    /**
     * @param int $jourFin
     */
    public function setJourFin($jourFin)
    {
        $this->jourFin = $jourFin;
    }

    /**
     * @return int
     */
    public function getJourFin()
    {
        return $this->jourFin;
    }

    /**
     * @param int $jourRemiseZero
     */
    public function setJourRemiseZero($jourRemiseZero)
    {
        $this->jourRemiseZero = $jourRemiseZero;
    }

    /**
     * @return int
     */
    public function getJourRemiseZero()
    {
        return $this->jourRemiseZero;
    }

    /**
     * @return  \DateTime
     */
    public function getDateRemiseZero()
    {
        $date = new \DateTime();

        if ($date->format('d') > $this->jourRemiseZero) {
            $date->modify('+1 month');
        }

        return $date->setDate($date->format('Y'), $date->format('m'), $this->jourRemiseZero);
    }

    /**
     * @param string $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

}
