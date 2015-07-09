<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="ADRESSES")
 * @ORM\Entity
 */
class Adresse
{
    /**
     *
     * @var integer $id
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @var string $numeroVoie
     * @ORM\Column(name="NUMERO_VOIE", type="string", length=10)
     */
    private $numeroVoie;

    /**
     *
     * @var string $nomVoie
     * @ORM\Column(name="NOM_VOIE", type="string", length=128)
     */
    private $nomVoie;

    /**
     *
     * @var string $ville
     * @ORM\Column(name="VILLE", type="string", length=64)
     */
    private $ville;

    /**
     *
     * @var string $codePostal
     * @ORM\Column(name="CODE_POSTAL", type="string", length=5)
     */
    private $codePostal;

    /**
     *
     * @var string $typeVoie
     * @ORM\Column(name="TYPE_VOIE", type="string", length=255)
     */
    private $typeVoie;

    /**
     *
     * @var string $batiment
     * @ORM\Column(name="BATIMENT", type="string", length=4)
     */
    private $batiment;

    /**
     *
     * @var string $escalier
     * @ORM\Column(name="ESCALIER", type="string", length=2)
     */
    private $escalier;

    /**
     *
     * @var string $etage
     * @ORM\Column(name="ETAGE", type="string", length=2)
     */
    private $etage;

    /**
     *
     * @var string $porte
     * @ORM\Column(name="PORTE", type="string", length=5)
     */
    private $porte;

    /**
     *
     * @var string $logoFt
     * @ORM\Column(name="LOGO_FT", type="string", length=5)
     */
    private $logoFt;

    /**
     *
     * @var string $adresseComplement
     * @ORM\Column(name="ADRESSES_COMPLEMENT", type="string", length=50)
     */
    private $adressesComplement;

    /**
     *
     * @var string $typeAdresse
     * @ORM\Column(name="TYPE_ADRESSES", type="string")
     */
    private $typeAdresses;

    /**
     *
     * @var boolean $estMaison
     * @ORM\Column(name="EST_MAISON", type="boolean")
     */
    private $estMaison;

    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $numeroVoie
     */
    public function getNumeroVoie()
    {
        return $this->numeroVoie;
    }

    /**
     * @return the $nomVoie
     */
    public function getNomVoie()
    {
        return $this->nomVoie;
    }

    /**
     * @return the $ville
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @return the $codePostal
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * @return the $typeVoie
     */
    public function getTypeVoie()
    {
        return $this->typeVoie;
    }

    /**
     * @return the $batiment
     */
    public function getBatiment()
    {
        return $this->batiment;
    }

    /**
     * @return the $escalier
     */
    public function getEscalier()
    {
        return $this->escalier;
    }

    /**
     * @return the $etage
     */
    public function getEtage()
    {
        return $this->etage;
    }

    /**
     * @return the $porte
     */
    public function getPorte()
    {
        return $this->porte;
    }

    /**
     * @return the $logoFt
     */
    public function getLogoFt()
    {
        return $this->logoFt;
    }

    /**
     * @return the $adressesComplement
     */
    public function getAdressesComplement()
    {
        return $this->adressesComplement;
    }

    /**
     * @return the $typeAdresses
     */
    public function getTypeAdresses()
    {
        return $this->typeAdresses;
    }

    /**
     * @return the $estMaison
     */
    public function getEstMaison()
    {
        return $this->estMaison;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $numeroVoie
     */
    public function setNumeroVoie($numeroVoie)
    {
        $this->numeroVoie = $numeroVoie;
    }

    /**
     * @param string $nomVoie
     */
    public function setNomVoie($nomVoie)
    {
        $this->nomVoie = $nomVoie;
    }

    /**
     * @param string $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @param string $codePostal
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }

    /**
     * @param string $typeVoie
     */
    public function setTypeVoie($typeVoie)
    {
        $this->typeVoie = $typeVoie;
    }

    /**
     * @param string $batiment
     */
    public function setBatiment($batiment)
    {
        $this->batiment = $batiment;
    }

    /**
     * @param string $escalier
     */
    public function setEscalier($escalier)
    {
        $this->escalier = $escalier;
    }

    /**
     * @param string $etage
     */
    public function setEtage($etage)
    {
        $this->etage = $etage;
    }

    /**
     * @param string $porte
     */
    public function setPorte($porte)
    {
        $this->porte = $porte;
    }

    /**
     * @param string $logoFt
     */
    public function setLogoFt($logoFt)
    {
        $this->logoFt = $logoFt;
    }

    /**
     * @param string $adressesComplement
     */
    public function setAdressesComplement($adressesComplement)
    {
        $this->adressesComplement = $adressesComplement;
    }

    /**
     * @param string $typeAdresses
     */
    public function setTypeAdresses($typeAdresses)
    {
        $this->typeAdresses = $typeAdresses;
    }

    /**
     * @param boolean $estMaison
     */
    public function setEstMaison($estMaison)
    {
        $this->estMaison = $estMaison;
    }

}
