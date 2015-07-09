<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="FOYER")
 * @ORM\Entity
 */
class Foyer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="TYPE_FOYER", type="string", length=255)
     */
    private $typeFoyer;

    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $typeFoyer
     */
    public function getTypeFoyer()
    {
        return $this->typeFoyer;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param number $typeFoyer
     */
    public function setTypeFoyer($typeFoyer)
    {
        $this->typeFoyer = $typeFoyer;
    }

}
