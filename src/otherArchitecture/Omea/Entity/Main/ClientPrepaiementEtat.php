<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClientPrepaiementEtat
 *
 * @ORM\Table(name="CLIENT_PREPAIEMENT_ETAT")
 * @ORM\Entity
 */
class ClientPrepaiementEtat
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_CLIENT_PREPAIEMENT_ETAT", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idClientPrepaiementEtat;

    /**
     * @var string
     *
     * @ORM\Column(name="LABEL", type="string", length=45, nullable=false)
     */
    private $label;

    /**
     * Get idClientPrepaiementEtat
     *
     * @return integer
     */
    public function getIdClientPrepaiementEtat()
    {
        return $this->idClientPrepaiementEtat;
    }

    /**
     * Set label
     *
     * @param  string                $label
     * @return ClientPrepaiementEtat
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
