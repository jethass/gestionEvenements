<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * Omea\Entity\HistoriqueMobiltron
 *
 * @ORM\Table(name="HISTORIQUE_MOBILTRON")
 * @ORM\Entity
 */
class HistoriqueMobiltron
{

    /**
     *
     * @var integer @ORM\Column(name="ID_HM", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idHm;

    /**
     * @ORM\ManyToOne(targetEntity="Commandes", inversedBy="historiqueMobiltron")
     * @ORM\JoinColumn(name="ID_CMD", referencedColumnName="ID_CMD")
     */
    private $commandes;

    /**
     * @ORM\OneToOne(targetEntity="TypeLivraisonColiposte")
     * @ORM\JoinColumn(name="TYPE_ETAT_LIVRAISON", referencedColumnName="TYPE_ETAT_LIVRAISON")
     */
    private $typeLivraisonColiposte;

    /**
     * Doctrine 2.1 Limitations and Known Issues -> 27.1.1
     * @ORM\ManyToOne(targetEntity="RetourMobiltronSsmotifs")
     * @ORM\JoinColumn(name="TYPE_RETOUR_MOBILTRON", referencedColumnName="CODE_RETOUR_MOBILTRON_SSMOTIF")
     */
    private $retourMobiltronSsmotifs;

    /**
     *
     * @var integer @ORM\Column(name="ID_CMD", type="bigint", nullable=false)
     */
    private $idCmd;

    /**
     *
     * @var integer @ORM\Column(name="ID_ENT", type="smallint", nullable=true)
     */
    private $idEnt;

    /**
     *
     * @var integer @ORM\Column(name="ID_ART_MAR", type="integer", nullable=true)
     */
    private $idArtMar;

    /**
     *
     * @var \DateTime @ORM\Column(name="DATE_COLIS", type="date", nullable=true)
     */
    private $dateColis;

    /**
     *
     * @var string @ORM\Column(name="NUM_COLIS", type="string", length=20, nullable=true)
     */
    private $numColis;

    /**
     *
     * @var \DateTime @ORM\Column(name="DEMANDE_ENVOI_MOBILTRON", type="date", nullable=false)
     */
    private $demandeEnvoiMobiltron;

    /**
     *
     * @var \DateTime @ORM\Column(name="RETOUR_MOBILTRON", type="date", nullable=true)
     */
    private $retourMobiltron;

    /**
     *
     * @var integer @ORM\Column(name="ID_PRODUIT", type="smallint", nullable=true)
     */
    private $idProduit;

    /**
     *
     * @var integer @ORM\Column(name="ID_ART_NOM", type="integer", nullable=true)
     */
    private $idArtNom;

    /**
     *
     * @var integer @ORM\Column(name="IMEI", type="bigint", nullable=true)
     */
    private $imei;

    /**
     *
     * @var integer @ORM\Column(name="NSCE", type="bigint", nullable=true)
     */
    private $nsce;

    /**
     *
     * @var integer @ORM\Column(name="NUM_SERIE", type="bigint", nullable=true)
     */
    private $numSerie;

    /**
     *
     * @var string @ORM\Column(name="CODE_ERR", type="string", length=5, nullable=true)
     */
    private $codeErr;

    /**
     *
     * @var boolean @ORM\Column(name="ENVOIS", type="boolean", nullable=false)
     */
    private $envois;

    /**
     *
     * @var boolean @ORM\Column(name="CEGID_ETAT_DESTOCK", type="boolean", nullable=false)
     */
    private $cegidEtatDestock;

    /**
     *
     * @var string @ORM\Column(name="REEXPEDIER", type="string", nullable=false)
     */
    private $reexpedier;

    /**
     *
     * @var \DateTime @ORM\Column(name="DATE_ETAT_LIVRAISON", type="datetime", nullable=true)
     */
    private $dateEtatLivraison;

    /**
     *
     * @var string @ORM\Column(name="NUM_SERIE_IAD", type="string", length=255, nullable=true)
     */
    private $numSerieIad;

    /**
     *
     * @var string @ORM\Column(name="NUM_SERIE_STB", type="string", length=255, nullable=true)
     */
    private $numSerieStb;

