<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="DOSSIER_RIB")
 * @ORM\Entity
 */
class DossierRib
{

    /**
     *
     * @var integer $idDossierRib
     *
     *      @ORM\Column(name="ID_DOSSIER", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idDossierRib;

    /**
     *
     * @var integer $idBanque
     *
     *      @ORM\Column(name="ID_BA", type="integer")
     */
    private $idBanque;

    /**
     * @ORM\ManyToOne(targetEntity="Civilite")
     * @ORM\JoinColumn(name="CIVILITE", referencedColumnName = "ID_CIV")
     */
    private $civilite;

    /**
     *
     * @var string $nom
     *
     *      @ORM\Column(name="NOM", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     *
     * @var string $prenom
     *
     *      @ORM\Column(name="PRENOM", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     *
     * @var text $adresse
     *
     *      @ORM\Column(name="ADRESSE", type="text", nullable=true)
     */
    private $adresse;

    /**
     *
     * @var integer $codeBanque
     *
     *      @ORM\Column(name="CODE_BANQUE", type="integer", nullable=true)
     */
    private $codeBanque;

    /**
     *
     * @var integer $codeGuichet
     *
     *      @ORM\Column(name="CODE_GUICHET", type="integer", nullable=true)
     */
    private $codeGuichet;

    /**
     *
     * @var integer $codeRib
     *
     *      @ORM\Column(name="CODE_RIB", type="integer", nullable=true)
     */
    private $codeRib;

    /**
     *
     * @var string $numeroCompte
     *
     *      @ORM\Column(name="NUMERO_COMPTE", type="string", length=11, nullable=true)
     */
    private $numeroCompte;

    // Getter & setter
    public function getIdDossierRib()
    {
        return $this->idDossierRib;
    }

    public function setIdDossierRib($idDossierRib)
    {
        $this->idDossierRib = $idDossierRib;
    }

    public function getIdBanque()
    {
        return $this->idBanque;
    }

    public function setIdBanque($idBanque)
    {
        $this->idBanque = $idBanque;
    }

    public function getCivilite()
    {
        return $this->civilite;
    }

    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    public function getCodeBanque()
    {
        return $this->codeBanque;
    }

    public function setCodeBanque($codeBanque)
    {
        $this->codeBanque = $codeBanque;
    }

    public function getCodeGuichet()
    {
        return $this->codeGuichet;
    }

    public function setCodeGuichet($codeGuichet)
    {
        $this->codeGuichet = $codeGuichet;
    }

    public function getCodeRib()
    {
        return $this->codeRib;
    }

    public function setCodeRib($codeRib)
    {
        $this->codeRib = $codeRib;
    }

    public function getNumeroCompte()
    {
        return $this->numeroCompte;
    }

    public function setNumeroCompte($numeroCompte)
    {
        $this->numeroCompte = $numeroCompte;
    }
}
