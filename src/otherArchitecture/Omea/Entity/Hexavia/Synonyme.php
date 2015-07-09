<?php

namespace Omea\Entity\Hexavia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Synonyme
 *
 * @ORM\Table(name="synonyme", uniqueConstraints={@ORM\UniqueConstraint(name="code_insee_localite", columns={"code_insee_localite", "matricule_voie", "matricule_voie_synonyme"})}, indexes={@ORM\Index(name="libelle_voie_synonyme", columns={"libelle_voie_synonyme"})})
 * @ORM\Entity
 */
class Synonyme
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
     * @ORM\Column(name="matricule_voie", type="integer", nullable=false)
     */
    private $matriculeVoie = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="matricule_voie_synonyme", type="integer", nullable=false)
     */
    private $matriculeVoieSynonyme = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="dernier_element_voie", type="string", length=20, nullable=false)
     */
    private $dernierElementVoie = '';

    /**
     * @var string
     *
     * @ORM\Column(name="dernier_phonetique_p", type="string", length=5, nullable=true)
     */
    private $dernierPhonetiqueP;

    /**
     * @var string
     *
     * @ORM\Column(name="dernier_phonetique_s", type="string", length=5, nullable=true)
     */
    private $dernierPhonetiqueS;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_voie_synonyme", type="string", length=32, nullable=false)
     */
    private $libelleVoieSynonyme = '';

    /**
     * @var string
     *
     * @ORM\Column(name="type_voie_synonyme_abrege", type="string", length=4, nullable=false)
     */
    private $typeVoieSynonymeAbrege = '';

    /**
     * @var string
     *
     * @ORM\Column(name="descripteur_libelle_voie_synonyme", type="string", length=10, nullable=false)
     */
    private $descripteurLibelleVoieSynonyme = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="ind_standardisation", type="smallint", nullable=false)
     */
    private $indStandardisation = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="matricule_roudis", type="integer", nullable=false)
     */
    private $matriculeRoudis = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="type_appellation", type="smallint", nullable=false)
     */
    private $typeAppellation = '0';

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
     * @param string $descripteurLibelleVoieSynonyme
     */
    public function setDescripteurLibelleVoieSynonyme($descripteurLibelleVoieSynonyme)
    {
        $this->descripteurLibelleVoieSynonyme = $descripteurLibelleVoieSynonyme;
    }

    /**
     * @return string
     */
    public function getDescripteurLibelleVoieSynonyme()
    {
        return $this->descripteurLibelleVoieSynonyme;
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
     * @param int $indStandardisation
     */
    public function setIndStandardisation($indStandardisation)
    {
        $this->indStandardisation = $indStandardisation;
    }

    /**
     * @return int
     */
    public function getIndStandardisation()
    {
        return $this->indStandardisation;
    }

    /**
     * @param string $libelleVoieSynonyme
     */
    public function setLibelleVoieSynonyme($libelleVoieSynonyme)
    {
        $this->libelleVoieSynonyme = $libelleVoieSynonyme;
    }

    /**
     * @return string
     */
    public function getLibelleVoieSynonyme()
    {
        return $this->libelleVoieSynonyme;
    }

    /**
     * @param int $matriculeRoudis
     */
    public function setMatriculeRoudis($matriculeRoudis)
    {
        $this->matriculeRoudis = $matriculeRoudis;
    }

    /**
     * @return int
     */
    public function getMatriculeRoudis()
    {
        return $this->matriculeRoudis;
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
     * @param int $matriculeVoieSynonyme
     */
    public function setMatriculeVoieSynonyme($matriculeVoieSynonyme)
    {
        $this->matriculeVoieSynonyme = $matriculeVoieSynonyme;
    }

    /**
     * @return int
     */
    public function getMatriculeVoieSynonyme()
    {
        return $this->matriculeVoieSynonyme;
    }

    /**
     * @param int $typeAppellation
     */
    public function setTypeAppellation($typeAppellation)
    {
        $this->typeAppellation = $typeAppellation;
    }

    /**
     * @return int
     */
    public function getTypeAppellation()
    {
        return $this->typeAppellation;
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
     * @param string $typeVoieSynonymeAbrege
     */
    public function setTypeVoieSynonymeAbrege($typeVoieSynonymeAbrege)
    {
        $this->typeVoieSynonymeAbrege = $typeVoieSynonymeAbrege;
    }

    /**
     * @return string
     */
    public function getTypeVoieSynonymeAbrege()
    {
        return $this->typeVoieSynonymeAbrege;
    }

}