    /**
     *
     * @var string @ORM\Column(name="TYPE_RETOUR_MOBILTRON", type="string", length=5, nullable=true)
     */
    private $typeRetourMobiltron;

    /**
     *
     * @var integer @ORM\Column(name="ID_CMD_RETOUR", type="integer", nullable=true)
     */
    private $idCmdRetour;

    /**
     * @ORM\Column(name="TYPE_ETAT_LIVRAISON", type="integer", nullable=true)
     */
    private $typeEtatLivraison;

    /**
     *
     * @return the $retourMobiltronSsmotifs
     */
    public function getRetourMobiltronSsmotifs()
    {
        return $this->retourMobiltronSsmotifs;
    }

    /**
     *
     * @param field_type $retourMobiltronSsmotifs
     */
    public function setRetourMobiltronSsmotifs($retourMobiltronSsmotifs)
    {
        $this->retourMobiltronSsmotifs = $retourMobiltronSsmotifs;
    }

    /**
     *
     * @return the $commandes
     */
    public function getCommandes()
    {
        return $this->commandes;
    }

    /**
     *
     * @return the $typeLivraisonColiposte
     */
    public function getTypeLivraisonColiposte()
    {
        return $this->typeLivraisonColiposte;
    }

    /**
     *
     * @param field_type $commandes
     */
    public function setCommandes($commandes)
    {
        $this->commandes = $commandes;
    }

    /**
     *
     * @param field_type $typeLivraisonColiposte
     */
    public function setTypeLivraisonColiposte($typeLivraisonColiposte)
    {
        $this->typeLivraisonColiposte = $typeLivraisonColiposte;
    }

    /**
     *
     * @return the $idHm
     */
    public function getIdHm()
    {
        return $this->idHm;
    }

    /**
     *
     * @return the $idCmd
     */
    public function getIdCmd()
    {
        return $this->idCmd;
    }

    /**
     *
     * @return the $idEnt
     */
    public function getIdEnt()
    {
        return $this->idEnt;
    }

    /**
     *
     * @return the $idArtMar
     */
    public function getIdArtMar()
    {
        return $this->idArtMar;
    }

    /**
     *
     * @return the $dateColis
     */
    public function getDateColis()
    {
        return $this->dateColis;
    }

    /**
     *
     * @return the $numColis
     */
    public function getNumColis()
    {
        return $this->numColis;
    }

    /**
     *
     * @return the $demandeEnvoiMobiltron
     */
    public function getDemandeEnvoiMobiltron()
    {
        return $this->demandeEnvoiMobiltron;
    }

    /**
     *
     * @return the $retourMobiltron
     */
    public function getRetourMobiltron()
    {
        return $this->retourMobiltron;
    }

    /**
     *
     * @return the $idProduit
     */
    public function getIdProduit()
    {
        return $this->idProduit;
    }

    /**
     *
     * @return the $idArtNom
     */
    public function getIdArtNom()
    {
        return $this->idArtNom;
    }

    /**
     *
     * @return the $imei
     */
    public function getImei()
    {
        return $this->imei;
    }

    /**
     *
     * @return the $nsce
     */
    public function getNsce()
    {
        return $this->nsce;
    }

    /**
     *
     * @return the $numSerie
     */
    public function getNumSerie()
    {
        return $this->numSerie;
    }

    /**
     *
     * @return the $codeErr
     */
    public function getCodeErr()
    {
        return $this->codeErr;
    }

    /**
     *
     * @return the $envois
     */
    public function getEnvois()
    {
        return $this->envois;
    }

    /**
     *
     * @return the $cegidEtatDestock
     */
    public function getCegidEtatDestock()
    {
        return $this->cegidEtatDestock;
    }

    /**
     *
     * @return the $reexpedier
     */
    public function getReexpedier()
    {
        return $this->reexpedier;
    }

    /**
     *
     * @return the $dateEtatLivraison
     */
    public function getDateEtatLivraison()
    {
        return $this->dateEtatLivraison;
    }

    /**
     *
     * @return the $numSerieIad
     */
    public function getNumSerieIad()
    {
        return $this->numSerieIad;
    }

    /**
     *
     * @return the $numSerieStb
     */
    public function getNumSerieStb()
    {
        return $this->numSerieStb;
    }

