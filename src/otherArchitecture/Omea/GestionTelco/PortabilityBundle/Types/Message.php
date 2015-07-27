<?php
namespace Omea\GestionTelco\PortabilityBundle\Types;

class Message
{
    /** Unique identifier of the message in its storage table
     * @var string
     */
    public $id;
    /** Current state of the message
     * @var string
     */
    public $state;
    /** Type of message (ELI, IND, ANR, GOP, ACQ...)
     * @var string
     */
    public $operation;
    /** Which actor sent the message ? (EG, DD, RR...)
     * @var string
     */
    public $emetteur;
    /** Which actor is the message for ? (EG, DD, RR...)
     * @var string
     */
    public $recepteur;
    /** The phone number being ported
     * @var string
     */
    public $msisdn;
    /** The authentification passcode for the phone number being ported
     * @var string
     */
    public $rio;
    /** Identification code of the operator the phone number is being ported to
     * @var string
     */
    public $opr;
    /** Identification code of the TECHNICAL operator the phone number is being ported to
     * @var string
     */
    public $oprt;
    /** Identification code of the operator the phone number is being ported from
     * @var string
     */
    public $opd;
    /** Identification code of the TECHNICAL operator the phone number is being ported from
     * @var string
     */
    public $opdt;
    /** Identification code of the operator the phone number belongs to
     * @var string
     */
    public $opa;
    /** Identification code of the TECHNICAL operator the phone number belongs to
     * @var string
     */
    public $opat;
    /** Unique identifier for the portability
     * @var string
     */
    public $idPortage;
    /** The date (Y-m-d) the portability was created on
     * @var \DateTime
     */
    protected $dateDemande;
    /** The date (Y-m-d) the portability is scheduled for
     * @var \DateTime
     */
    protected $datePortage;
    /** The timeslot of the day the portability is scheduled for (11, 15, 51)
     * @var string
     */
    public $tranche;
    /** The return code embedded in the current message
     * @var string
     */
    public $codeRetour;

    public function __construct($values = array())
    {
        if (!empty($values['ID_OPI'])) {
            $this->id = $values['ID_OPI'];
        }
        if (!empty($values['ID_OPO'])) {
            $this->id = $values['ID_OPO'];
        }
        if (!empty($values['ID'])) {
            $this->id = $values['ID'];
        }
        if (!empty($values['ETAT'])) {
            $this->state = $values['ETAT'];
        }
        if (!empty($values['ETAT_MESSAGE'])) {
            $this->state = $values['ETAT_MESSAGE'];
        }
        if (!empty($values['OPERATION'])) {
            $this->operation = $values['OPERATION'];
        }
        if (!empty($values['EMETTEUR'])) {
            $this->emetteur = $values['EMETTEUR'];
        }
        if (!empty($values['RECEPTEUR'])) {
            $this->recepteur = $values['RECEPTEUR'];
        }
        if (!empty($values['MSISDN'])) {
            $this->msisdn = $values['MSISDN'];
        }
        if (!empty($values['RIO'])) {
            $this->rio = $values['RIO'];
        }
        if (!empty($values['OPR'])) {
            $this->opr = $values['OPR'];
        }
        if (!empty($values['OPRT'])) {
            $this->oprt = $values['OPRT'];
        }
        if (!empty($values['OPD'])) {
            $this->opd = $values['OPD'];
        }
        if (!empty($values['OPDT'])) {
            $this->opdt = $values['OPDT'];
        }
        if (!empty($values['OPA'])) {
            $this->opa = $values['OPA'];
        }
        if (!empty($values['OPAT'])) {
            $this->opat = $values['OPAT'];
        }
        if (!empty($values['ID_PORTAGE'])) {
            $this->idPortage = $values['ID_PORTAGE'];
        }
        if (!empty($values['IDPORTAGE'])) {
            $this->idPortage = $values['IDPORTAGE'];
        }
        // This is 'Ymd' formatted
        if (!empty($values['DATE_DEMANDE'])) {
            $this->__set('dateDemande', $values['DATE_DEMANDE']);
        }
        // This is 'Y-m-d' formatted
        if (!empty($values['DATEDEMANDE'])) {
            $this->__set('dateDemande', $values['DATEDEMANDE']);
        }
        // This is 'Ymd' formatted
        if (!empty($values['DATE_PORTAGE'])) {
            $this->__set('datePortage', $values['DATE_PORTAGE']);
        }
        // This is 'Y-m-d' formatted
        if (!empty($values['DATEPORTAGE'])) {
            $this->__set('datePortage', $values['DATEPORTAGE']);
        }
        if (!empty($values['TRANCHE'])) {
            $this->tranche = $values['TRANCHE'];
        }
        if (!empty($values['CODE_RETOUR'])) {
            $this->codeRetour = $values['CODE_RETOUR'];
        }
        if (!empty($values['CODERETOUR'])) {
            $this->codeRetour = $values['CODERETOUR'];
        }
    }

    public function __set($name, $value)
    {
        if ($name == 'dateDemande' || $name == 'datePortage') {
            $this->$name = new \DateTime($value);
        } else {
            throw new \Exception("Unknown attribute $name for Message");
        }
    }
    public function __get($name)
    {
        if ($name == 'dateDemande' || $name == 'datePortage') {
            return $this->$name;
        } else {
            throw new \Exception("Unknown attribute $name for Message");
        }
    }

    public function __toString()
    {
        return print_r($this, true);
    }
}
