<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * Omea\Entity\Transaction
 *
 * @ORM\Table(name="TRANSACTION")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\TransactionRepository")
 */
class Transaction
{

    /**
     * @ORM\Column(name="ID_TRANS", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idTrans;

    /**
     * @ORM\OneToMany(targetEntity="Commandes", mappedBy="transaction")
     * @ORM\JoinColumn(name="ID_TRANS", referencedColumnName="ID_TRANS", nullable=true)
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity="TransactionSap", mappedBy="transaction")
     * @ORM\JoinColumn(name="ID_TRANS", referencedColumnName="ID_TRANS", nullable=true)
     */
    private $transactionSap;

    /**
     * @ORM\OneToOne(targetEntity="Distributeurs")
     * @ORM\JoinColumns(
     *      @ORM\JoinColumn(name="ID_DIS", referencedColumnName="ID_DIS"),
     *      @ORM\JoinColumn(name="ID_MAG", referencedColumnName="ID_MAG"))
     */
    private $distributeur;

    /**
     * @ORM\ManyToOne(targetEntity="Civilite")
     * @ORM\JoinColumn(name="CIVILITE_LIV", referencedColumnName = "ID_CIV")
     */
    private $civilite;

    /**
     * @ORM\Column(name="ID_DIS", type="smallint", nullable=true)
     */
    private $idDis;

    /**
     * @ORM\Column(name="ID_MAG", type="integer", nullable=true, unique=true)
     */
    private $idMag;

