<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="OPTION_INCOMPATIBLE")
 * @ORM\Entity
 */
class OptionIncompatible
{

    /**
     * @ORM\Column(name="ID_INC", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idInc;

    /**
     *
     * @ORM\Column(name="ID_DS1", type="integer")
     */
    private $idDs1;

    /**
     *
     * @ORM\Column(name="ID_DS2", type="integer")
     */
    private $idDs2;
    
    /**
     *
     * @ORM\Column(name="LINK_INC", type="integer")
     */
    private $linkInc;
    
    /**
     * @ORM\ManyToOne(targetEntity="Options", inversedBy="optionsIncompatible1")
     * @ORM\JoinColumn(name="ID_DS1", referencedColumnName = "ID_OPTION")
     */
    private $options1;
    
    /**
     * @ORM\ManyToOne(targetEntity="Options", inversedBy="optionsIncompatible2")
     * @ORM\JoinColumn(name="ID_DS2", referencedColumnName = "ID_OPTION")
     */
    private $options2;
    
	/**
     * @return the $idInc
     */
    public function getIdInc()
    {
        return $this->idInc;
    }

	/**
     * @return the $idDs1
     */
    public function getIdDs1()
    {
        return $this->idDs1;
    }

	/**
     * @return the $idDs2
     */
    public function getIdDs2()
    {
        return $this->idDs2;
    }

	/**
     * @return the $linkInc
     */
    public function getLinkInc()
    {
        return $this->linkInc;
    }

	/**
     * @param field_type $idInc
     */
    public function setIdInc($idInc)
    {
        $this->idInc = $idInc;
    }

	/**
     * @param field_type $idDs1
     */
    public function setIdDs1($idDs1)
    {
        $this->idDs1 = $idDs1;
    }

	/**
     * @param field_type $idDs2
     */
    public function setIdDs2($idDs2)
    {
        $this->idDs2 = $idDs2;
    }

	/**
     * @param field_type $linkInc
     */
    public function setLinkInc($linkInc)
    {
        $this->linkInc = $linkInc;
    }

}
