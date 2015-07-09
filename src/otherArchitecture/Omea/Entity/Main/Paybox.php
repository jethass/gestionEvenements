<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="PAYBOX")
 * @ORM\Entity
 */
class Paybox
{
    /**
     * @ORM\Column(name="ID_PAYBOX", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPaybox;

    /**
    * @var string $typePai
    * @ORM\Column(name="TYPE_PAI", type="string", length=20, nullable=true)
    */
    private $typePai;

    /**
    * @var string $payTraitement
    * @ORM\Column(name="PAY_TRAITEMENT", type="string", nullable=true)
    */
    private $payTraitement;

    /**
    * @var string $payNumAppel
    * @ORM\Column(name="PAY_NUMAPPEL", type="string", nullable=true)
    */
    private $payNumAppel;

    /**
    * @var string $payNumTrans
    * @ORM\Column(name="PAY_NUMTRANS", type="string", length=12, nullable=true)
    */
    private $payNumTrans;

    /**
     * @var string $payCoderep
     * @ORM\Column(name="PAY_CODEREP", type="string", nullable=true)
     */
    private $payCoderep;

    /**
     * @var string $payAuto
     * @ORM\Column(name="PAY_AUTO", type="string", nullable=true)
     */
    private $payAuto;

    /**
     * @var string $payComment
     * @ORM\Column(name="PAY_COMMENT", type="string", nullable=true)
     */
    private $payComment;

    /**
     * @var string $payTypeTrans
     * @ORM\Column(name="PAY_TYPETRANS", type="string", length=12, nullable=true)
     */
    private $payTypeTrans;

    /**
     * @var string $cbNum
     * @ORM\Column(name="CB_NUM", type="string", length=16, nullable=true)
     */
    private $cbNum;

    /**
     * @var string $cbCtrl
     * @ORM\Column(name="CB_CTRL", type="integer")
     */
    private $cbCtrl;

    /**
     * @var string $cbDateXp
     * @ORM\Column(name="CB_DATEXP", type="string", length=6, nullable=true)
     */
    private $cbDateXp;

    /**
     * @var string $cbTitulaire
     * @ORM\Column(name="CB_TITULAIRE", type="string", nullable=true)
     */
    private $cbTitulaire;

    /**
     * @var string $idTypeContexte
     * @ORM\Column(name="ID_TYPE_CONTEXTE", type="integer", nullable=true)
     */
    private $idTypeContexte;

    /**
     * @var string $idTypeDemanade
     * @ORM\Column(name="ID_TYPE_DEMANDE", type="integer", nullable=true)
     */
    private $idTypeDemanade;

    /**
     * @var datetime $dateExpirationAutorisation
     * @ORM\Column(name="DATE_EXPIRATION_AUTORISATION", type="integer", nullable=true)
     */
    private $dateExpirationAutorisation;

    /**
     * Gets the value of idPaybox.
     *
     * @return mixed
     */
    public function getIdPaybox()
    {
        return $this->idPaybox;
    }

    /**
     * Sets the value of idPaybox.
     *
     * @param mixed $id the idPaybox
     *
     * @return self
     */
    public function setId($idPaybox)
    {
        $this->idPaybox = $idPaybox;

        return $this;
    }

    /**
     * Gets the value of typePai.
     *
     * @return string $typePai
     */
    public function getTypePai()
    {
        return $this->typePai;
    }

    /**
     * Sets the value of typePai.
     *
     * @param string $typePai $typePai the type pai
     *
     * @return self
     */
    public function setTypePai($typePai)
    {
        $this->typePai = $typePai;

        return $this;
    }

    /**
     * Gets the value of payTraitement.
     *
     * @return string $payTraitement
     */
    public function getPayTraitement()
    {
        return $this->payTraitement;
    }

    /**
     * Sets the value of payTraitement.
     *
     * @param string $payTraitement $payTraitement the pay traitement
     *
     * @return self
     */
    public function setPayTraitement($payTraitement)
    {
        $this->payTraitement = $payTraitement;

        return $this;
    }

    /**
     * Gets the value of payNumAppel.
     *
     * @return string $payNumAppel
     */
    public function getPayNumAppel()
    {
        return $this->payNumAppel;
    }

    /**
     * Sets the value of payNumAppel.
     *
     * @param string $payNumAppel $payNumAppel the pay num appel
     *
     * @return self
     */
    public function setPayNumAppel($payNumAppel)
    {
        $this->payNumAppel = $payNumAppel;

        return $this;
    }

    /**
     * Gets the value of payNumTrans.
     *
     * @return string $payNumTrans
     */
    public function getPayNumTrans()
    {
        return $this->payNumTrans;
    }

    /**
     * Sets the value of payNumTrans.
     *
     * @param string $payNumTrans $payNumTrans the pay num trans
     *
     * @return self
     */
    public function setPayNumTrans($payNumTrans)
    {
        $this->payNumTrans = $payNumTrans;

        return $this;
    }

    /**
     * Gets the value of payCoderep.
     *
     * @return string $payCoderep
     */
    public function getPayCoderep()
    {
        return $this->payCoderep;
    }

