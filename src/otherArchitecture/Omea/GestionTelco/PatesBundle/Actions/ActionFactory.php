<?php
namespace Omea\GestionTelco\PatesBundle\Actions;

use Symfony\Bridge\Doctrine\RegistryInterface;
use SoapClientBundle\Services\SoapClientService;

class ActionFactory
{
    /**
     * Generate the requested Action Class
     *
     * @param string $className
     * @param RegistryInterface $doctrine
     * @param SoapClientService $clientService
     * @param array $femtoConfig
     * @param array $servicesConfig
     * @return ActionInterface
     * @throws \Exception
     */
    public static function get($className, $doctrine, $clientService, $femtoConfig, $servicesConfig)
    {
        $formattedClassName = str_replace(' ', '', ucwords(strtolower(str_replace('_', ' ', $className))));

        $class = 'Omea\GestionTelco\PatesBundle\Actions\\'.$formattedClassName.'Action';

        try {
            $actionClass = new \ReflectionClass($class);

            return $actionClass->newInstance($doctrine, $clientService, $femtoConfig, $servicesConfig);
        } catch (\Exception $e) {
            throw new \Exception('Class: '.$class.' not found');
        }
    }
}
