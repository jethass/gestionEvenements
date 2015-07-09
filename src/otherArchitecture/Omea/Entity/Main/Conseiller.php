<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="D_CONSEILLERS")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\ConseillerRepository")
 */
class Conseiller
{
    /**
     * @var integer $id
     * @ORM\Column(name="ID_CONSEILLER", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $login
     * @ORM\Column(name="LOGIN", type="string", length=20)
     */
    private $login;

    /**
     * @var string $nom
     * @ORM\Column(name="NOM", type="string", length=30)
     */
    private $nom;

    /**
     * @var string $login
     * @ORM\Column(name="PRENOM", type="string", length=30)
     */
    private $prenom;

    /**
     * @var boolean $actif
     * @ORM\Column(name="ACTIF", type="boolean")
     */
    private $actif;

    /**
     * @var boolean $deleted
     * @ORM\Column(name="DELETED", type="boolean")
     */
    private $deleted;

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
     * @param integer $id $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of login.
     *
     * @return string $login
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Sets the value of login.
     *
     * @param string $login $login the login
     *
     * @return self
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Gets the value of nom.
     *
     * @return string $nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Sets the value of nom.
     *
     * @param string $nom $nom the nom
     *
     * @return self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Gets the value of prenom.
     *
     * @return string $login
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Sets the value of prenom.
     *
     * @param string $login $prenom the prenom
     *
     * @return self
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Gets the value of actif.
     *
     * @return boolean $actif
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Sets the value of actif.
     *
     * @param boolean $actif $actif the actif
     *
     * @return self
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Gets the value of deleted.
     *
     * @return boolean $deleted
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Sets the value of deleted.
     *
     * @param boolean $deleted $deleted the deleted
     *
     * @return self
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }
}
