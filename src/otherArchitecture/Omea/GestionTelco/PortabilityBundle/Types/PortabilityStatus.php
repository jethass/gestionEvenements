<?php
namespace Omea\GestionTelco\PortabilityBundle\Types;

class PortabilityStatus
{
    /** Unique identifier for the portability status in DB
     * @var int
     */
    public $idPao;
    /** Type of portability ('PE' = incoming, 'PS' = outgoing)
     * @var string
     */
    public $portabilityType;
    /** Unique identifier for the client
     * @var int
     */
    public $idClient;
    /** The phone number being ported
     * @var string
     */
    public $msisdn;
    /** The authentification passcode for the phone number being ported
     * @var string
     */
    public $rio;
    /** An identifier for the physical phone line
     * @var int
     */
    public $numAbo;
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
    /** The operation from the last incoming message regarding this portability (ELI, ANR, IND, GOP...)
     * @var string
     */
    public $lastOperationIn;
    /** The return code from the last incoming message regarding this portability (ELI, ANR, IND, GOP...)
     * @var string
     */
    public $lastReturnCodeIn;
    /** The timestamp from the last incoming message regarding this portability (ELI, ANR, IND, GOP...)
     * @var \DateTime
     */
    protected $lastDateIn;
    /** Whether an ACQ from us was sent for this portability (0 or 1)
     * @var int
     */
    public $acq;
    /** An anomaly code for the final provisioning operation (activation/resiliation), 0 = OK
     * @var int
     */
    public $anomalyCode;

    public function __construct($values = array())
    {
        if (!empty($values['ID_PAO'])) {
            $this->idPao = $values['ID_PAO'];
        }
        if (!empty($values['TYPE_PORTA'])) {
            $this->portabilityType = $values['TYPE_PORTA'];
        }
        if (!empty($values['ID_CLIENT'])) {
            $this->idClient = $values['ID_CLIENT'];
        }
        if (!empty($values['MSISDN_PORTE'])) {
            $this->msisdn = $values['MSISDN_PORTE'];
        }
        if (!empty($values['RIO'])) {
            $this->rio = $values['RIO'];
        }
        if (!empty($values['NUM_ABO'])) {
            $this->numAbo = $values['NUM_ABO'];
        }
        if (!empty($values['IDPORTAGE'])) {
            $this->idPortage = $values['IDPORTAGE'];
        }
        // This is 'Y-m-d' formatted
        if (!empty($values['DATEDEMANDE'])) {
            $this->__set('dateDemande', $values['DATEDEMANDE']);
        }
        // This is 'Y-m-d' formatted
        if (!empty($values['DATEPORTAGE'])) {
            $this->__set('datePortage', $values['DATEPORTAGE']);
        }
        if (!empty($values['TRANCHE'])) {
            $this->tranche = $values['TRANCHE'];
        }
        if (!empty($values['LAST_OPERATION_IN'])) {
            $this->lastOperationIn = $values['LAST_OPERATION_IN'];
        }
        if (!empty($values['LAST_CODERETOUR_IN'])) {
            $this->lastReturnCodeIn = $values['LAST_CODERETOUR_IN'];
        }
        if (!empty($values['LAST_DATE_IN'])) {
            $this->__set('lastDateIn', $values['LAST_DATE_IN']);
        }
        if (!empty($values['ACQ'])) {
            $this->acq = $values['ACQ'];
        }
        if (!empty($values['CODE_ANOMALIE'])) {
            $this->anomalyCode = $values['CODE_ANOMALIE'];
        }
    }

    public function __set($name, $value)
    {
        if ($name == 'dateDemande' || $name == 'datePortage' || $name == 'lastDateIn') {
            $this->$name = new \DateTime($value);
        } else {
            throw new \Exception("Unknown attribute $name for Message");
        }
    }
    public function __get($name)
    {
        if ($name == 'dateDemande' || $name == 'datePortage' || $name == 'lastDateIn') {
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
