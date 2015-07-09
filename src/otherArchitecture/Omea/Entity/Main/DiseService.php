<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="DISE_SERVICE")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\DiseServiceRepository")
 */
class DiseService
{

    /**
     *
     * @var integer $idDs
     *      @ORM\Column(name="ID_DS", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idDs;

    /**
     *
     * @var $forfaitOption
     *      @ORM\OneToMany(targetEntity="ForfaitOptions", mappedBy="diseService")
     *      @ORM\JoinColumn(name="ID_DS", referencedColumnName = "TO_OMD")
     */
    private $forfaitOption;

    /**
    *
    * @var $pass
    *      @ORM\OneToMany(targetEntity="Pass", mappedBy="diseService")
    *      @ORM\JoinColumn(name="ID_DS", referencedColumnName = "TO_OMD")
    */
    private $pass;

    /**
     *
     * @var string $codeService
     *
     *      @ORM\Column(name="CODE_SERVICE", type="string")
     */
    private $codeService;

    /**
     *
     * @var string $serviceType
     *
     *      @ORM\Column(name="SERVICE_TYPE", type="string")
     */
    private $serviceType;

     /**
     *
     * @var string $serviceValue
     *
     *      @ORM\Column(name="SERVICE_VALUE", type="string")
     */
    private $serviceValue;

    /**
     *
     * @var integet $realValue
     *
     *      @ORM\Column(name="REAL_VALUE", type="integer")
     */
    private $realValue;

    /**
     * @return the $forfaitOption
     */
    public function getForfaitOption()
    {
        return $this->forfaitOption;
    }

    /**
     * @return the $pass
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param $forfaitOption $forfaitOption
     */
    public function setForfaitOption($forfaitOption)
    {
        $this->forfaitOption = $forfaitOption;
    }

    /**
     * @param $forfaitOption $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return the $forfaitOptions
     */
    public function getForfaitOptions()
    {
        return $this->forfaitOptions;
    }

    /**
     * @param $forfaitOptions $forfaitOptions
     */
    public function setForfaitOptions($forfaitOptions)
    {
        $this->forfaitOptions = $forfaitOptions;
    }

    /**
     * @return the $idDs
     */
    public function getIdDs()
    {
        return $this->idDs;
    }

    /**
     * @return the $codeService
     */
    public function getCodeService()
    {
        return $this->codeService;
    }

    /**
     * @return the $serviceType
     */
    public function getServiceType()
    {
        return $this->serviceType;
    }

    /**
     * @return the $serviceValue
     */
    public function getServiceValue()
    {
        return $this->serviceValue;
    }

    /**
     * @return the $realValue
     */
    public function getRealValue()
    {
        return $this->realValue;
    }

    /**
     * @param integer $idDs
     */
    public function setIdDs($idDs)
    {
        $this->idDs = $idDs;
    }

    /**
     * @param string $codeService
     */
    public function setCodeService($codeService)
    {
        $this->codeService = $codeService;
    }

    /**
     * @param string $serviceType
     */
    public function setServiceType($serviceType)
    {
        $this->serviceType = $serviceType;
    }

    /**
     * @param string $serviceValue
     */
    public function setServiceValue($serviceValue)
    {
        $this->serviceValue = $serviceValue;
    }

    /**
     * @param integet $realValue
     */
    public function setRealValue($realValue)
    {
        $this->realValue = $realValue;
    }

}
