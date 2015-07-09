<?php

namespace Omea\Entity\Hexavia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZneCommune
 *
 * @ORM\Table(name="ZNE_COMMUNE")
 * @ORM\Entity
 */
class ZneCommune
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ZNE_NUM", type="string", length=200, nullable=true)
     */
    private $zneNum;

    /**
     * @var string
     *
     * @ORM\Column(name="ZNE_CHEF_LIEU", type="string", length=200, nullable=true)
     */
    private $zneChefLieu;

    /**
     * @var string
     *
     * @ORM\Column(name="COMMUNE_INSEE", type="string", length=200, nullable=true)
     */
    private $communeInsee;

    /**
     * @var string
     *
     * @ORM\Column(name="COMMUNE_NOM", type="string", length=200, nullable=true)
     */
    private $communeNom;

    /**
     * @var string
     *
     * @ORM\Column(name="ZNE_NBABO", type="string", length=200, nullable=true)
     */
    private $zneNbabo;

    /**
     * @var string
     *
     * @ORM\Column(name="ZNE_COM", type="string", length=200, nullable=true)
     */
    private $zneCom;

    /**
     * @param string $communeInsee
     */
    public function setCommuneInsee($communeInsee)
    {
        $this->communeInsee = $communeInsee;
    }

    /**
     * @return string
     */
    public function getCommuneInsee()
    {
        return $this->communeInsee;
    }

    /**
     * @param string $communeNom
     */
    public function setCommuneNom($communeNom)
    {
        $this->communeNom = $communeNom;
    }

    /**
     * @return string
     */
    public function getCommuneNom()
    {
        return $this->communeNom;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $zneChefLieu
     */
    public function setZneChefLieu($zneChefLieu)
    {
        $this->zneChefLieu = $zneChefLieu;
    }

    /**
     * @return string
     */
    public function getZneChefLieu()
    {
        return $this->zneChefLieu;
    }

    /**
     * @param string $zneCom
     */
    public function setZneCom($zneCom)
    {
        $this->zneCom = $zneCom;
    }

    /**
     * @return string
     */
    public function getZneCom()
    {
        return $this->zneCom;
    }

    /**
     * @param string $zneNbabo
     */
    public function setZneNbabo($zneNbabo)
    {
        $this->zneNbabo = $zneNbabo;
    }

    /**
     * @return string
     */
    public function getZneNbabo()
    {
        return $this->zneNbabo;
    }

    /**
     * @param string $zneNum
     */
    public function setZneNum($zneNum)
    {
        $this->zneNum = $zneNum;
    }

    /**
     * @return string
     */
    public function getZneNum()
    {
        return $this->zneNum;
    }

}
