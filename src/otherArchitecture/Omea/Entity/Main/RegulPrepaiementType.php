<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * RegulPrepaiementType
 *
 * @ORM\Table(name="REGUL_PREPAIEMENT_TYPE")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\RegulPrepaiementTypeRepository")
 */
class RegulPrepaiementType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_REGUL_PREPAIEMENT_TYPE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRegulPrepaiementType;

    /**
     * @var string
     *
     * @ORM\Column(name="LABEL", type="string", length=255, nullable=false)
     */
    private $label;

    /**
     * Get idRegulPrepaiementType
     *
     * @return integer
     */
    public function getIdRegulPrepaiementType()
    {
        return $this->idRegulPrepaiementType;
    }

    /**
     * Set label
     *
     * @param  string               $label
     * @return RegulPrepaiementType
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }
}
