<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="DISE_PACKAGE")
 * @ORM\Entity
 */
class DisePackage
{
    /**
     * @var integer $codePackage
     * @ORM\Column(name="CODE_PACKAGE", type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codePackage;

    /**
     * @ORM\Column(name="LIBELLE_PACKAGE", type="string")
     */
    private $libellePackage;

    /**
     * @return the $codePackage
     */
    public function getCodePackage()
    {
        return $this->codePackage;
    }

    /**
     * @return the $libellePackage
     */
    public function getLibellePackage()
    {
        return $this->libellePackage;
    }

    /**
     * @param number $codePackage
     */
    public function setCodePackage($codePackage)
    {
        $this->codePackage = $codePackage;
    }

    /**
     * @param field_type $libellePackage
     */
    public function setLibellePackage($libellePackage)
    {
        $this->libellePackage = $libellePackage;
    }

}
