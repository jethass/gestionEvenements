<?php

namespace Omea\Entity\GestionEvenements;

use Doctrine\ORM\Mapping as ORM;

/**
 * Services.
 *
 * @ORM\Table("SERVICES")
 * @ORM\Entity
 */
class Service
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_SERVICE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idService;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM", type="string", length=45)
     */
    private $nom;

    /**
     * Get id.
     *
     * @return int
     */
    public function getIdService()
    {
        return $this->idService;
    }

    /**
     * Set nom.
     *
     * @param string $nom
     *
     * @return Services
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom.
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }
}
