<?php

namespace Omea\GestionTelco\EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acte
 *
 * @ORM\Table("ACTES")
 * @ORM\Entity
 */
class Acte
{
     /**
     * @var integer
     *
     * @ORM\Column(name="ID_ACTE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idActe;
    
    /**
     * @ORM\ManyToOne(targetEntity="Omea\GestionTelco\EvenementBundle\Entity\Service")
     * @ORM\JoinColumn(name="ID_SERVICE", referencedColumnName="ID_SERVICE")
     */
     private $service;

    /**
     * @var string
     *
     * @ORM\Column(name="options", type="string", length=45)
     */
    private $options;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getIdActe()
    {
        return $this->idActe;
    }

    /**
     * Set options
     *
     * @param string $options
     * @return Actes
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get options
     *
     * @return string 
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Actes
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set service
     *
     * @param \Omea\GestionTelco\EvenementBundle\Entity\Service $service
     *
     * @return Acte
     */
    public function setService(\Omea\GestionTelco\EvenementBundle\Entity\Service $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \Omea\GestionTelco\EvenementBundle\Entity\Service
     */
    public function getService()
    {
        return $this->service;
    }
}
