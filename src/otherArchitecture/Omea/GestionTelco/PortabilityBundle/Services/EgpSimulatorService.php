<?php
namespace Omea\GestionTelco\PortabilityBundle\Services;

use Psr\Log\LoggerInterface;
use Doctrine\DBAL\Connection;
use Omea\GestionTelco\PortabilityBundle\Types\Message;

class EgpSimulatorService
{
    /** @var LoggerInterface */
    private $logger;

    /** @var array */
    private $config;

    /** @var Connection */
    private $pnmDb;

    /** @var MessagingService */
    private $messaging;

    /**
     * @param LoggerInterface  $logger
     * @param array            $portabilityConfig
     * @param MessagingService $messaging
     * @param Connection       $pnmDb
     */
    public function __construct(
        LoggerInterface $logger,
        array $portabilityConfig,
        MessagingService $messaging,
        Connection $pnmDb
    ) {
        $this->logger = $logger;
        $this->config = $portabilityConfig;
        $this->messaging = $messaging;
        $this->pnmDb = $pnmDb;
    }

    /** Generates a simulated message incoming from the EGP (in PNM_PPNM.OMD_MESSAGE_IN)
     * @param string $operation   The type of message wanted
     * @param string $idPortage   The unique identifier of the portability we are either initializing or updating
     * @param string $returnCode  The return code we want for the operation [ELI_IN, ANR, IND]
     * @param string $msisdn      The ported MSISDN [ELI_OUT]
     * @param string $rio         The ported RIO code [ELI_OUT]
     * @param string $datePortage The planified date for the portability [ELI_OUT]
     * @param string $tranche     The planified schedule for the portability [ELI_OUT]
     * @param string $dateDemande The date of the portability's creation [ELI_OUT]
     * @param string $opr         The identifier for the receiving operator [ELI_OUT]
     * @param string $oprt        The identifier for the technical receiving operator [ELI_OUT]
     * @param string $opd         The identifier for the giving operator [ELI_OUT]
     * @param string $opdt        The identifier for the technical giving operator [ELI_IN]
     * @param string $opa         The identifier for the owner operator [ELI_IN]
     * @param string $opat        The identifier for the technical owner operator [ELI_IN]
     */
    public function generate($operation,
                             $idPortage,
                             $returnCode = null,
                             $msisdn = null,
                             $rio = null,
                             $datePortage = null,
                             $tranche = null,
                             $dateDemande = null,
                             $opr = null,
                             $oprt = null,
                             $opd = null,
                             $opdt = null,
                             $opa = null,
                             $opat = null)
    {
        if (empty($idPortage)) {
            throw new \Exception("Please supply an idportage for this operation");
        }

        switch ($operation) {
            // Initialization of outgoing portability
            case 'ELI_OUT':
                $message = new Message();
                if (empty($msisdn)) {
                    throw new \Exception("Please supply a msisdn for this operation");
                }
                $message->msisdn = $msisdn;
                if (empty($rio)) {
                    throw new \Exception("Please supply a rio for this operation");
                }
                $message->rio = $rio;
                $message->idPortage = $idPortage;
                if (empty($datePortage)) {
                    throw new \Exception("Please supply a dateportage for this operation");
                }
                $message->datePortage = $datePortage;
                if (empty($tranche)) {
                    throw new \Exception("Please supply a tranche for this operation");
                }
                $message->operation = 'ELI';
                $message->emetteur = 'EG';
                $message->recepteur = 'DD';
                $message->tranche = $tranche;
                $message->dateDemande = empty($dateDemande) ? date('Y-m-d') : $dateDemande;
                $message->opr = empty($opr) ? substr($idPortage, 0, 2) : $opr;
                $message->oprt = empty($oprt) ? $message->opr : $oprt;
                $message->opd = empty($opd) ? substr($rio, 0, 2) : $opd;
                $message->codeRetour = null;
                break;
            // Confirmation of incoming portability
            case 'ELI_IN':
                $message = $this->getPendingPortabilityByIdPortage($idPortage);
                $message->operation = 'ELI';
                $message->emetteur = 'EG';
                $message->recepteur = 'RR';
                $message->opdt = empty($opdt) ? $message->opd : $opdt;
                $message->opa = empty($opa) ? $message->opd : $opa;
                $message->opat = empty($opat) ? $message->opa : $opat;
                if (empty($returnCode)) {
                    throw new \Exception("Please supply a returncode for this operation");
                }
                $message->codeRetour = $returnCode;
                break;
            // Incoming portability : confirmation of our cancellation
            // Outgoing portability : the receiving operator cancelled the portability
            case 'ANR':
                $message = $this->getExistingPortabilityByIdPortage($idPortage);
                $message->operation = 'ANR';
                if ($message->recepteur == 'DD') {
                    $message->codeRetour = $this->config['misc']['successReturnCode'];
                } else {
                    if (empty($returnCode)) {
                        throw new \Exception("Please supply a returncode for this operation");
                    }
                    $message->codeRetour = $returnCode;
                }
                break;
            // Incoming portability : the giving operator cancelled the portability
            // Outgoing portability : confirmation of our cancellation
            case 'IND':
                $message = $this->getExistingPortabilityByIdPortage($idPortage);
                $message->operation = 'IND';
                if ($message->recepteur == 'RR') {
                    $message->codeRetour = $this->config['misc']['successReturnCode'];
                } else {
                    if (empty($returnCode)) {
                        throw new \Exception("Please supply a returnCode for this operation");
                    }
                    $message->codeRetour = $returnCode;
                }
                break;
            // Final GO for the portability
            case 'GOP':
                $message = $this->getExistingPortabilityByIdPortage($idPortage);
                var_dump($message);
                $message->operation = 'GOP';
                $message->codeRetour = null;
                break;
            default:
                throw new \Exception("Unknown operation $operation");
        }
        $message->state = $this->config['messages']['states']['pending'];

        $this->messaging->addMessage($this->config['messages']['tables']['in'], $message);
    }

