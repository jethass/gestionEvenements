<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="PAYBOX_CLIENT")
 * @ORM\Entity
 */
class PayboxClient
{
    /**
     * @ORM\Column(name="ID_PAYBOX", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPayboxClient;

    /**
    * @var string $payNumTrans
    * @ORM\Column(name="PAY_NUMTRANS", type="string", length=12, nullable=true)
    */
    private $payNumTrans;

    /**
     * @var string $payTypeTrans
     *  @ORM\Column(name="PAY_TYPETRANS", type="integer", length=3, nullable=true)
     */
    private $payTypeTrans;

    /**
     * @var integer $idClient
     * @ORM\Column(name="ID_CLIENT", type="integer", length=10, nullable=true)
     */
    private $idClient;

    /**
     * @var integer $cycle
     * @ORM\Column(name="CYCLE", type="integer", length=3, nullable=true)
     */
    private $cycle;

    /**
     * @var integer $idArt
     * @ORM\Column(name="ID_ART", type="integer", length=10, nullable=true)
     */
    private $idArt;

    /**
     * @var integer $dateTransaction
     * @ORM\Column(name="DATE_TRANSACTION", type="datetime", nullable=true)
     */
    private $dateTransaction;

    /**
     * @var integer $typeQuestion
     * @ORM\Column(name="TYPE_QUESTION", type="integer", length=3, nullable=true)
     */
    private $typeQuestion;

    /**
     * @var integer $sessionTds
     * @ORM\Column(name="SESSION_TDS", type="integer", length=20, nullable=true)
     */
    private $sessionTds;

    /**
     * Gets the value of idPayboxClient.
     *
     * @return mixed
     */
    public function getIdPayboxClient()
    {
        return $this->idPayboxClient;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setIdPayboxClient($idPayboxClient)
    {
        $this->idPayboxClient = $idPayboxClient;

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
     * Gets the value of idClient.
     *
     * @return integer $idClient
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * Sets the value of idClient.
     *
     * @param integer $idClient $idClient the id client
     *
     * @return self
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;

        return $this;
    }

    /**
     * Gets the value of cycle.
     *
     * @return integer $cycle
     */
    public function getCycle()
    {
        return $this->cycle;
    }

    /**
     * Sets the value of cycle.
     *
     * @param integer $cycle $cycle the cycle
     *
     * @return self
     */
    public function setCycle($cycle)
    {
        $this->cycle = $cycle;

        return $this;
    }

    /**
     * Gets the value of idArt.
     *
     * @return integer $idArt
     */
    public function getIdArt()
    {
        return $this->idArt;
    }

    /**
     * Sets the value of idArt.
     *
     * @param integer $idArt $idArt the id art
     *
     * @return self
     */
    public function setIdArt($idArt)
    {
        $this->idArt = $idArt;

        return $this;
    }

    /**
     * Gets the value of dateTransaction.
     *
     * @return integer $dateTransaction
     */
    public function getDateTransaction()
    {
        return $this->dateTransaction;
    }

    /**
     * Sets the value of dateTransaction.
     *
     * @param integer $dateTransaction $dateTransaction the date transaction
     *
     * @return self
     */
    public function setDateTransaction($dateTransaction)
    {
        $this->dateTransaction = $dateTransaction;

        return $this;
    }

    /**
     * Gets the value of typeQuestion.
     *
     * @return integer $typeQuestion
     */
    public function getTypeQuestion()
    {
        return $this->typeQuestion;
    }

    /**
     * Sets the value of typeQuestion.
     *
     * @param integer $typeQuestion $typeQuestion the type question
     *
     * @return self
     */
    public function setTypeQuestion($typeQuestion)
    {
        $this->typeQuestion = $typeQuestion;

        return $this;
    }

    /**
     * Gets the value of sessionTds.
     *
     * @return integer $sessionTds
     */
    public function getSessionTds()
    {
        return $this->sessionTds;
    }

    /**
     * Sets the value of sessionTds.
     *
     * @param integer $sessionTds $sessionTds the session tds
     *
     * @return self
     */
    public function setSessionTds($sessionTds)
    {
        $this->sessionTds = $sessionTds;

        return $this;
    }
}
