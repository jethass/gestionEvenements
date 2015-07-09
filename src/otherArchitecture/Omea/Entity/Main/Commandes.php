<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * Omea\Entity\Main
 *
 * @ORM\Table(name="COMMANDES")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\CommandesRepository")
 */
class Commandes
{

    /**
     * @ORM\Column(name="ID_CMD", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idCmd;

    /**
     * @ORM\ManyToOne(targetEntity="Transaction", inversedBy="commandes")
     * @ORM\JoinColumn(name="ID_TRANS", referencedColumnName="ID_TRANS")
     */
    private $transaction;

    /**
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumn(name="ID_ART", referencedColumnName = "ID_ART")
     */
    private $article;

    /**
     * @ORM\OneToMany(targetEntity="HistoriqueMobiltron", mappedBy="commandes")
     * @ORM\JoinColumn(name="ID_CMD", referencedColumnName="ID_CMD", nullable=true)
     */
    private $historiqueMobiltron;

    /**
     * Entite StockNsce situé dans business-core mais dans le même namespace
     * @ORM\OneToMany(targetEntity="StockNsce", mappedBy="commandes")
     * @ORM\JoinColumn(name="ID_CMD", referencedColumnName="ID_CMD", nullable=true)
     */
    private $stockNsce;

    /**
     * @ORM\Column(name="ID_TRANS", type="integer")
     */
    private $idTrans;

    /**
     * @ORM\Column(name="ID_TC", type="integer")
     */
    private $idTc;

    /**
     * @ORM\Column(name="ID_PRODUIT", type="integer")
     */
    private $idProduit;

    /**
     * @ORM\Column(name="ID_ART", type="integer")
     */
    private $idArt;

    /**
     * @ORM\Column(name="CODE", type="string")
     */
    private $code;

    /**
     * @ORM\Column(name="PRIX_FACTURE", type="decimal")
     */
    private $prixFacture;

    /**
     * @ORM\Column(name="CODE_ENVOI_SMS", type="string")
     */
    private $codeEnvoiSms;

    /**
     * @ORM\Column(name="CODE_RETOUR_SMS", type="string")
     */
    private $codeRetourSms;

    /**
     * @ORM\Column(name="COMMENTAIRE_SMS", type="string")
     */
    private $commentaireSms;

    /**
     * @ORM\Column(name="COMMENTAIRE", type="string")
     */
    private $commentaire;

    /**
     * @ORM\Column(name="OPT_COMMUNIQUER", type="smallint")
     */
    private $optCommuniquer;

    /**
     * @ORM\Column(name="CEGID_ETAT_DESTOCK", type="smallint")
     */
    private $cegidEtatDestock;

    /**
     * @ORM\Column(name="ID_DMDEXPE_RAPPORT", type="integer")
     */
    private $idDmdexpeRapport;

    /**
     * @ORM\Column(name="ID_TRACA_RAPPORT", type="integer")
     */
    private $idTracaRapport;

    /**
     * @ORM\Column(name="CEGID_NUM_PIECE", type="integer")
     */
    private $cegidNumPiece;

    /**
     * @ORM\Column(name="ENVOI_MAIL_SMS", type="date")
     */
    private $envoiMailSms;

    /**
     * @ORM\Column(name="ID_HNO", type="smallint")
     */
    private $idHno;

    private $statut;

    private $sousStatut;


    public function __construct()
    {
        $this->populateDefault();
    }

    /**
     * Populate the entity with the default mysql values
     */
    private function populateDefault()
    {
        $this->optCommuniquer = '0';
        $this->cegidEtatDestock = '0';
        $this->idHno = '1';
    }


