<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\External\MobileOption;

interface MobileOptionServiceInterface
{
    /**
     * @param int $idClient
     */
    public function getDetailsClient($idClient);
}
