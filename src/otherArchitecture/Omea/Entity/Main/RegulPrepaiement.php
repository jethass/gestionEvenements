<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * RegulPrepaiement
 *
 * @ORM\Table(name="REGUL_PREPAIEMENT", indexes={@ORM\Index(name="fk_REGUL_PREP_TYPE_ID_idx", columns={"REGUL_PREPAIEMENT_TYPE_ID"}), @ORM\Index(name="FK_HISTO_PREPAIEMENT_ID_idx", columns={"CLIENT_PREPAIEMENT_ID"}), @ORM\Index(name="FK_ID_BILLING_idx", columns={"ID_BILLING"}), @ORM\Index(name="FK_CODE_COMPTABLE_idx", columns={"CODE_COMPTABLE_MIT"})})
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\RegulPrepaiementRepository")
 */
class RegulPrepaiement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_REGUL_PREPAIEMENT", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRegulPrepaiement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CREATED_AT", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var float
     *
     * @ORM\Column(name="MONTANT", type="float", precision=10, scale=2, nullable=false)
     */
    private $montant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE_EFFET_MIT", type="date", nullable=true)
     */
    private $dateEffetMit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE_ENVOI_MIT", type="datetime", nullable=true)
     */
    private $dateEnvoiMit;

    /**
     * @var string
     *
     * @ORM\Column(name="SOURCE", type="string", length=45, nullable=false)
     */
    private $source;

    /**
     * @var \RegulPrepaiementType
     *
     * @ORM\ManyToOne(targetEntity="RegulPrepaiementType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="REGUL_PREPAIEMENT_TYPE_ID", referencedColumnName="ID_REGUL_PREPAIEMENT_TYPE")
     * })
     */
    private $regulPrepaiementType;

    /**
     * @var \ClientPrepaiement
     *
     * @ORM\ManyToOne(targetEntity="ClientPrepaiement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CLIENT_PREPAIEMENT_ID", referencedColumnName="ID_CLIENT_PREPAIEMENT")
     * })
     */
    private $clientPrepaiement;

    /**
     * @var \Billing
     *
     * @ORM\ManyToOne(targetEntity="Billing")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_BILLING", referencedColumnName="ID_BILLING")
     * })
     */
    private $billing;

    /**
     * @var \RegleBilling
     *
     * @ORM\ManyToOne(targetEntity="RegleBilling")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CODE_COMPTABLE_MIT", referencedColumnName="CODE_COMPTABLE")
     * })
     */
    private $codeComptableMit;

    /**
     * Get idRegulPrepaiement
     *
     * @return integer
     */
    public function getIdRegulPrepaiement()
    {
        return $this->idRegulPrepaiement;
    }

    /**
     * Set createdAt
     *
     * @param  \DateTime        $createdAt
     * @return RegulPrepaiement
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set montant
     *
     * @param  float            $montant
     * @return RegulPrepaiement
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set dateEffetMit
     *
     * @param  \DateTime        $dateEffetMit
     * @return RegulPrepaiement
     */
    public function setDateEffetMit($dateEffetMit)
    {
        $this->dateEffetMit = $dateEffetMit;

        return $this;
    }

    /**
     * Get dateEffetMit
     *
     * @return \DateTime
     */
    public function getDateEffetMit()
    {
        return $this->dateEffetMit;
    }

    /**
     * Set dateEnvoiMit
     *
     * @param  \DateTime        $dateEnvoiMit
     * @return RegulPrepaiement
     */
    public function setDateEnvoiMit($dateEnvoiMit)
    {
        $this->dateEnvoiMit = $dateEnvoiMit;

        return $this;
    }

    /**
     * Get dateEnvoiMit
     *
     * @return \DateTime
     */
    public function getDateEnvoiMit()
    {
        return $this->dateEnvoiMit;
    }

    /**
     * Set source
     *
     * @param  string           $source
     * @return RegulPrepaiement
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set regulPrepaiementType
     *
     * @param  RegulPrepaiementType $regulPrepaiementType
     * @return RegulPrepaiement
     */
    public function setRegulPrepaiementType(RegulPrepaiementType $regulPrepaiementType = null)
    {
        $this->regulPrepaiementType = $regulPrepaiementType;

        return $this;
    }

    /**
     * Get regulPrepaiementType
     *
     * @return RegulPrepaiementType
     */
    public function getRegulPrepaiementType()
    {
        return $this->regulPrepaiementType;
    }

    /**
     * Set clientPrepaiement
     *
     * @param  ClientPrepaiement $clientPrepaiement
     * @return RegulPrepaiement
     */
    public function setClientPrepaiement(ClientPrepaiement $clientPrepaiement = null)
    {
        $this->clientPrepaiement = $clientPrepaiement;

        return $this;
    }

    /**
     * Get clientPrepaiement
     *
     * @return ClientPrepaiement
     */
    public function getClientPrepaiement()
    {
        return $this->clientPrepaiement;
    }

    /**
     * Set billing
     *
     * @param  Billing          $billing
     * @return RegulPrepaiement
     */
    public function setBilling(Billing $billing = null)
    {
        $this->billing = $billing;

        return $this;
    }

    /**
     * Get billing
     *
     * @return Billing
     */
    public function getBilling()
    {
        return $this->billing;
    }

    /**
     * Set codeComptableMit
     *
     * @param  RegleBilling     $codeComptableMit
     * @return RegulPrepaiement
     */
    public function setCodeComptableMit(RegleBilling $codeComptableMit = null)
    {
        $this->codeComptableMit = $codeComptableMit;

        return $this;
    }

    /**
     * Get codeComptableMit
     *
     * @return RegleBilling
     */
    public function getCodeComptableMit()
    {
        return $this->codeComptableMit;
    }
}
