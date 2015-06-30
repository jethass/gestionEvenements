<?php

namespace Omea\GestionTelco\EvenementBundle\ActeManager\Actes;

use Omea\GestionTelco\EvenementBundle\ActeManager\ActeInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\EvenementInterface;

class BridageActe implements ActeInterface {

    /**
     * @var array
     */
    private $bridgeConfig;

    /**
     * @var string
     */
    private $wsAddBridge;

    /*
 *  @var ActesManagerService
 */
    private $actesManagerService;

    /**
     * @param array $histoConfig
     * @param string $wsPoseHisto
     * @param ActesManagerService $actesManagerService
     */
    public function __construct(array $bridgeConfig, $wsAddBridge,$actesManagerService) {
        $this->bridgeConfig = $bridgeConfig;
        $this->wsAddBridge = $wsAddBridge;
        $this->actesManagerService = $actesManagerService;
    }

    public function handle(EvenementInterface $evenement, $id_acte) {
        $msisdn = $evenement->getMsisdn();
        $id_event = $evenement->getIdEvenement();
        $stockMsisdn = $this->actesManagerService->getStockMsisdn($msisdn);
        $id_client = $stockMsisdn->getIdClient();

        $this->actesManagerService->doCallWsAddBridage($msisdn, $id_event, $id_client, $id_acte);
    }


}
