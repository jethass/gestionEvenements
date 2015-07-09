<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\External\Billing;

interface BillingServiceInterface
{
    /** Creates a MIC message of type "Resiliation" for the Billing server
     * @param  int    $idClient
     * @param  string $typeMic
     * @param  int    $numAbo
     * @param  string $dateEffet
     * @return int    the unique identifier of the created MIC
     */
    public function createResiliationMIC($idClient, $typeMIC, $numAbo, $dateEffet);

    /** Creates a MIC message of type "Cancel a previous MIC" for the Billing server
     * @param  int    $idClient
     * @param  int    $numAbo
     * @param  string $dateEffet
     * @return int    the unique identifier of the created MIC
     */
    public function createCancellationMIC($idClient, $numAbo, $idTraitementMic);
}
