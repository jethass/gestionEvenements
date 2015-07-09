<?php

namespace Omea\Entity\Hexavia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adresse
 *
 * @ORM\Table(name="adresse", uniqueConstraints={@ORM\UniqueConstraint(name="code_insee_localite", columns={"code_insee_localite", "matricule_voie", "code_postal"})}, indexes={@ORM\Index(name="code_insee_localite_2", columns={"code_insee_localite"}), @ORM\Index(name="dernier_element_voie", columns={"dernier_element_voie"}), @ORM\Index(name="dernier_phonetique_p", columns={"dernier_phonetique_p"}), @ORM\Index(name="idx_cp", columns={"code_postal"})})
 * @ORM\Entity(repositoryClass="Omea\Entity\Hexavia\AdresseRepository")
 */
class Adresse
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code_insee_localite", type="string", length=5, nullable=false)
     */
    private $codeInseeLocalite = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="matricule_voie", type="bigint", nullable=false)
     */
    private $matriculeVoie = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="dernier_element_voie", type="string", length=20, nullable=false)
     */
    private $dernierElementVoie = '';

    /**
     * @var string
     *
     * @ORM\Column(name="dernier_phonetique_p", type="string", length=32, nullable=true)
     */
    private $dernierPhonetiqueP;

    /**
     * @var string
     *
     * @ORM\Column(name="dernier_phonetique_s", type="string", length=32, nullable=true)
     */
    private $dernierPhonetiqueS;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_voie", type="string", length=32, nullable=false)
     */
    private $libelleVoie = '';

    /**
     * @var string
     *
     * @ORM\Column(name="type_voie_abrege", type="string", length=4, nullable=false)
     */
    private $typeVoieAbrege = '';

    /**
     * @var string
     *
     * @ORM\Column(name="descripteur_libelle_voie", type="string", length=10, nullable=false)
     */
    private $descripteurLibelleVoie = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="ind_standard", type="smallint", nullable=false)
     */
    private $indStandard = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ind_scindage", type="smallint", nullable=false)
     */
    private $indScindage = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="code_postal", type="integer", nullable=false)
     */
    private $codePostal = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="borne_impaire_inf", type="integer", nullable=false)
     */
    private $borneImpaireInf = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="extension_bii", type="string", length=1, nullable=false)
     */
    private $extensionBii = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="borne_impaire_sup", type="integer", nullable=false)
     */
    private $borneImpaireSup = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="extension_bis", type="string", length=1, nullable=false)
     */
    private $extensionBis = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="borne_paire_inf", type="integer", nullable=false)
     */
    private $bornePaireInf = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="extension_bpi", type="string", length=1, nullable=false)
     */
    private $extensionBpi = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="born_paire_sup", type="integer", nullable=false)
     */
    private $bornPaireSup = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="extension_bps", type="string", length=1, nullable=false)
     */
    private $extensionBps = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="matricule_rodis", type="integer", nullable=false)
     */
    private $matriculeRodis = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_cre", type="date", nullable=false)
     */
    private $dateCre = '0000-00-00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_maj", type="date", nullable=false)
     */
    private $dateMaj = '0000-00-00';

    /**
     * @var string
     *
     * @ORM\Column(name="type_maj", type="string", length=1, nullable=false)
     */
    private $typeMaj = '';

    /**
     * @param int $bornPaireSup
     */
    public function setBornPaireSup($bornPaireSup)
    {
        $this->bornPaireSup = $bornPaireSup;
    }

    /**
     * @return int
     */
    public function getBornPaireSup()
    {
        return $this->bornPaireSup;
    }

    /**
     * @param int $borneImpaireInf
     */
    public function setBorneImpaireInf($borneImpaireInf)
    {
        $this->borneImpaireInf = $borneImpaireInf;
    }

    /**
     * @return int
     */
    public function getBorneImpaireInf()
    {
        return $this->borneImpaireInf;
    }

    /**
     * @param int $borneImpaireSup
     */
    public function setBorneImpaireSup($borneImpaireSup)
    {
        $this->borneImpaireSup = $borneImpaireSup;
    }

    /**
     * @return int
     */
    public function getBorneImpaireSup()
    {
        return $this->borneImpaireSup;
    }

    /**
     * @param int $bornePaireInf
     */
    public function setBornePaireInf($bornePaireInf)
    {
        $this->bornePaireInf = $bornePaireInf;
    }

    /**
     * @return int
     */
    public function getBornePaireInf()
    {
        return $this->bornePaireInf;
    }

    /**
     * @param string $codeInseeLocalite
     */
    public function setCodeInseeLocalite($codeInseeLocalite)
    {
        $this->codeInseeLocalite = $codeInseeLocalite;
    }

    /**
     * @return string
     */
    public function getCodeInseeLocalite()
    {
        return $this->codeInseeLocalite;
    }

    /**
     * @param int $codePostal
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }

    /**
     * @return int
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * @param \DateTime $dateCre
     */
    public function setDateCre($dateCre)
    {
        $this->dateCre = $dateCre;
    }

    /**
     * @return \DateTime
     */
    public function getDateCre()
    {
        return $this->dateCre;
    }

    /**
     * @param \DateTime $dateMaj
     */
    public function setDateMaj($dateMaj)
    {
        $this->dateMaj = $dateMaj;
    }

    /**
     * @return \DateTime
     */
    public function getDateMaj()
    {
        return $this->dateMaj;
    }

    /**
     * @param string $dernierElementVoie
     */
    public function setDernierElementVoie($dernierElementVoie)
    {
        $this->dernierElementVoie = $dernierElementVoie;
    }

    /**
     * @return string
     */
    public function getDernierElementVoie()
    {
        return $this->dernierElementVoie;
    }

    /**
     * @param string $dernierPhonetiqueP
     */
    public function setDernierPhonetiqueP($dernierPhonetiqueP)
    {
        $this->dernierPhonetiqueP = $dernierPhonetiqueP;
    }

    /**
     * @return string
     */
    public function getDernierPhonetiqueP()
    {
        return $this->dernierPhonetiqueP;
    }

    /**
     * @param string $dernierPhonetiqueS
     */
    public function setDernierPhonetiqueS($dernierPhonetiqueS)
    {
        $this->dernierPhonetiqueS = $dernierPhonetiqueS;
    }

    /**
     * @return string
     */
    public function getDernierPhonetiqueS()
    {
        return $this->dernierPhonetiqueS;
    }

    /**
     * @param string $descripteurLibelleVoie
     */
    public function setDescripteurLibelleVoie($descripteurLibelleVoie)
    {
        $this->descripteurLibelleVoie = $descripteurLibelleVoie;
    }

    /**
     * @return string
     */
    public function getDescripteurLibelleVoie()
    {
        return $this->descripteurLibelleVoie;
    }

    /**
     * @param string $extensionBii
     */
    public function setExtensionBii($extensionBii)
    {
        $this->extensionBii = $extensionBii;
    }

    /**
     * @return string
     */
    public function getExtensionBii()
    {
        return $this->extensionBii;
    }

    /**
     * @param string $extensionBis
     */
    public function setExtensionBis($extensionBis)
    {
        $this->extensionBis = $extensionBis;
    }

    /**
     * @return string
     */
    public function getExtensionBis()
    {
        return $this->extensionBis;
    }

    /**
     * @param string $extensionBpi
     */
    public function setExtensionBpi($extensionBpi)
    {
        $this->extensionBpi = $extensionBpi;
    }

    /**
     * @return string
     */
    public function getExtensionBpi()
    {
        return $this->extensionBpi;
    }

    /**
     * @param string $extensionBps
     */
    public function setExtensionBps($extensionBps)
    {
        $this->extensionBps = $extensionBps;
    }

    /**
     * @return string
     */
    public function getExtensionBps()
    {
        return $this->extensionBps;
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
     * @param int $indScindage
     */
    public function setIndScindage($indScindage)
    {
        $this->indScindage = $indScindage;
    }

    /**
     * @return int
     */
    public function getIndScindage()
    {
        return $this->indScindage;
    }

    /**
     * @param int $indStandard
     */
    public function setIndStandard($indStandard)
    {
        $this->indStandard = $indStandard;
    }

    /**
     * @return int
     */
    public function getIndStandard()
    {
        return $this->indStandard;
    }

    /**
     * @param string $libelleVoie
     */
    public function setLibelleVoie($libelleVoie)
    {
        $this->libelleVoie = $libelleVoie;
    }

    /**
     * @return string
     */
    public function getLibelleVoie()
    {
        return $this->libelleVoie;
    }

    /**
     * @param int $matriculeRodis
     */
    public function setMatriculeRodis($matriculeRodis)
    {
        $this->matriculeRodis = $matriculeRodis;
    }

    /**
     * @return int
     */
    public function getMatriculeRodis()
    {
        return $this->matriculeRodis;
    }

    /**
     * @param int $matriculeVoie
     */
    public function setMatriculeVoie($matriculeVoie)
    {
        $this->matriculeVoie = $matriculeVoie;
    }

    /**
     * @return int
     */
    public function getMatriculeVoie()
    {
        return $this->matriculeVoie;
    }

    /**
     * @param string $typeMaj
     */
    public function setTypeMaj($typeMaj)
    {
        $this->typeMaj = $typeMaj;
    }

    /**
     * @return string
     */
    public function getTypeMaj()
    {
        return $this->typeMaj;
    }

    /**
     * @param string $typeVoieAbrege
     */
    public function setTypeVoieAbrege($typeVoieAbrege)
    {
        $this->typeVoieAbrege = $typeVoieAbrege;
    }

    /**
     * @return string
     */
    public function getTypeVoieAbrege()
    {
        return $this->typeVoieAbrege;
    }

}
