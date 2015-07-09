<?php

namespace Omea\Entity\Main;

use \Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="RC_PROPOSITION")
 */
class RcProposition {

    /**
     * @var integer
     * @ORM\Column(name="ID_RCP", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="LABEL", type="string", nullable=false)
     */
    private $label;

    /**
     * @var integer
     * @ORM\Column(name="ID_EVENEMENT_OK", type="integer", nullable=false)
     */
    private $idEventOk;

    /**
     * @var integer
     * @ORM\Column(name="ID_EVENEMENT_KO", type="integer", nullable=false)
     */
    private $idEventKo;

    /**
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * @return integer
     */
    public function getIdEventOk() {
        return $this->idEventOk;
    }

    /**
     * @return integer
     */
    public function getIdEventKo() {
        return $this->idEventKo;
    }

    /**
     * @param integer $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @param string $label
     */
    public function setLabel($label) {
        $this->label = $label;
    }

    /**
     * @param integer $idEventOk
     */
    public function setIdEventOk($idEventOk) {
        $this->idEventOk = $idEventOk;
    }

    /**
     * @param integer $idEventKo
     */
    public function setIdEventKo($idEventKo) {
        $this->idEventKo = $idEventKo;
    }

}
