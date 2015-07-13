<?php

namespace Omea\Entity\GestionEvenements;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acte.
 *
 * @ORM\Table("ACTES")
 * @ORM\Entity
 */
class Acte
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_ACTE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idActe;

     /**
      * @ORM\ManyToOne(targetEntity="Omea\Entity\GestionEvenements\Service")
      * @ORM\JoinColumn(name="ID_SERVICE", referencedColumnName="ID_SERVICE")
      */
     private $service;

    /**
     * @var string
     *
     * @ORM\Column(name="OPTIONS", type="string", length=45)
     */
    private $options;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION", type="string", length=255)
     */
    private $description;

    /**
     * Get id.
     *
     * @return int
     */
    public function getIdActe()
    {
        return $this->idActe;
    }

    /**
     * Set options.
     *
     * @param string $options
     *
     * @return Actes
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get options.
     *
     * @return string
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Actes
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set service.
     *
     * @param \Omea\Entity\Service $service
     *
     * @return Acte
     */
    public function setService(Service $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service.
     *
     * @return \Omea\Entity\Service
     */
    public function getService()
    {
        return $this->service;
    }
}
