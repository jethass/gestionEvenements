<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="AVANCES_TYPE")
 * @ORM\Entity
 */
class AvancesType
{
    /**
     *
     * @var integer $id
     * @ORM\Column(name="ID_TYPE_AVANCE", type="integer", precision=10)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idTypeAvance;

    /**
     *
     * @var string $typeAvance
     * @ORM\Column(name="TYPE_AVANCE", type="string", length=5, nullable=false)
     */
    private $typeAvance;

    /**
     *
     * @var integer $libelle
     * @ORM\Column(name="LIBELLE", type="string", precision=255, nullable=false)
     */
    private $libelle;

    /**
     *
     * @var string $codeComptable
     * @ORM\Column(name="CODE_COMPTABLE", type="string", length=5, nullable=false)
     */
    private $codeComptable;

    /**
     * @param string $codeComptable
     */
    public function setCodeComptable( $codeComptable )
    {
        $this->codeComptable = $codeComptable;
    }

    /**
     * @return string
     */
    public function getCodeComptable()
    {
        return $this->codeComptable;
    }

    /**
     * @param int $idTypeAvance
     */
    public function setIdTypeAvance( $idTypeAvance )
    {
        $this->idTypeAvance = $idTypeAvance;
    }

    /**
     * @return int
     */
    public function getIdTypeAvance()
    {
        return $this->idTypeAvance;
    }

    /**
     * @param int $libelle
     */
    public function setLibelle( $libelle )
    {
        $this->libelle = $libelle;
    }

    /**
     * @return int
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param string $typeAvance
     */
    public function setTypeAvance( $typeAvance )
    {
        $this->typeAvance = $typeAvance;
    }

    /**
     * @return string
     */
    public function getTypeAvance()
    {
        return $this->typeAvance;
    }


}