    /**
     * @ORM\Column(name="DATE_TRANS", type="datetime", nullable=true)
     */
    private $dateTrans;

    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="transaction")
     * @ORM\JoinColumn(name="ID_CLIENT", referencedColumnName = "ID_CLIENT")
     */
    private $client;

    /**
     * @ORM\Column(name="ID_CLIENT", type="integer")
     */
    private $idClient;

    /**
     * @ORM\Column(name="ID_FRAIS", type="integer")
     */
    private $idFrais;

    /**
     * @ORM\Column(name="MONTANT_TOTAL", type="decimal")
     */
    private $montantTotal;

    /**
     * @ORM\Column(name="CIVILITE_LIV", type="integer")
     */
    private $civiliteLiv;

    /**
     * @ORM\Column(name="NOM_LIV", type="string", length=50, nullable=true)
     */
    private $nomLiv;

    /**
     * @ORM\Column(name="PRENOM_LIV", type="string", length=50, nullable=true)
     */
    private $prenomLiv;

    /**
     * @ORM\Column(name="NUMERO_RUE", type="string", length=10)
     */
    private $numeroRue;

    /**
     * @ORM\Column(name="ADR_LIV", type="text")
     */
    private $adrLiv;

    /**
     * @ORM\Column(name="ADR_COMPL_LIV", type="text")
     */
    private $adrComplLiv;

    /**
     * @ORM\Column(name="CODPOS_LIV", type="integer", nullable=true)
     */
    private $codposLiv;

    /**
     * @ORM\Column(name="VILLE_LIV", type="string", length=255, nullable=true)
     */
    private $villeLiv;

    /**
     * @ORM\Column(name="SOCIETE_LIV", type="string", length=255, nullable=true)
     */
    private $societeLiv;

    /**
     * @ORM\Column(name="ID_PAYBOX", type="integer")
     */
    private $idPaybox;

    /**
     * @ORM\Column(name="PAIEMENT_CHEQUE", type="smallint", nullable=true)
     */
    private $paiementCheque;

    /**
     * @ORM\Column(name="RELANCE_CHEQUE", type="date", nullable=true)
     */
    private $relanceCheque;

    /**
     * @ORM\Column(name="RECEPTION_CHEQUE", type="date", nullable=true)
     */
    private $receptionCheque;

    /**
     * @ORM\Column(name="ORIGINE", type="string", length=255)
     */
    private $origine;

    /**
     * @ORM\Column(name="CODE_PARRAIN", type="string", length=10, nullable=true, unique=true)
     */
    private $codeParrain;

    /**
     * @ORM\Column(name="TRANS_TRAITE", type="date", nullable=true)
     */
    private $transTraite;

    /**
     * @ORM\Column(name="TRANS_ANNULE", type="date", nullable=true)
     */
    private $transAnnule;

    /**
     * @ORM\Column(name="EXPORT_ORANGE", type="datetime", nullable=true)
     */
    private $exportOrange;

    /**
     * @ORM\Column(name="FACTURE", type="string", length=20, nullable=true, unique=true)
     */
    private $facture;

    /**
     * @ORM\Column(name="REMARQUES_ADMIN", type="text", nullable=true)
     */
    private $remarquesAdmin;

    /**
     * @ORM\Column(name="REPRISE_CEGID", type="smallint")
     */
    private $repriseCegid;

    /**
     * @ORM\Column(name="GENERE_CEGID", type="datetime", nullable=true)
     */
    private $genereCegid;

    /**
     * @ORM\Column(name="RETOUR_CEGID", type="smallint")
     */
    private $retourCegid;

    /**
     * @ORM\Column(name="RELANCE_FINALISATION", type="datetime", nullable=true)
     */
    private $relanceFinalisation;

    /**
     * @ORM\Column(name="CODE_PARENTAL", type="smallint")
     */
    private $codeParental;

    /**
     * @ORM\Column(name="IS_PACKLS", type="smallint")
     */
    private $isPackLs;

    /**
     * @ORM\Column(name="IDFHIS", type="integer", nullable=true)
     */
    private $idFhis;

    /**
     * @ORM\Column(name="DATE_DERN_MAJ", type="datetime", nullable=true)
     */
    private $dateDerneMaj;

    /**
     * @ORM\Column(name="ENSEIGNE", type="string", length=25, nullable=true)
     */
    private $enseigne;

    /**
     * @ORM\Column(name="ID_SOURCE_APPEL", type="integer")
     */
    private $idSourceAppel;



    public function __construct()
    {
        $this->populateDefault();
    }

    /**
     * Populate the entity with the default mysql values
     */
    private function populateDefault()
    {
        $this->idFrais = '1';
        $this->origine = 'N.C';
        $this->repriseCegid = '0';
        $this->retourCegid = '0';
        $this->codeParental = '0';
        $this->isPackLs = '0';
    }


    /**
     * @return the $civilite
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * @param field_type $civilite
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;
    }

    /**
     * @return the $transactionSap
     */
    public function getTransactionSap()
    {
        return $this->transactionSap;
    }

    /**
     * @param field_type $transactionSap
     */
    public function setTransactionSap($transactionSap)
    {
        $this->transactionSap = $transactionSap;
    }

    /**
     * @return the $distributeur
     */
    public function getDistributeur()
    {
        return $this->distributeur;
    }

    /**
     * @param field_type $distributeur
     */
    public function setDistributeur($distributeur)
    {
        $this->distributeur = $distributeur;
    }

    /**
     *
     * @return  $commandes
     */
    public function getCommandes()
    {
        return $this->commandes;
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
     * @return the $idTrans
     */
    public function getIdTrans()
    {
        return $this->idTrans;
    }

    /**
     *
     * @return the $idDis
     */
    public function getIdDis()
    {
        return $this->idDis;
    }

    /**
     *
     * @return the $idMag
     */
    public function getIdMag()
    {
        return $this->idMag;
    }

    /**
     *
     * @return the $dateTrans
     */
    public function getDateTrans()
    {
        return $this->dateTrans;
    }

    /**
     *
     * @return the $Client
     */
    public function getClient()
    {
        return $this->client;
    }
    /**
     *
     * @return the $idClient
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     *
     * @return the $idFrais
     */
    public function getIdFrais()
    {
        return $this->idFrais;
    }

    /**
     *
     * @return the $montantTotal
     */
    public function getMontantTotal()
    {
        return $this->montantTotal;
    }

    /**
     *
     * @return the $civiliteLiv
     */
    public function getCiviliteLiv()
    {
        return $this->civiliteLiv;
    }

    /**
     *
     * @return the $nomLiv
     */
    public function getNomLiv()
    {
        return $this->nomLiv;
    }

    /**
     *
     * @return the $prenomLiv
     */
    public function getPrenomLiv()
    {
        return $this->prenomLiv;
    }

    /**
     *
     * @return the $numeroRue
     */
    public function getNumeroRue()
    {
        return $this->numeroRue;
    }

    /**
     *
     * @return the $adrLiv
     */
    public function getAdrLiv()
    {
        return $this->adrLiv;
    }

    /**
     *
     * @return the $adrComplLiv
     */
    public function getAdrComplLiv()
    {
        return $this->adrComplLiv;
    }

    /**
     *
     * @return the $codposLiv
     */
    public function getCodposLiv()
    {
        return $this->codposLiv;
    }

    /**
     *
     * @return the $villeLiv
     */
    public function getVilleLiv()
    {
        return $this->villeLiv;
    }

    /**
     *
     * @return the $societeLiv
     */
    public function getSocieteLiv()
    {
        return $this->societeLiv;
    }

    /**
     *
     * @return the $idPaybox
     */
    public function getIdPaybox()
    {
        return $this->idPaybox;
    }

    /**
     *
     * @return the $paiementCheque
     */
    public function getPaiementCheque()
    {
        return $this->paiementCheque;
    }

    /**
     *
     * @return the $relanceCheque
     */
    public function getRelanceCheque()
    {
        return $this->relanceCheque;
    }

    /**
     *
     * @return the $receptionCheque
     */
    public function getReceptionCheque()
    {
        return $this->receptionCheque;
    }

    /**
     *
     * @return the $origine
     */
    public function getOrigine()
    {
        return $this->origine;
    }

    /**
     *
     * @return the $codeParrain
     */
    public function getCodeParrain()
    {
        return $this->codeParrain;
    }

    /**
     *
     * @return the $transTraite
     */
    public function getTransTraite()
    {
        return $this->transTraite;
    }

    /**
     *
     * @return the $transAnnule
     */
    public function getTransAnnule()
    {
        return $this->transAnnule;
    }

    /**
     *
     * @return the $exportOrange
     */
    public function getExportOrange()
    {
        return $this->exportOrange;
    }

    /**
     *
     * @return the $facture
     */
    public function getFacture()
    {
        return $this->facture;
    }

    /**
     *
     * @return the $remarquesAdmin
     */
    public function getRemarquesAdmin()
    {
        return $this->remarquesAdmin;
    }

    /**
     *
     * @return the $repriseCegid
     */
    public function getRepriseCegid()
    {
        return $this->repriseCegid;
    }

    /**
     *
     * @return the $genereCegid
     */
    public function getGenereCegid()
    {
        return $this->genereCegid;
    }

    /**
     *
     * @return the $retourCegid
     */
    public function getRetourCegid()
    {
        return $this->retourCegid;
    }

    /**
     *
     * @return the $relanceFinalisation
     */
    public function getRelanceFinalisation()
    {
        return $this->relanceFinalisation;
    }

    /**
     *
     * @return the $codeParental
     */
    public function getCodeParental()
    {
        return $this->codeParental;
    }

    /**
     *
     * @return the $isPackLs
     */
    public function getIsPackLs()
    {
        return $this->isPackLs;
    }

    /**
     *
     * @return the $idFhis
     */
    public function getIdFhis()
    {
        return $this->idFhis;
    }

    /**
     *
     * @return the $dateDerneMaj
     */
    public function getDateDerneMaj()
    {
        return $this->dateDerneMaj;
    }

    /**
     *
     * @return the $enseigne
     */
    public function getEnseigne()
    {
        return $this->enseigne;
    }

    /**
     *
     * @return the $idSourceAppel
     */
    public function getIdSourceAppel()
    {
        return $this->idSourceAppel;
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
     * @param field_type $idDis
     */
    public function setIdDis($idDis)
    {
        $this->idDis = $idDis;
    }

    /**
     *
     * @param field_type $idMag
     */
    public function setIdMag($idMag)
    {
        $this->idMag = $idMag;
    }

    /**
     *
     * @param field_type $dateTrans
     */
    public function setDateTrans($dateTrans)
    {
        $this->dateTrans = $dateTrans;
    }

    /**
     *
     * @param field_type $Client
     */
    public function setClient($Client)
    {
        $this->client = $Client;
    }
    /**
     *
     * @param field_type $idClient
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }
    /**
     *
     * @param field_type $idFrais
     */
    public function setIdFrais($idFrais)
    {
        $this->idFrais = $idFrais;
    }

    /**
     *
     * @param field_type $montantTotal
     */
    public function setMontantTotal($montantTotal)
    {
        $this->montantTotal = $montantTotal;
    }

    /**
     *
     * @param field_type $civiliteLiv
     */
    public function setCiviliteLiv($civiliteLiv)
    {
        $this->civiliteLiv = $civiliteLiv;
    }

    /**
     *
     * @param field_type $nomLiv
     */
    public function setNomLiv($nomLiv)
    {
        $this->nomLiv = $nomLiv;
    }

    /**
     *
     * @param field_type $prenomLiv
     */
    public function setPrenomLiv($prenomLiv)
    {
        $this->prenomLiv = $prenomLiv;
    }

    /**
     *
     * @param field_type $numeroRue
     */
    public function setNumeroRue($numeroRue)
    {
        $this->numeroRue = $numeroRue;
    }

    /**
     *
     * @param field_type $adrLiv
     */
    public function setAdrLiv($adrLiv)
    {
        $this->adrLiv = $adrLiv;
    }

    /**
     *
     * @param field_type $adrComplLiv
     */
    public function setAdrComplLiv($adrComplLiv)
    {
        $this->adrComplLiv = $adrComplLiv;
    }

    /**
     *
     * @param field_type $codposLiv
     */
    public function setCodposLiv($codposLiv)
    {
        $this->codposLiv = $codposLiv;
    }

    /**
     *
     * @param field_type $villeLiv
     */
    public function setVilleLiv($villeLiv)
    {
        $this->villeLiv = $villeLiv;
    }

    /**
     *
     * @param field_type $societeLiv
     */
    public function setSocieteLiv($societeLiv)
    {
        $this->societeLiv = $societeLiv;
    }

    /**
     *
     * @param field_type $idPaybox
     */
    public function setIdPaybox($idPaybox)
    {
        $this->idPaybox = $idPaybox;
    }

    /**
     *
     * @param field_type $paiementCheque
     */
    public function setPaiementCheque($paiementCheque)
    {
        $this->paiementCheque = $paiementCheque;
    }

    /**
     *
     * @param field_type $relanceCheque
     */
    public function setRelanceCheque($relanceCheque)
    {
        $this->relanceCheque = $relanceCheque;
    }

    /**
     *
     * @param field_type $receptionCheque
     */
    public function setReceptionCheque($receptionCheque)
    {
        $this->receptionCheque = $receptionCheque;
    }

    /**
     *
     * @param field_type $origine
     */
    public function setOrigine($origine)
    {
        $this->origine = $origine;
    }

    /**
     *
     * @param field_type $codeParrain
     */
    public function setCodeParrain($codeParrain)
    {
        $this->codeParrain = $codeParrain;
    }

    /**
     *
     * @param field_type $transTraite
     */
    public function setTransTraite($transTraite)
    {
        $this->transTraite = $transTraite;
    }

    /**
     *
     * @param field_type $transAnnule
     */
    public function setTransAnnule($transAnnule)
    {
        $this->transAnnule = $transAnnule;
    }

    /**
     *
     * @param field_type $exportOrange
     */
    public function setExportOrange($exportOrange)
    {
        $this->exportOrange = $exportOrange;
    }

    /**
     *
     * @param field_type $facture
     */
    public function setFacture($facture)
    {
        $this->facture = $facture;
    }

    /**
     *
     * @param field_type $remarquesAdmin
     */
    public function setRemarquesAdmin($remarquesAdmin)
    {
        $this->remarquesAdmin = $remarquesAdmin;
    }

    /**
     *
     * @param field_type $repriseCegid
     */
    public function setRepriseCegid($repriseCegid)
    {
        $this->repriseCegid = $repriseCegid;
    }

    /**
     *
     * @param field_type $genereCegid
     */
    public function setGenereCegid($genereCegid)
    {
        $this->genereCegid = $genereCegid;
    }

    /**
     *
     * @param field_type $retourCegid
     */
    public function setRetourCegid($retourCegid)
    {
        $this->retourCegid = $retourCegid;
    }

    /**
     *
     * @param field_type $relanceFinalisation
     */
    public function setRelanceFinalisation($relanceFinalisation)
    {
        $this->relanceFinalisation = $relanceFinalisation;
    }

    /**
     *
     * @param field_type $codeParental
     */
    public function setCodeParental($codeParental)
    {
        $this->codeParental = $codeParental;
    }

    /**
     *
     * @param field_type $isPackLs
     */
    public function setIsPackLs($isPackLs)
    {
        $this->isPackLs = $isPackLs;
    }

    /**
     *
     * @param field_type $idFhis
     */
    public function setIdFhis($idFhis)
    {
        $this->idFhis = $idFhis;
    }

    /**
     *
     * @param field_type $dateDerneMaj
     */
    public function setDateDerneMaj($dateDerneMaj)
    {
        $this->dateDerneMaj = $dateDerneMaj;
    }

    /**
     *
     * @param field_type $enseigne
     */
    public function setEnseigne($enseigne)
    {
        $this->enseigne = $enseigne;
    }

    /**
     *
     * @param field_type $idSourceAppel
     */
    public function setIdSourceAppel($idSourceAppel)
    {
        $this->idSourceAppel = $idSourceAppel;
    }
}
