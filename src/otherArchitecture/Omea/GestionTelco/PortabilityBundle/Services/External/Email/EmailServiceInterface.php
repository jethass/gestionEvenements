<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\External\Email;

interface EmailServiceInterface
{
    public function notifyPortability($idClient);
}
