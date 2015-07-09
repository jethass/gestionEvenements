<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="RETOUR_MOBILTRON_MOTIFS")
 * @ORM\Entity
 */
class RetourMobiltronMotifs
{

    /**
     * @ORM\Column(name="ID_RETOUR_MOBILTRON_MOTIF", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRetourMobiltronMotif;

    /**
     * @ORM\Column(name="LIBELLE_RETOUR_MOBILTRON_MOTIF", type="string")
     */
    private $libelleRetourMobiltronMotif;

    /**
     * @ORM\OneToMany(targetEntity="RetourMobiltronSsmotifs", mappedBy="retourMobiltronMotifs")
     */
    private $retourMobiltronSsmotif;

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
     * @return the $libelleRetourMobiltronMotif
     */
    public function getLibelleRetourMobiltronMotif()
    {
        return $this->libelleRetourMobiltronMotif;
    }

    /**
     *
     * @return the $retourMobiltronSsmotif
     */
    public function getRetourMobiltronSsmotif()
    {
        return $this->retourMobiltronSsmotif;
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
     * @param field_type $libelleRetourMobiltronMotif
     */
    public function setLibelleRetourMobiltronMotif($libelleRetourMobiltronMotif)
    {
        $this->libelleRetourMobiltronMotif = $libelleRetourMobiltronMotif;
    }

    /**
     *
     * @param field_type $retourMobiltronSsmotif
     */
    public function setRetourMobiltronSsmotif($retourMobiltronSsmotif)
    {
        $this->retourMobiltronSsmotif = $retourMobiltronSsmotif;
    }
}