    /**
     *
     * @return the $transaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     *
     * @param field_type $transaction
     */
    public function setTransaction($transaction)
    {
        $this->transaction = $transaction;
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
     * @return the $idTrans
     */
    public function getIdTrans()
    {
        return $this->idTrans;
    }

    /**
     *
     * @return the $idTc
     */
    public function getIdTc()
    {
        return $this->idTc;
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
     * @return the $idArt
     */
    public function getIdArt()
    {
        return $this->idArt;
    }

    /**
     *
     * @return the $code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     *
     * @return the $prixFacture
     */
    public function getPrixFacture()
    {
        return $this->prixFacture;
    }

    /**
     *
     * @return the $codeEnvoiSms
     */
    public function getCodeEnvoiSms()
    {
        return $this->codeEnvoiSms;
    }

    /**
     *
     * @return the $codeRetourSms
     */
    public function getCodeRetourSms()
    {
        return $this->codeRetourSms;
    }

    /**
     *
     * @return the $commentaireSms
     */
    public function getCommentaireSms()
    {
        return $this->commentaireSms;
    }

    /**
     *
     * @return the $commentaire
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     *
     * @return the $optCommuniquer
     */
    public function getOptCommuniquer()
    {
        return $this->optCommuniquer;
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
     * @return the $idDmdexpeRapport
     */
    public function getIdDmdexpeRapport()
    {
        return $this->idDmdexpeRapport;
    }

    /**
     *
     * @return the $idTracaRapport
     */
    public function getIdTracaRapport()
    {
        return $this->idTracaRapport;
    }

    /**
     *
     * @return the $cegidNumPiece
     */
    public function getCegidNumPiece()
    {
        return $this->cegidNumPiece;
    }

    /**
     *
     * @return the $envoiMailSms
     */
    public function getEnvoiMailSms()
    {
        return $this->envoiMailSms;
    }

    /**
     *
     * @return the $idHno
     */
    public function getIdHno()
    {
        return $this->idHno;
    }

    /**
     *
     * @param field_type $idCmd
     */
    public function setIdCmd($idCmd)
    {
        $this->idCmd = $idCmd;
    }

    /**
     *
     * @param field_type $idTrans
     */
    public function setIdTrans($idTrans)
    {
        $this->idTrans = $idTrans;
    }

    /**
     *
     * @param field_type $idTc
     */
    public function setIdTc($idTc)
    {
        $this->idTc = $idTc;
    }

    /**
     *
     * @param field_type $idProduit
     */
    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;
    }

    /**
     *
     * @param field_type $idArt
     */
    public function setIdArt($idArt)
    {
        $this->idArt = $idArt;
    }

    /**
     *
     * @param field_type $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     *
     * @param field_type $prixFacture
     */
    public function setPrixFacture($prixFacture)
    {
        $this->prixFacture = $prixFacture;
    }

    /**
     *
     * @param field_type $codeEnvoiSms
     */
    public function setCodeEnvoiSms($codeEnvoiSms)
    {
        $this->codeEnvoiSms = $codeEnvoiSms;
    }

    /**
     *
     * @param field_type $codeRetourSms
     */
    public function setCodeRetourSms($codeRetourSms)
    {
        $this->codeRetourSms = $codeRetourSms;
    }

    /**
     *
     * @param field_type $commentaireSms
     */
    public function setCommentaireSms($commentaireSms)
    {
        $this->commentaireSms = $commentaireSms;
    }

    /**
     *
     * @param field_type $commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }

    /**
     *
     * @param field_type $optCommuniquer
     */
    public function setOptCommuniquer($optCommuniquer)
    {
        $this->optCommuniquer = $optCommuniquer;
    }

    /**
     *
     * @param field_type $cegidEtatDestock
     */
    public function setCegidEtatDestock($cegidEtatDestock)
    {
        $this->cegidEtatDestock = $cegidEtatDestock;
    }

    /**
     *
     * @param field_type $idDmdexpeRapport
     */
    public function setIdDmdexpeRapport($idDmdexpeRapport)
    {
        $this->idDmdexpeRapport = $idDmdexpeRapport;
    }

    /**
     *
     * @param field_type $idTracaRapport
     */
    public function setIdTracaRapport($idTracaRapport)
    {
        $this->idTracaRapport = $idTracaRapport;
    }

    /**
     *
     * @param field_type $cegidNumPiece
     */
    public function setCegidNumPiece($cegidNumPiece)
    {
        $this->cegidNumPiece = $cegidNumPiece;
    }

    /**
     *
     * @param field_type $envoiMailSms
     */
    public function setEnvoiMailSms($envoiMailSms)
    {
        $this->envoiMailSms = $envoiMailSms;
    }

    /**
     *
     * @param field_type $idHno
     */
    public function setIdHno($idHno)
    {
        $this->idHno = $idHno;
    }

    /**
     * @return Article $article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @return the $historiqueMobiltron
     */
    public function getHistoriqueMobiltron()
    {
        return $this->historiqueMobiltron;
    }

    /**
     * @return the $stockNsce
     */
    public function getStockNsce()
    {
        return $this->stockNsce;
    }

    /**
     * @param field_type $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
    }

    /**
     * @param field_type $historiqueMobiltron
     */
    public function setHistoriqueMobiltron($historiqueMobiltron)
    {
        $this->historiqueMobiltron = $historiqueMobiltron;
    }

    /**
     * @param field_type $stockNsce
     */
    public function setStockNsce($stockNsce)
    {
        $this->stockNsce = $stockNsce;
    }

    /**
     * Recupere le statut et le sous statut de la commmande
     * - TRANS_ANNULE != NULL           => statut = ENREGISTREMENT - sousStatut = ANNULEE
     * - TRANS_TRAITE == NULL           => statut = ENREGISTREMENT - sousStatut = ENREGISTREE
     * - TRANS_TRAITE != NULL
     *      * NUM_COLIS == NULL         => statut = PREPARATION     - sousStatut = STOCK
     *      * NUM_COLIS == POST	        => statut = EXPEDITION		- sousStatut = EXPEDIEE
     *      * NUM_COLIS != POST
     *          + ETAT_LIVRAISON = 1    => statut = LIVRAISON		- sousStatut = LIVREE
     *          + ETAT_LIVRAISON = 2
     *              / MOTIF == NPAI     => statut = LIVRAISON		- sousStatut = NPAI
     *              / MOTIF == HSTOCK   => statut = PREPARATION		- sousStatut = HORS_STOCK
     *              / MOTIF != NPAI     => statut = EXPEDITION		- sousStatut = EXPEDIEE
     */
    public function getStatut()
    {
        if (! $this->statut) {
            $this->sousStatut = '';
            if ($this->transaction->getTransAnnule() != "") {
                $this->statut = 'ENREGISTREMENT';
                $this->sousStatut = 'ANNULEE';
            } elseif ($this->transaction->getTransTraite() != "") {
                if (! $this->historiqueMobiltron || ! $this->historiqueMobiltron[0] || ! $this->historiqueMobiltron[0]->getNumColis()) {
                    $this->statut = 'PREPARATION';
                    $this->sousStatut = 'STOCK';
                } elseif ($this->historiqueMobiltron[0]->getNumColis() == 'POST') {
                    $this->statut = 'EXPEDITION';
                    $this->sousStatut = 'EXPEDIEE';
                } else {
                    if ($this->historiqueMobiltron[0]->getTypeLivraisonColiposte() && $this->historiqueMobiltron[0]->getTypeLivraisonColiposte()->getLivraisonDestinataireOk() == 1) {
                        $this->statut = 'LIVRAISON';
                        $this->sousStatut = 'LIVREE';
                    } elseif ($this->historiqueMobiltron[0]->getRetourMobiltronSsmotifs() && $this->historiqueMobiltron[0]->getRetourMobiltronSsmotifs()->getLibelleCourtRetourMobiltronSsmotif() == 'NPAI') {
                        $this->statut = 'LIVRAISON';
                        $this->sousStatut = 'NPAI';
                    } elseif ($this->historiqueMobiltron[0]->getRetourMobiltronSsmotifs() && $this->historiqueMobiltron[0]->getRetourMobiltronSsmotifs()->getLibelleCourtRetourMobiltronSsmotif() == 'PLUS DE STOCK') {
                        $this->statut = 'PREPARATION';
                        $this->sousStatut = 'HORS_STOCK';
                    } else {
                        $this->statut = 'EXPEDITION';
                        $this->sousStatut = 'EXPEDIEE';
                    }
                }
            } else {
                $this->statut = 'ENREGISTREMENT';
                $this->sousStatut = 'ENREGISTREE';
            }
        }

        return $this->statut;
    }

    /**
     * Retour le sous statut logistique de la commande recuperer par la method getStatut
     */
    public function getSousStatut()
    {
        if ($this->sousStatut != null) {
            $this->getStatut();
        }

        return $this->sousStatut;
    }
}