    /** Retrieves the ELI message from the EGP regarding a given portability
     * - Incoming portability : the "validation" ELI message with all the data we need
     * - Outgoing portability : the "request" ELI message that's missing some data (that we recover from our own ELI answer)
     * This should give us all the data we need to generate further messages
     * @param string idPortage
     * @return Message
     */
    private function getExistingPortabilityByIdPortage($idPortage)
    {
        $query = 'SELECT MSISDN, RIO, RECEPTEUR, EMETTEUR, ID_PORTAGE, OPR, OPRT, OPD, OPDT, OPA, OPAT, DATE_DEMANDE, DATE_PORTAGE, TRANCHE, MARQUE_ID FROM '.$this->config['messages']['tables']['in'].' WHERE ID_PORTAGE = ? AND OPERATION = ?';

        $portability = $this->pnmDb->fetchAssoc($query, array($idPortage, 'ELI'));

        if (empty($portability)) {
            throw new \Exception("No existing portability with IdPortage #$idPortage");
        }

        // Outgoing portability, the OPDT/OPA/OPAT values are from the OUT ELI message
        if (empty($portability['OPDT']) || empty($portability['OPAT']) || empty($portability['OPA'])) {
            $queryAddons = 'SELECT OPDT, OPA, OPAT FROM '.$this->config['messages']['tables']['out'].' WHERE ID_PORTAGE = ? AND OPERATION = ?';

            $portabilityAddons = $this->pnmDb->fetchAssoc($queryAddons, array($idPortage, 'ELI'));
            if (empty($portabilityAddons)) {
                throw new \Exception("No answer ELI message for outgoing portability with IdPortage #$idPortage ; please run eligPS and the transport commands");
            }
            $portability['OPDT'] = $portabilityAddons['OPDT'];
            $portability['OPA'] = $portabilityAddons['OPA'];
            $portability['OPAT'] = $portabilityAddons['OPAT'];
        }

        $message = new Message($portability);
        return $message;
    }

    /** Retrieves the ELI request we sent to the EGP, which should contain most of the data regarding a given incoming portability
     * @param string idPortage
     * @return Message
     */
    private function getPendingPortabilityByIdPortage($idPortage)
    {
        $query = 'SELECT MSISDN, RIO, RECEPTEUR, EMETTEUR, ID_PORTAGE, OPR, OPRT, OPD, OPDT, OPA, OPAT, DATE_DEMANDE, DATE_PORTAGE, TRANCHE, MARQUE_ID FROM '.$this->config['messages']['tables']['out'].' WHERE ID_PORTAGE = ? AND OPERATION = ? AND EMETTEUR = ?';

        $portability = $this->pnmDb->fetchAssoc($query, array($idPortage, 'ELI', 'RR'));

        if (empty($portability)) {
            throw new \Exception("No pending incoming portability with IdPortage #$idPortage");
        }

        $message = new Message($portability);
        return $message;
    }
}