    /**
     * Sets the value of payCoderep.
     *
     * @param string $payCoderep $payCoderep the pay codorep
     *
     * @return self
     */
    public function setPayCoderep($payCoderep)
    {
        $this->payCoderep = $payCoderep;

        return $this;
    }

    /**
     * Gets the value of payAuto.
     *
     * @return string $payAuto
     */
    public function getPayAuto()
    {
        return $this->payAuto;
    }

    /**
     * Sets the value of payAuto.
     *
     * @param string $payAuto $payAuto the pay auto
     *
     * @return self
     */
    public function setPayAuto($payAuto)
    {
        $this->payAuto = $payAuto;

        return $this;
    }

    /**
     * Gets the value of payComment.
     *
     * @return string $payComment
     */
    public function getPayComment()
    {
        return $this->payComment;
    }

    /**
     * Sets the value of payComment.
     *
     * @param string $payComment $payComment the pay comment
     *
     * @return self
     */
    public function setPayComment($payComment)
    {
        $this->payComment = $payComment;

        return $this;
    }

    /**
     * Gets the value of payTypeTrans.
     *
     * @return string $payTypeTrans
     */
    public function getPayTypeTrans()
    {
        return $this->payTypeTrans;
    }

    /**
     * Sets the value of payTypeTrans.
     *
     * @param string $payTypeTrans $payTypeTrans the pay type trans
     *
     * @return self
     */
    public function setPayTypeTrans($payTypeTrans)
    {
        $this->payTypeTrans = $payTypeTrans;

        return $this;
    }

    /**
     * Gets the value of cbNum.
     *
     * @return string $cbNum
     */
    public function getCbNum()
    {
        return $this->cbNum;
    }

    /**
     * Sets the value of cbNum.
     *
     * @param string $cbNum $cbNum the cb num
     *
     * @return self
     */
    public function setCbNum($cbNum)
    {
        $this->cbNum = $cbNum;

        return $this;
    }

    /**
     * Gets the value of cbCtrl.
     *
     * @return string $cbCtrl
     */
    public function getCbCtrl()
    {
        return $this->cbCtrl;
    }

    /**
     * Sets the value of cbCtrl.
     *
     * @param string $cbCtrl $cbCtrl the cb ctrl
     *
     * @return self
     */
    public function setCbCtrl($cbCtrl)
    {
        $this->cbCtrl = $cbCtrl;

        return $this;
    }

    /**
     * Gets the value of cbDateXp.
     *
     * @return string $cbDateXp
     */
    public function getCbDateXp()
    {
        return $this->cbDateXp;
    }

    /**
     * Sets the value of cbDateXp.
     *
     * @param string $cbDateXp $cbDateXp the cb date xp
     *
     * @return self
     */
    public function setCbDateXp($cbDateXp)
    {
        $this->cbDateXp = $cbDateXp;

        return $this;
    }

    /**
     * Gets the value of cbTitulaire.
     *
     * @return string $cbTitulaire
     */
    public function getCbTitulaire()
    {
        return $this->cbTitulaire;
    }

    /**
     * Sets the value of cbTitulaire.
     *
     * @param string $cbTitulaire $cbTitulaire the cb titulaire
     *
     * @return self
     */
    public function setCbTitulaire($cbTitulaire)
    {
        $this->cbTitulaire = $cbTitulaire;

        return $this;
    }

    /**
     * Gets the value of idTypeContexte.
     *
     * @return string $idTypeContexte
     */
    public function getIdTypeContexte()
    {
        return $this->idTypeContexte;
    }

    /**
     * Sets the value of idTypeContexte.
     *
     * @param string $idTypeContexte $idTypeContexte the id type contexte
     *
     * @return self
     */
    public function setIdTypeContexte($idTypeContexte)
    {
        $this->idTypeContexte = $idTypeContexte;

        return $this;
    }

    /**
     * Gets the value of idTypeDemanade.
     *
     * @return string $idTypeDemanade
     */
    public function getIdTypeDemanade()
    {
        return $this->idTypeDemanade;
    }

    /**
     * Sets the value of idTypeDemanade.
     *
     * @param string $idTypeDemanade $idTypeDemanade the id type demanade
     *
     * @return self
     */
    public function setIdTypeDemanade($idTypeDemanade)
    {
        $this->idTypeDemanade = $idTypeDemanade;

        return $this;
    }

    /**
     * Gets the value of dateExpirationAutorisation.
     *
     * @return datetime $dateExpirationAutorisation
     */
    public function getDateExpirationAutorisation()
    {
        return $this->dateExpirationAutorisation;
    }

    /**
     * Sets the value of dateExpirationAutorisation.
     *
     * @param datetime $dateExpirationAutorisation $dateExpirationAutorisation the date expiration autorisation
     *
     * @return self
     */
    public function setDateExpirationAutorisation($dateExpirationAutorisation)
    {
        $this->dateExpirationAutorisation = $dateExpirationAutorisation;

        return $this;
    }
}
