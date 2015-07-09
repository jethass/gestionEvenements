<?php

namespace Omea\GestionTelco\PatesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FemtoAuthorizedClient
 *
 * @ORM\Table(name="FEMTO_AUTHORIZED_CLIENT")
 * @ORM\Entity
 */
class FemtoAuthorizedClient
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FAC_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $facId;

    /**
     * @var integer
     *
     * @ORM\Column(name="CLIENT_ID", type="integer", nullable=false)
     */
    private $clientId;



    /**
     * Get facId
     *
     * @return integer 
     */
    public function getFacId()
    {
        return $this->facId;
    }

    /**
     * Set clientId
     *
     * @param integer $clientId
     * @return FemtoAuthorizedClient
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    
        return $this;
    }

    /**
     * Get clientId
     *
     * @return integer 
     */
    public function getClientId()
    {
        return $this->clientId;
    }
}
