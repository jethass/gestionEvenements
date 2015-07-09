<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="SIM_FORMAT")
 * @ORM\Entity
 */
class SimFormat
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SIM_FORMAT", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idSimFormat;

    /**
     * @var string
     *
     * @ORM\Column(name="SIM_FORMAT", type="string", length=20)
     */
    private $simFormat;

    /**
     * @var string
     *
     * @ORM\Column(name="LIBELLE_CRM", type="string", length=45)
     */
    private $libelleCrm;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="SimType", mappedBy="simFormats")
     */
    private $simTypes;

    public function __construct()
    {
        $this->simTypes = new ArrayCollection();
    }

    /**
     * Gets the value of idSimFormat.
     *
     * @return integer
     */
    public function getIdSimFormat()
    {
        return $this->idSimFormat;
    }

    /**
     * Sets the value of idSimFormat.
     *
     * @param integer $idSimFormat the id sim format
     *
     * @return self
     */
    public function setIdSimFormat($idSimFormat)
    {
        $this->idSimFormat = $idSimFormat;

        return $this;
    }

    /**
     * Gets the value of simFormat.
     *
     * @return string
     */
    public function getSimFormat()
    {
        return $this->simFormat;
    }

    /**
     * Sets the value of simFormat.
     *
     * @param string $simFormat the sim format
     *
     * @return self
     */
    public function setSimFormat($simFormat)
    {
        $this->simFormat = $simFormat;

        return $this;
    }

    /**
     * Gets the value of libelleCrm.
     *
     * @return string
     */
    public function getLibelleCrm()
    {
        return $this->libelleCrm;
    }

    /**
     * Sets the value of libelleCrm.
     *
     * @param string $libelleCrm the libelle crm
     *
     * @return self
     */
    public function setLibelleCrm($libelleCrm)
    {
        $this->libelleCrm = $libelleCrm;

        return $this;
    }

    /**
     * Gets the value of simTypes.
     *
     * @return ArrayCollection
     */
    public function getSimTypes()
    {
        return $this->simTypes;
    }
}
