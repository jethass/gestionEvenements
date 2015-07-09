<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;
use Omea\Entity\EboutiqueVM\WwwCodePromo;

/**
 * @ORM\Table(name="TRANSACTION_REMISE")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\TransactionRemiseRepository")
 */
class TransactionRemise
{
    /**
     * @ORM\Column(name="ID_TRANS_REMISE", type="integer", length=11)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idTransRemise;

    /**
     * @ORM\Column(name="ID_TRANS", type="integer", length=11, nullable=false)
     */
    private $idTrans;

    /**
     * @ORM\ManyToOne(targetEntity="Transaction")
     * @ORM\JoinColumn(name="ID_TRANS", referencedColumnName="ID_TRANS")
     */
    private $transaction;

    /**
     * @var $montantRemiseMobile
     * @ORM\Column(name="MONTANT_REMISE_MOBILE", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $montantRemiseMobile;

    /**
     * @ORM\Column(name="ID_CODE_PROMO", type="integer", length=11, nullable=false)
     */
    private $idCodePromo;

    /**
     * @ORM\Column(name="ID_REMISE", type="integer", length=11, nullable=false)
     */
    private $idRemise;

    /**
     * @param mixed $idCodePromo
     */
    public function setIdCodePromo( $idCodePromo )
    {
        $this->idCodePromo = $idCodePromo;
    }

    /**
     * @return mixed
     */
    public function getIdCodePromo()
    {
        return $this->idCodePromo;
    }

    /**
     * @param mixed $idRemise
     */
    public function setIdRemise( $idRemise )
    {
        $this->idRemise = $idRemise;
    }

    /**
     * @return mixed
     */
    public function getIdRemise()
    {
        return $this->idRemise;
    }

    /**
     * @param mixed $idTrans
     */
    public function setIdTrans( $idTrans )
    {
        $this->idTrans = $idTrans;
    }

    /**
     * @return mixed
     */
    public function getIdTrans()
    {
        return $this->idTrans;
    }

    /**
     * @param mixed $idTransRemise
     */
    public function setIdTransRemise( $idTransRemise )
    {
        $this->idTransRemise = $idTransRemise;
    }

    /**
     * @return mixed
     */
    public function getIdTransRemise()
    {
        return $this->idTransRemise;
    }

    /**
     * @param mixed $montantRemiseMobile
     */
    public function setMontantRemiseMobile( $montantRemiseMobile )
    {
        $this->montantRemiseMobile = $montantRemiseMobile;
    }

    /**
     * @return mixed
     */
    public function getMontantRemiseMobile()
    {
        return $this->montantRemiseMobile;
    }

    /**
     * @param mixed $transaction
     */
    public function setTransaction( $transaction )
    {
        $this->transaction = $transaction;
    }

    /**
     * @return mixed
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * @param mixed $wwwRemise
     */
    public function setWwwRemise( $wwwRemise )
    {
        $this->wwwRemise = $wwwRemise;
    }

    /**
     * @return mixed
     */
    public function getWwwRemise()
    {
        return $this->wwwRemise;
    }

}
