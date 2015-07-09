<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="TRANSACTION_SAP")
 * @ORM\Entity
 */
class TransactionSap
{
    /**
     * @var integer $idTransSap
     * @ORM\Column(name="ID_TRANS_SAP", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idTransSap;

    /**
     * @ORM\ManyToOne(targetEntity="Transaction", inversedBy="transactionSap")
     * @ORM\JoinColumn(name="ID_TRANS", referencedColumnName = "ID_TRANS")
     */
    private $transaction;

    /**
     * @var integer $idTrans
     * @ORM\Column(name="ID_TRANS", type="integer", nullable=true)
     */
    private $idTrans;

    /**
     * @var integer $idNivSub
     * @ORM\Column(name="ID_NIV_SUB", type="integer", nullable=true)
     */
    private $idNivSub;

    /**
     *  @ORM\OneToOne(targetEntity="SapNivSubOffre")
     *  @ORM\JoinColumn(name="ID_NIV_SUB", referencedColumnName = "ID_NIV_SUB")
     */
    private $sapNivSubOffre;

    /**
     * @var integer $idHierOffre
     * @ORM\Column(name="ID_HIER_OFFRE", type="integer", nullable=true)
     */
    private $idHierOffre;

    /**
     *  @ORM\OneToOne(targetEntity="SapHierarchieOffre")
     *  @ORM\JoinColumn(name="ID_HIER_OFFRE", referencedColumnName = "ID_HIER_OFFRE")
     */
    private $sapHierarchieOffre;

    /**
     * @var integer $isTraiteSap
     * @ORM\Column(name="IS_TRAITE_SAP", type="smallint")
     */
    private $isTraiteSap;

    /**
     * @var integer $isValideSap
     * @ORM\Column(name="IS_VALID_SAP", type="smallint")
     */
    private $isValideSap;

    /**
     * @var integer $idFlux
     * @ORM\Column(name="ID_FLUX", type="integer", nullable=true)
     */
    private $idFlux;

    /**
     * @var integer $idCodeError
     * @ORM\Column(name="ID_CODE_ERROR", type="integer")
     */
    private $idCodeError;

    /**
     * @var integer $isTraite
     * @ORM\Column(name="IS_TRAITE", type="smallint")
     */
    private $isTraite;

    /**
     * @var integer $dateDerTraitement
     * @ORM\Column(name="DATE_DER_TRAITEMENT", type="datetime")
     */
    private $dateDerTraitement;

    /**
     * @return the $sapHierarchieOffre
     */
    public function getSapHierarchieOffre()
    {
        return $this->sapHierarchieOffre;
    }

    /**
     * @param field_type $sapHierarchieOffre
     */
    public function setSapHierarchieOffre($sapHierarchieOffre)
    {
        $this->sapHierarchieOffre = $sapHierarchieOffre;
    }

    /**
     * @return the $sapNivSubOffre
     */
    public function getSapNivSubOffre()
    {
        return $this->sapNivSubOffre;
    }

    /**
     * @param field_type $sapNivSubOffre
     */
    public function setSapNivSubOffre($sapNivSubOffre)
    {
        $this->sapNivSubOffre = $sapNivSubOffre;
    }

    /**
     * @return the $idTrans
     */
    public function getIdTrans()
    {
        return $this->idTrans;
    }

    /**
     * @param integer $idTrans
     */
    public function setIdTrans($idTrans)
    {
        $this->idTrans = $idTrans;
    }

    /**
     * @return the $idTransSap
     */
    public function getIdTransSap()
    {
        return $this->idTransSap;
    }

    /**
     * @return the $transaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * @return the $idNivSub
     */
    public function getIdNivSub()
    {
        return $this->idNivSub;
    }

    /**
     * @return the $idHierOffre
     */
    public function getIdHierOffre()
    {
        return $this->idHierOffre;
    }

    /**
     * @return the $isTraiteSap
     */
    public function getIsTraiteSap()
    {
        return $this->isTraiteSap;
    }

    /**
     * @return the $isValideSap
     */
    public function getIsValideSap()
    {
        return $this->isValideSap;
    }

    /**
     * @return the $idFlux
     */
    public function getIdFlux()
    {
        return $this->idFlux;
    }

    /**
     * @return the $idCodeError
     */
    public function getIdCodeError()
    {
        return $this->idCodeError;
    }

    /**
     * @return the $isTraite
     */
    public function getIsTraite()
    {
        return $this->isTraite;
    }

    /**
     * @return the $dateDerTraitement
     */
    public function getDateDerTraitement()
    {
        return $this->dateDerTraitement;
    }

    /**
     * @param number $idTransSap
     */
    public function setIdTransSap($idTransSap)
    {
        $this->idTransSap = $idTransSap;
    }

    /**
     * @param field_type $transaction
     */
    public function setTransaction($transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * @param number $idNivSub
     */
    public function setIdNivSub($idNivSub)
    {
        $this->idNivSub = $idNivSub;
    }

    /**
     * @param number $idHierOffre
     */
    public function setIdHierOffre($idHierOffre)
    {
        $this->idHierOffre = $idHierOffre;
    }

    /**
     * @param number $isTraiteSap
     */
    public function setIsTraiteSap($isTraiteSap)
    {
        $this->isTraiteSap = $isTraiteSap;
    }

    /**
     * @param number $isValideSap
     */
    public function setIsValideSap($isValideSap)
    {
        $this->isValideSap = $isValideSap;
    }

    /**
     * @param number $idFlux
     */
    public function setIdFlux($idFlux)
    {
        $this->idFlux = $idFlux;
    }

    /**
     * @param number $idCodeError
     */
    public function setIdCodeError($idCodeError)
    {
        $this->idCodeError = $idCodeError;
    }

    /**
     * @param number $isTraite
     */
    public function setIsTraite($isTraite)
    {
        $this->isTraite = $isTraite;
    }

    /**
     * @param number $dateDerTraitement
     */
    public function setDateDerTraitement($dateDerTraitement)
    {
        $this->dateDerTraitement = $dateDerTraitement;
    }

}
