<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="CLIENT_ANNU")
 * @ORM\Entity
 */
class ClientAnnu
{
    /**
     *
     * @var integer $idClient
     *
     * @ORM\Column(name="ID_CLIENT", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idClient;

    /**
     * @var Client
     *
     * @ORM\OneToOne(targetEntity="Client", inversedBy="clientAnnu")
     * @ORM\JoinColumn(name="ID_CLIENT", referencedColumnName="ID_CLIENT")
     */
    private $client;

    /**
     *
     * @var boolean $setAu
     *
     * @ORM\Column(name="SET_AU", type="boolean")
     */
    private $setAu;

    /**
     *
     * @var string $email
     *
     * @ORM\Column(name="EMAIL", type="string")
     */
    private $email;

    /**
     *
     * @var boolean $limitEmail
     *
     * @ORM\Column(name="LIMIT_EMAIL", type="boolean")
     */
    private $limitEmail;

    /**
     *
     * @var boolean $limitCodepos
     *
     * @ORM\Column(name="LIMIT_CODEPOS", type="boolean")
     */
    private $limitCodepos;

    /**
     *
     * @var boolean $limitInitiales
     *
     * @ORM\Column(name="LIMIT_INITIALES", type="boolean")
     */
    private $limitInitiales;

    /**
     *
     * @var boolean $limitTiers
     *
     * @ORM\Column(name="LIMIT_TIERS", type="boolean")
     */
    private $limitTiers;

    /**
     *
     * @var boolean $limitInvers
     *
     * @ORM\Column(name="LIMIT_INVERS", type="boolean")
     */
    private $limitInvers;

    /**
     *
     * @var \DateTime $dateMaj
     *
     * @ORM\Column(name="DATE_MAJ", type="datetime")
     */
    private $dateMaj;

    /**
     * @return the $idClient
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * @return the $client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return the $setAu
     */
    public function getSetAu()
    {
        return $this->setAu;
    }

    /**
     * @return the $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return the $limitEmail
     */
    public function getLimitEmail()
    {
        return $this->limitEmail;
    }

    /**
     * @return the $limitCodepos
     */
    public function getLimitCodepos()
    {
        return $this->limitCodepos;
    }

    /**
     * @return the $limitInitiales
     */
    public function getLimitInitiales()
    {
        return $this->limitInitiales;
    }

    /**
     * @return the $limitTiers
     */
    public function getLimitTiers()
    {
        return $this->limitTiers;
    }

    /**
     * @return the $limitInvers
     */
    public function getLimitInvers()
    {
        return $this->limitInvers;
    }

    /**
     * @return the $dateMaj
     */
    public function getDateMaj()
    {
        return $this->dateMaj;
    }

    /**
     * @param number $idClient
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }

    /**
     * @param field_type $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @param number $setAu
     */
    public function setSetAu($setAu)
    {
        $this->setAu = $setAu;
    }

    /**
     * @param number $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param number $limitEmail
     */
    public function setLimitEmail($limitEmail)
    {
        $this->limitEmail = $limitEmail;
    }

    /**
     * @param number $limitCodepos
     */
    public function setLimitCodepos($limitCodepos)
    {
        $this->limitCodepos = $limitCodepos;
    }

    /**
     * @param number $limitInitiales
     */
    public function setLimitInitiales($limitInitiales)
    {
        $this->limitInitiales = $limitInitiales;
    }

    /**
     * @param number $limitTiers
     */
    public function setLimitTiers($limitTiers)
    {
        $this->limitTiers = $limitTiers;
    }

    /**
     * @param number $limitInvers
     */
    public function setLimitInvers($limitInvers)
    {
        $this->limitInvers = $limitInvers;
    }

    /**
     * @param number $dateMaj
     */
    public function setDateMaj($dateMaj)
    {
        $this->dateMaj = $dateMaj;
    }
}
