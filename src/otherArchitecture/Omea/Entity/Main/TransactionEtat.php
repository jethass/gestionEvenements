<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="TRANSACTION_ETAT")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\TransactionEtatRepository")
 */
class TransactionEtat {

	/**
	 * @var integer $idTransactionEtat
	 * @ORM\Column(name="ID_TRANS_ETAT", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $idTransactionEtat; //`ID_TRANS_ETAT` int(10) unsigned NOT NULL AUTO_INCREMENT,
	
	/**
	 * @ORM\ManyToOne(targetEntity="Transaction", cascade={"persist", "merge"})
	 * @ORM\JoinColumn(name="ID_TRANS", referencedColumnName = "ID_TRANS")
	 */
	private $transaction; //`ID_TRANS` int(10) unsigned NOT NULL,
	
	/**
	 * @var integer $idTransactionStatut
	 * @ORM\Column(name="ID_TRANS_STATUT", type="integer")
	 */
	private $idTransactionStatut; //`ID_TRANS_STATUT` tinyint(3) unsigned NOT NULL,
	
	/**
	 * @var integer $dateEtat
	 * @ORM\Column(name="DATE_ETAT", type="datetime")
	 */
	private $dateEtat; //`DATE_ETAT` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
	
	private $idMeg; //`ID_MEG` bigint(20) unsigned DEFAULT NULL,

	/**
	 * @return the integer
	 */
	public function getIdTransactionEtat() {
		return $this->idTransactionEtat;
	}
		
		/**
	 * @param  $idTransactionEtat
	 */
	public function setIdTransactionEtat( $idTransactionEtat) {
		$this->idTransactionEtat = $idTransactionEtat;
	}
		
		/**
	 * @return the unknown_type
	 */
	public function getTransaction() {
		return $this->transaction;
	}
		
		/**
	 * @param unknown_type $transaction
	 */
	public function setTransaction($transaction) {
		$this->transaction = $transaction;
	}
		
		/**
	 * @return the integer
	 */
	public function getIdTransactionStatut() {
		return $this->idTransactionStatut;
	}
		
		/**
	 * @param  $idTransactionStatut
	 */
	public function setIdTransactionStatut( $idTransactionStatut) {
		$this->idTransactionStatut = $idTransactionStatut;
	}
		
		/**
	 * @return the integer
	 */
	public function getDateEtat() {
		return $this->dateEtat;
	}
		
		/**
	 * @param  $dateEtat
	 */
	public function setDateEtat( $dateEtat) {
		$this->dateEtat = $dateEtat;
	}
		
		/**
	 * @return the unknown_type
	 */
	public function getIdMeg() {
		return $this->idMeg;
	}
		
		/**
	 * @param unknown_type $idMeg
	 */
	public function setIdMeg($idMeg) {
		$this->idMeg = $idMeg;
	}
	
	
}