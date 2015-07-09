<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="BILLING")
 * @ORM\Entity
 */
class Billing
{
    /**
     * @var integer
     * @ORM\Column(name="ID_BILLING", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idBilling;

    /**
     * @var Client
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="billings")
     * @ORM\JoinColumn(name="ID_CLIENT", referencedColumnName="ID_CLIENT")
     */
    private $client;

    /**
     * @var string
     * @ORM\Column(name="CODE_PIECE", type="string", length=17)
     */
    private $codePiece;

    /**
     * Gets the value of idBilling.
     *
     * @return integer
     */
    public function getIdBilling()
    {
        return $this->idBilling;
    }

    /**
     * Sets the value of idBilling.
     *
     * @param integer $idBilling the id billing
     *
     * @return self
     */
    public function setIdBilling($idBilling)
    {
        $this->idBilling = $idBilling;

        return $this;
    }

    /**
     * Gets the value of client.
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Sets the value of client.
     *
     * @param Client $client the client
     *
     * @return self
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Gets the value of codePiece.
     *
     * @return string
     */
    public function getCodePiece()
    {
        return $this->codePiece;
    }

    /**
     * Sets the value of codePiece.
     *
     * @param string $codePiece the code piece
     *
     * @return self
     */
    public function setCodePiece($codePiece)
    {
        $this->codePiece = $codePiece;

        return $this;
    }
}
