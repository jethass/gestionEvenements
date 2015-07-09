<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\External\Billing;

use Omea\GestionTelco\PortabilityBundle\Services\External\GenericProxyService;

class BillingProxyService extends GenericProxyService implements BillingServiceInterface
{
    /** Creates a MIC message of type "Resiliation" for the Billing server
     * @param  int    $idClient
     * @param  string $typeMic
     * @param  int    $numAbo
     * @param  string $dateEffet
     * @return int    the unique identifier of the created MIC
     */
    public function createResiliationMIC($idClient, $typeMIC, $numAbo, $dateEffet)
    {
        $request = array('TAB_ID_CLIENT' => array($idClient),
                        'ID_CLIENT' => $idClient,
                        'TYPERESILIATION' => $typeMIC,
                        'NUM_ABO' => $numAbo,
                        'DATE_EFFET' => $dateEffet);
        $this->setLegacyMethod('WS_ZSMART_RESILIATION');

        $result = $this->soapClient->send(array($request));

        return $result['ID_TRAITEMENTMIC'];
    }

    /** Creates a MIC message of type "Cancel a previous MIC" for the Billing server
     * @param  int    $idClient
     * @param  int    $numAbo
     * @param  string $dateEffet
     * @return int    the unique identifier of the created MIC
     */
    public function createCancellationMIC($idClient, $numAbo, $idTraitementMic)
    {
        $request = array('TAB_ID_CLIENT' => array($idClient),
                        'ID_CLIENT' => $idClient,
                        'NUM_ABO' => $numAbo,
                        'ID_TRAITEMENTMIC_ANNULE' => $idTraitementMic);
        $this->setLegacyMethod('WS_ZSMART_ANNULATION');

        $result = $this->soapClient->send(array($request));

        return $result['ID_TRAITEMENTMIC'];
    }
}