    /**
     *
     * @return the $typeRetourMobiltron
     */
    public function getTypeRetourMobiltron()
    {
        return $this->typeRetourMobiltron;
    }

    /**
     *
     * @return the $idCmdRetour
     */
    public function getIdCmdRetour()
    {
        return $this->idCmdRetour;
    }

    /**
     *
     * @return the $typeEtatLivraison
     */
    public function getTypeEtatLivraison()
    {
        return $this->typeEtatLivraison;
    }

    /**
     *
     * @param number $idHm
     */
    public function setIdHm($idHm)
    {
        $this->idHm = $idHm;
    }

    /**
     *
     * @param number $idCmd
     */
    public function setIdCmd($idCmd)
    {
        $this->idCmd = $idCmd;
    }

    /**
     *
     * @param number $idEnt
     */
    public function setIdEnt($idEnt)
    {
        $this->idEnt = $idEnt;
    }

    /**
     *
     * @param number $idArtMar
     */
    public function setIdArtMar($idArtMar)
    {
        $this->idArtMar = $idArtMar;
    }

    /**
     *
     * @param DateTime $dateColis
     */
    public function setDateColis($dateColis)
    {
        $this->dateColis = $dateColis;
    }

    /**
     *
     * @param string $numColis
     */
    public function setNumColis($numColis)
    {
        $this->numColis = $numColis;
    }

    /**
     *
     * @param DateTime $demandeEnvoiMobiltron
     */
    public function setDemandeEnvoiMobiltron($demandeEnvoiMobiltron)
    {
        $this->demandeEnvoiMobiltron = $demandeEnvoiMobiltron;
    }

    /**
     *
     * @param DateTime $retourMobiltron
     */
    public function setRetourMobiltron($retourMobiltron)
    {
        $this->retourMobiltron = $retourMobiltron;
    }

    /**
     *
     * @param number $idProduit
     */
    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;
    }

    /**
     *
     * @param number $idArtNom
     */
    public function setIdArtNom($idArtNom)
    {
        $this->idArtNom = $idArtNom;
    }

    /**
     *
     * @param number $imei
     */
    public function setImei($imei)
    {
        $this->imei = $imei;
    }

    /**
     *
     * @param number $nsce
     */
    public function setNsce($nsce)
    {
        $this->nsce = $nsce;
    }

    /**
     *
     * @param number $numSerie
     */
    public function setNumSerie($numSerie)
    {
        $this->numSerie = $numSerie;
    }

    /**
     *
     * @param string $codeErr
     */
    public function setCodeErr($codeErr)
    {
        $this->codeErr = $codeErr;
    }

    /**
     *
     * @param boolean $envois
     */
    public function setEnvois($envois)
    {
        $this->envois = $envois;
    }

    /**
     *
     * @param boolean $cegidEtatDestock
     */
    public function setCegidEtatDestock($cegidEtatDestock)
    {
        $this->cegidEtatDestock = $cegidEtatDestock;
    }

    /**
     *
     * @param string $reexpedier
     */
    public function setReexpedier($reexpedier)
    {
        $this->reexpedier = $reexpedier;
    }

    /**
     *
     * @param DateTime $dateEtatLivraison
     */
    public function setDateEtatLivraison($dateEtatLivraison)
    {
        $this->dateEtatLivraison = $dateEtatLivraison;
    }

    /**
     *
     * @param string $numSerieIad
     */
    public function setNumSerieIad($numSerieIad)
    {
        $this->numSerieIad = $numSerieIad;
    }

    /**
     *
     * @param string $numSerieStb
     */
    public function setNumSerieStb($numSerieStb)
    {
        $this->numSerieStb = $numSerieStb;
    }

    /**
     *
     * @param string $typeRetourMobiltron
     */
    public function setTypeRetourMobiltron($typeRetourMobiltron)
    {
        $this->typeRetourMobiltron = $typeRetourMobiltron;
    }

    /**
     *
     * @param number $idCmdRetour
     */
    public function setIdCmdRetour($idCmdRetour)
    {
        $this->idCmdRetour = $idCmdRetour;
    }

    /**
     *
     * @param field_type $typeEtatLivraison
     */
    public function setTypeEtatLivraison($typeEtatLivraison)
    {
        $this->typeEtatLivraison = $typeEtatLivraison;
    }
}
