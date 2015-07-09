<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="RETOUR_MOBILTRON_SSMOTIFS")
 * @ORM\Entity
 */
class RetourMobiltronSsmotifs
{

    /**
     * @ORM\Column(name="ID_RETOUR_MOBILTRON_SSMOTIF", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idRetourMobiltronSsmotif;

    /**
     * @ORM\ManyToOne(targetEntity="RetourMobiltronMotifs", inversedBy="retourMobiltronSsmotif")
     * @ORM\JoinColumn(name="ID_RETOUR_MOBILTRON_MOTIF", referencedColumnName="ID_RETOUR_MOBILTRON_MOTIF")
     */
    private $retourMobiltronMotifs;

    /**
     * @ORM\Column(name="ID_RETOUR_MOBILTRON_MOTIF", type="integer")
     */
    private $idRetourMobiltronMotif;

    /**
     * @ORM\Column(name="CODE_RETOUR_MOBILTRON_SSMOTIF", type="string")
     */
    private $codeRetourMobiltronSsmotif;

    /**
     * @ORM\Column(name="LIBELLE_COURT_RETOUR_MOBILTRON_SSMOTIF", type="string")
     */
    private $libelleCourtRetourMobiltronSsmotif;

    /**
     * @ORM\Column(name="LIBELLE_LONG_RETOUR_MOBILTRON_SSMOTIF", type="string")
     */
    private $libelleLongRetourMobiltronSsmotif;

    /**
     * @ORM\Column(name="ID_MOTIF", type="integer")
     */
    private $idMotif;

    /**
     * @ORM\Column(name="ID_SSMOTIF", type="integer")
     */
    private $idSsmotif;

    /**
     * @ORM\Column(name="ID_EVENEMENT", type="integer")
     */
    private $idEvenement;

    /**
     * @ORM\Column(name="TYPE_DE_RENVOI", type="integer")
     */
    private $typeDeRenvoi;

    /**
     *
     * @return the $idRetourMobiltronSsmotif
     */
    public function getIdRetourMobiltronSsmotif()
    {
        return $this->idRetourMobiltronSsmotif;
    }

    /**
     *
     * @return the $retourMobiltronMotif
     */
    public function getRetourMobiltronMotif()
    {
        return $this->retourMobiltronMotif;
    }

    /**
     *
     * @return the $idRetourMobiltronMotif
     */
    public function getIdRetourMobiltronMotif()
    {
        return $this->idRetourMobiltronMotif;
    }

    /**
     *
     * @return the $codeRetourMobiltronSsmotif
     */
    public function getCodeRetourMobiltronSsmotif()
    {
        return $this->codeRetourMobiltronSsmotif;
    }

    /**
     *
     * @return the $libelleCourtRetourMobiltronSsmotif
     */
    public function getLibelleCourtRetourMobiltronSsmotif()
    {
        return $this->libelleCourtRetourMobiltronSsmotif;
    }

    /**
     *
     * @return the $libelleLongRetourMobiltronSsmotif
     */
    public function getLibelleLongRetourMobiltronSsmotif()
    {
        return $this->libelleLongRetourMobiltronSsmotif;
    }

    /**
     *
     * @return the $idMotif
     */
    public function getIdMotif()
    {
        return $this->idMotif;
    }

    /**
     *
     * @return the $idSsmotif
     */
    public function getIdSsmotif()
    {
        return $this->idSsmotif;
    }

    /**
     *
     * @return the $idEvenement
     */
    public function getIdEvenement()
    {
        return $this->idEvenement;
    }

    /**
     *
     * @return the $typeDeRenvoi
     */
    public function getTypeDeRenvoi()
    {
        return $this->typeDeRenvoi;
    }

    /**
     *
     * @param field_type $idRetourMobiltronSsmotif
     */
    public function setIdRetourMobiltronSsmotif($idRetourMobiltronSsmotif)
    {
        $this->idRetourMobiltronSsmotif = $idRetourMobiltronSsmotif;
    }

    /**
     *
     * @param field_type $retourMobiltronMotif
     */
    public function setRetourMobiltronMotif($retourMobiltronMotif)
    {
        $this->retourMobiltronMotif = $retourMobiltronMotif;
    }

    /**
     *
     * @param field_type $idRetourMobiltronMotif
     */
    public function setIdRetourMobiltronMotif($idRetourMobiltronMotif)
    {
        $this->idRetourMobiltronMotif = $idRetourMobiltronMotif;
    }

    /**
     *
     * @param field_type $codeRetourMobiltronSsmotif
     */
    public function setCodeRetourMobiltronSsmotif($codeRetourMobiltronSsmotif)
    {
        $this->codeRetourMobiltronSsmotif = $codeRetourMobiltronSsmotif;
    }

    /**
     *
     * @param field_type $libelleCourtRetourMobiltronSsmotif
     */
    public function setLibelleCourtRetourMobiltronSsmotif($libelleCourtRetourMobiltronSsmotif)
    {
        $this->libelleCourtRetourMobiltronSsmotif = $libelleCourtRetourMobiltronSsmotif;
    }

    /**
     *
     * @param field_type $libelleLongRetourMobiltronSsmotif
     */
    public function setLibelleLongRetourMobiltronSsmotif($libelleLongRetourMobiltronSsmotif)
    {
        $this->libelleLongRetourMobiltronSsmotif = $libelleLongRetourMobiltronSsmotif;
    }

    /**
     *
     * @param field_type $idMotif
     */
    public function setIdMotif($idMotif)
    {
        $this->idMotif = $idMotif;
    }

    /**
     *
     * @param field_type $idSsmotif
     */
    public function setIdSsmotif($idSsmotif)
    {
        $this->idSsmotif = $idSsmotif;
    }

    /**
     *
     * @param field_type $idEvenement
     */
    public function setIdEvenement($idEvenement)
    {
        $this->idEvenement = $idEvenement;
    }

    /**
     *
     * @param field_type $typeDeRenvoi
     */
    public function setTypeDeRenvoi($typeDeRenvoi)
    {
        $this->typeDeRenvoi = $typeDeRenvoi;
    }
}
