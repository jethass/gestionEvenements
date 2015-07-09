<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="PARAMETRAGE")
 * @ORM\Entity
 */
class Parametrage
{

    /**
     *      @ORM\Column(name="ID", type="string")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     *      @ORM\Column(name="VALEUR", type="string")
     */
    private $valeur;
    
    /**
     *
     *      @ORM\Column(name="COMMENTAIRE", type="string")
     */
    private $commentaire;
    
	/**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

	/**
     * @return the $valeur
     */
    public function getValeur()
    {
        return $this->valeur;
    }

	/**
     * @return the $commentaire
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

	/**
     * @param field_type $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

	/**
     * @param field_type $valeur
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;
    }

	/**
     * @param field_type $commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }


    
}
