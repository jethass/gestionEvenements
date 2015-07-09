<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;
use Omea\Entity\Main\Client;
use Omea\Entity\Main\Transaction;

/**
 * @ORM\Table(name="SD_CLIENT_TRANSACTION")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\SDClientTransactionRepository")
 */
class SDClientTransaction {

	/**
	 * @ORM\OneToOne(targetEntity="Client")
	 * @ORM\JoinColumn(name="ID_CLIENT_SIMM", referencedColumnName="ID_CLIENT")
	 * @ORM\Id
	 */
	private $client; //`ID_CLIENT_SIMM` INT(11) UNSIGNED NOT NULL,

	/**
	 * @ORM\OneToOne(targetEntity="Transaction")
	 * @ORM\JoinColumn(name="ID_TRANS_SIMM", referencedColumnName="ID_TRANS")
	 * @ORM\Id
	 */
	private $transaction; //`ID_TRANS_SIMM` INT(10) UNSIGNED NOT NULL,
	
	/**
	 * @var integer $idClientSD
	 * @ORM\Column(name="ID_CLIENT_SD", type="integer")
	 */
	private $idClientSD; //`ID_CLIENT_SD` INT(10) NOT NULL,
	
	/**
	 * @var integer $idTransactionSD
	 * @ORM\Column(name="ID_TRANS_SD", type="string")
	 */
	private $idTransactionSD; //`ID_TRANS_SD` INT(10),

	/**
	 * @var integer $idContratSD
	 * @ORM\Column(name="ID_CONTRAT_SD", type="integer")
	 */
	private $idContratSD; //`ID_CONTRAT_SD` int(11)
	
	/**
	 * @var datetime $dateCreationSD
	 * @ORM\Column(name="DATE_CREATION_SD", type="datetime")
	 */
	private $dateCreationSD; //`DATE_CREATION_SD` datetime 
	
	/**
	 * @var boolean $idTransactionSD
	 * @ORM\Column(name="CONTRAT_CREATED", type="boolean")
	 */
	private $contratCreated;

    /**
     * @var boolean $temporiserActivation
     * @ORM\Column(name="TEMPORISER_ACTIVATION", type="boolean")
     */
    private $temporiserActivation;
	

	/**
	 * @return Client  $client
	 */
	public function getClient() {
		return $this->client;
	}

	/**
	 * @param Client $client
	 */
	public function setClient(Client $client) {
		$this->client = $client;
	}

	/**
	 * @return Transaction $transaction
	 */
	public function getTransaction() {
		return $this->transaction;
	}
	
	/**
	 * @param Transaction$transaction
	 */
	public function setTransaction(Transaction $transaction) {
		$this->transaction = $transaction;
	}
	
	/**
	 * @return the $idClientSD
	 */
	public function getIdClientSD() {
		return $this->idClientSD;
	}

	/**
	 * @param number $idClientSD
	 */
	public function setIdClientSD($idClientSD) {
		$this->idClientSD = $idClientSD;
	}

	/**
	 * @return the $idTransactionSD
	 */
	public function getIdTransactionSD() {
		return $this->idTransactionSD;
	}

	/**
	 * @param number $idTransactionSD
	 */
	public function setIdTransactionSD($idTransactionSD) {
		$this->idTransactionSD = $idTransactionSD;
	}
	
	/**
	 * @return the $idContratSD
	 */
	public function getIdContratSD() {
		return $this->idContratSD;
	}

	/**
	 * @return the $dateCreationSD
	 */
	public function getDateCreationSD() {
		return $this->dateCreationSD;
	}

	/**
	 * @param integer $idContratSD
	 */
	public function setIdContratSD($idContratSD) {
		$this->idContratSD = $idContratSD;
	}

	/**
	 * @param datetime $dateCreationSD
	 */
	public function setDateCreationSD($dateCreationSD) {
		$this->dateCreationSD = $dateCreationSD;
	}
	
	/**
	 * @return the $contratCreated
	 */
	public function getContratCreated() {
		return $this->contratCreated;
	}

	/**
	 * @param boolean $contratCreated
	 */
	public function setContratCreated($contratCreated) {
		$this->contratCreated = $contratCreated;
	}

    /**
     * @param boolean $temporiserActivation
     */
    public function setTemporiserActivation($temporiserActivation)
    {
        $this->temporiserActivation = $temporiserActivation;
    }

    /**
     * @return boolean
     */
    public function getTemporiserActivation()
    {
        return $this->temporiserActivation;
    }

}