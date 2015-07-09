<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="OMD_HNO")
 * @ORM\Entity
 */
class OmdHno
{
    /**
     * @var integer $id
     *      @ORM\Column(name="ID_HNO", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $labelReseau
     * @ORM\Column(name="LABEL_RESEAU", type="string", length=30)
     */
    private $labelReseau;

    /**
     * @var boolean $idNetwork
     * @ORM\Column(name="ID_NETWORK", type="boolean")
     */
    private $idNetwork;

    /**
     * Gets the value of id.
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param integer $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of labelReseau.
     *
     * @return string $labelReseau
     */
    public function getLabelReseau()
    {
        return $this->labelReseau;
    }

    /**
     * Sets the value of labelReseau.
     *
     * @param string $labelReseau the labelReseau
     *
     * @return self
     */
    public function setLabelReseau($labelReseau)
    {
        $this->labelReseau = $labelReseau;

        return $this;
    }

    /**
     * Gets the value of idNetwork.
     *
     * @return boolean $idNetwork
     */
    public function getIdNetwork()
    {
        return $this->idNetwork;
    }

    /**
     * Sets the value of idNetwork.
     *
     * @param boolean $idNetwork the idNetwork
     *
     * @return self
     */
    public function setIdNetwork($idNetwork)
    {
        $this->idNetwork = $idNetwork;

        return $this;
    }
}
