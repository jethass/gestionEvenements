<?php
namespace Omea\GestionTelco\PortabilityBundle\Services;

use Psr\Log\LoggerInterface;
use Omea\GestionTelco\PortabilityBundle\Types\Message;

class OutgoingPortabilityService
{
    /** @var array */
    protected $config;

    /** @var LoggerInterface */
    protected $logger;

    /** @var MainRepositoryService */
    protected $main;

    /** @var MessagingService */
    protected $messaging;

    /**
     * @param LoggerInterface       $logger
     * @param array                 $config
     * @param MessagingService      $messaging
     * @param MainRepositoryService $main
     */
    public function __construct(LoggerInterface $logger,
                                array $config,
                                MessagingService $messaging,
                                MainRepositoryService $main)
    {
        $this->logger = $logger;
        $this->config = $config;
        $this->messaging = $messaging;
        $this->main = $main;
    }

    /** Checks whether an outgoing portability is already ongoing for a given phone number
     * @param  string  $msisdn
     * @return boolean
     */
    public function checkActiveOutgoingPortability($msisdn)
    {
        $lastPortability = $this->main->getLastPortabilityStatusByMsisdn($msisdn, 'PS');
        $this->logger->info("Last porta for $msisdn : $lastPortability");
        if (empty($lastPortability)) {
            // No outgoing portability at all
            return false;
        } elseif ($lastPortability->acq == '1') {
            // Outgoing portability is over
            return false;
        } elseif ($lastPortability->lastOperationIn != 'GOP' && $lastPortability->datePortage < new \DateTime('now')) {
            // Still no GOP past the portability's scheduled date ? Let's assume it's been cancelled somehow
            return false;
        } elseif ($lastPortability->lastOperationIn == 'ANR') {
            // Portability cancelled by other operator
            return false;
        } elseif ($lastPortability->lastOperationIn == 'IND'
                  && in_array($lastPortability->lastReturnCodeIn, $this->config['misc']['ANRsuccessReturnCodes'])) {
            // Portability successfully cancelled by us
            return false;
        } elseif ($lastPortability->lastOperationIn == 'IND') {
            // Portability unsuccessfully cancelled by us
            return true;
        } elseif ($lastPortability->lastOperationIn == null) {
            // We Ok'd the ELIgibility, no other response yet
            return true;
        }
    }
    
    /** Acknowledges an Outgoing Portability went well (or not)
     * @param  string  $idPortage   the portability's unique identifier
     * @param  int     $anomalyCode a code for how well the resiliation went (0 if ok)
     * @return boolean
     */
    public function acknowledgeOutgoingPortability($idPortage, $anomalyCode = 0)
    {
        try {
            $this->main->beginTransaction();
            
            // Retrieve data from PAO
            $pao = $this->main->getLastPortabilityStatusByIdPortage($idPortage, 'PS');
            
            if (is_null($pao)) {
                throw new \Exception("No current incoming portabilities with idPortage $idPortage");
            }
            if ($pao->lastOperationIn != 'GOP') {
                throw new \Exception("Last message we got from EGP for #$idPortage was not GOP but {$pao->lastOperationIn}");
            }
            if ($pao->acq == '1') {
                throw new \Exception("Portage #$idPortage was already acknowledged");
            }
            
            // Retrieve GOP from incoming messages
            $gop = $this->messaging->getMessageByIdPortage($this->config['main']['tables']['in'], $idPortage, 'GOP');
            
            // Update PAO in all cases
            if ($anomalyCode != 0) {
                $this->main->updateFinalPortabilityStatus($pao->idPao, '0', $anomalyCode);
            } else {
                $this->main->updateFinalPortabilityStatus($pao->idPao, '1', '0');
                
                // Create ACQ message
                $acq = clone $gop;
                $acq->state = $this->config['main']['states']['out']['pending'];
                $acq->operation = 'ACQ';
                $acq->emetteur = 'DD';
                $acq->recepteur = 'EG';
                $acq->codeRetour = $this->config['misc']['successReturnCode'];

                $this->messaging->addMessage($this->config['main']['tables']['out'], $acq);
            }
            $this->main->commit();
        } catch (\Exception $e) {
            $this->main->rollback();
            throw new \Exception("Could not acknowledge Incoming Portability $idPortage", 0, $e);
        }

        return true;
    }

    /** Cancels an Outgoing Portability
     * @param  string  $idPortage the portability's unique identifier
     * @return boolean
     */
    public function cancelOutgoingPortability($idPortage)
    {
        try {
            // Retrieve data from PAO
            $pao = $this->main->getLastPortabilityStatusByIdPortage($idPortage, 'PS');
            
            if (is_null($pao)) {
                throw new \Exception("No current outgoing portabilities with idPortage $idPortage");
            }
            if ($pao->lastOperationIn == 'GOP') {
                throw new \Exception("Outgoing portability #$idPortage cannot be cancelled anymore");
            }
            if (($pao->lastOperationIn == 'IND' && $pao->lastReturnCodeIn == $this->config['misc']['successReturnCode'])
                || ($pao->lastOperationIn == 'ANR')) {
                throw new \Exception("Outgoing portability #$idPortage has already been cancelled");
            }
            
            // Retrieve original ELI from incoming messages
            $eli = $this->messaging->getMessageByIdPortage($this->config['main']['tables']['in'], $idPortage, 'ELI');
            
            // Create IND message
            $ind = clone $eli;
            $ind->state = $this->config['main']['states']['out']['pending'];
            $ind->operation = 'IND';
            $ind->emetteur = 'RR';
            $ind->recepteur = 'EG';
            $ind->codeRetour = $this->config['misc']['successReturnCode'];

            $this->messaging->addMessage($this->config['main']['tables']['out'], $ind);
        } catch (\Exception $e) {
            throw new \Exception("Could not cancel Outgoing Portability $idPortage : {$e->getMessage()}", 0, $e);
        }

        return true;
    }
}
