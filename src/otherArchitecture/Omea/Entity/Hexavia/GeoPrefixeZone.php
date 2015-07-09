<?php

namespace Omea\Entity\Hexavia;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoPrefixeZone
 *
 * @ORM\Table(name="GEO_PREFIXE_ZONE")
 * @ORM\Entity
 */
class GeoPrefixeZone
{
    /**
     * @var string
     *
     * @ORM\Column(name="DEPARTEMENT", type="string", length=2, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $departement;

    /**
     * @var string
     *
     * @ORM\Column(name="PREFIXE_ZONE", type="string", length=2, nullable=false)
     */
    private $prefixeZone;

    /**
     * @param string $departement
     */
    public function setDepartement($departement)
    {
        $this->departement = $departement;
    }

    /**
     * @return string
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * @param string $prefixeZone
     */
    public function setPrefixeZone($prefixeZone)
    {
        $this->prefixeZone = $prefixeZone;
    }

    /**
     * @return string
     */
    public function getPrefixeZone()
    {
        return $this->prefixeZone;
    }

}
