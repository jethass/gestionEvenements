<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClientPrepaiement
 *
 * @ORM\Table(name="CLIENT_PREPAIEMENT", indexes={@ORM\Index(name="FK_FORFAIT_REMISE_PREPAIEMENT_ID_idx", columns={"FORFAIT_REMISE_PREPAIEMENT_ID"}), @ORM\Index(name="FK_CLIENT_ID_idx", columns={"CLIENT_ID"}), @ORM\Index(name="FK_CLIENT_PREPAIEMENT_ETAT_idx", columns={"ETAT"})})
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\ClientPrepaiementRepository")
 */
class ClientPrepaiement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_CLIENT_PREPAIEMENT", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idClientPrepaiement;

    /**
     * @var float
     *
     * @ORM\Column(name="MONTANT_INITIAL", type="float", precision=10, scale=2, nullable=false)
     */
    private $montantInitial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ACQUIS_PREPAIEMENT", type="datetime", nullable=true)
     */
    private $dtAcquisPrepaiement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_DEB_PREPAIEMENT", type="date", nullable=true)
     */
    private $dtDebPrepaiement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_FIN_PREPAIEMENT", type="date", nullable=true)
     */
    private $dtFinPrepaiement;

    /**
     * @var \ForfaitRemisePrepaiement
     *
     * @ORM\ManyToOne(targetEntity="ForfaitRemisePrepaiement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FORFAIT_REMISE_PREPAIEMENT_ID", referencedColumnName="ID_FORFAIT_REMISE_PREPAIEMENT")
     * })
     */
    private $forfaitRemisePrepaiement;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CLIENT_ID", referencedColumnName="ID_CLIENT")
     * })
     */
    private $client;

    /**
     * @var \ClientPrepaiementEtat
     *
     * @ORM\ManyToOne(targetEntity="ClientPrepaiementEtat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ETAT", referencedColumnName="ID_CLIENT_PREPAIEMENT_ETAT")
     * })
     */
    private $etat;

    /**
     * @ORM\OneToOne(targetEntity="Transaction")
     * @ORM\JoinColumn(name="ID_TRANS", referencedColumnName="ID_TRANS")
     **/
    private $transaction;

    /**
     * Get idClientPrepaiement
     *
     * @return integer
     */
    public function getIdClientPrepaiement()
    {
        return $this->idClientPrepaiement;
    }

    /**
     * Set montantInitial
     *
     * @param  float             $montantInitial
     * @return ClientPrepaiement
     */
    public function setMontantInitial($montantInitial)
    {
        $this->montantInitial = $montantInitial;

        return $this;
    }

    /**
     * Get montantInitial
     *
     * @return float
     */
    public function getMontantInitial()
    {
        return $this->montantInitial;
    }

    /**
     * Set dtAcquisPrepaiement
     *
     * @param  \DateTime         $dtAcquisPrepaiement
     * @return ClientPrepaiement
     */
    public function setDtAcquisPrepaiement($dtAcquisPrepaiement)
    {
        $this->dtAcquisPrepaiement = $dtAcquisPrepaiement;

        return $this;
    }

    /**
     * Get dtAcquisPrepaiement
     *
     * @return \DateTime
     */
    public function getDtAcquisPrepaiement()
    {
        return $this->dtAcquisPrepaiement;
    }

    /**
     * Set dtDebPrepaiement
     *
     * @param  \DateTime         $dtDebPrepaiement
     * @return ClientPrepaiement
     */
    public function setDtDebPrepaiement($dtDebPrepaiement)
    {
        $this->dtDebPrepaiement = $dtDebPrepaiement;

        return $this;
    }

    /**
     * Get dtDebPrepaiement
     *
     * @return \DateTime
     */
    public function getDtDebPrepaiement()
    {
        return $this->dtDebPrepaiement;
    }

    /**
     * Set dtFinPrepaiement
     *
     * @param  \DateTime         $dtFinPrepaiement
     * @return ClientPrepaiement
     */
    public function setDtFinPrepaiement($dtFinPrepaiement)
    {
        $this->dtFinPrepaiement = $dtFinPrepaiement;

        return $this;
    }

    /**
     * Get dtFinPrepaiement
     *
     * @return \DateTime
     */
    public function getDtFinPrepaiement()
    {
        return $this->dtFinPrepaiement;
    }

    /**
     * Set forfaitRemisePrepaiement
     *
     * @param  ForfaitRemisePrepaiement $forfaitRemisePrepaiement
     * @return ClientPrepaiement
     */
    public function setForfaitRemisePrepaiement(ForfaitRemisePrepaiement $forfaitRemisePrepaiement = null)
    {
        $this->forfaitRemisePrepaiement = $forfaitRemisePrepaiement;

        return $this;
    }

    /**
     * Get forfaitRemisePrepaiement
     *
     * @return ForfaitRemisePrepaiement
     */
    public function getForfaitRemisePrepaiement()
    {
        return $this->forfaitRemisePrepaiement;
    }

    /**
     * Set client
     *
     * @param  Client            $client
     * @return ClientPrepaiement
     */
    public function setClient(Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set etat
     *
     * @param  ClientPrepaiementEtat $etat
     * @return ClientPrepaiement
     */
    public function setEtat(ClientPrepaiementEtat $etat = null)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return ClientPrepaiementEtat
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $transaction
     */
    public function setTransaction($transaction)
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
}
