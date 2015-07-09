<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="TYPE_ENTITE")
 * @ORM\Entity
 */
class TypeEntite
{

    /**
     *
     * @var integer $idTe
     *      @ORM\Column(name="ID_TE", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idTe;

    /**
     *
     * @var string $libelle
     *      @ORM\Column(name="LIBELLE", type="string")
     */
    private $libelle;

    /**
     * var string $typeOffre
     * @ORM\Column(name="TYPE_OFFRE", type="string")
     */
    private $typeOffre;

    /**
     * @return the $idTe
     */
    public function getIdTe()
    {
        return $this->idTe;
    }

    /**
     * @return the $libelle
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @return the $typeOffre
     */
    public function getTypeOffre()
    {
        return $this->typeOffre;
    }

    /**
     * @param number $idTe
     */
    public function setIdTe($idTe)
    {
        $this->idTe = $idTe;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @param field_type $typeOffre
     */
    public function setTypeOffre($typeOffre)
    {
        $this->typeOffre = $typeOffre;
    }

}
