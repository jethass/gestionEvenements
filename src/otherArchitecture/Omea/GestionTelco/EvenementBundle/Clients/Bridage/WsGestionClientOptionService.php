<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Bridage;

class WsGestionClientOptionService extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
      'GestionClientOptionAddOption' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Bridage\\GestionClientOptionAddOption',
      'GestionClientOptionReturn' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Bridage\\GestionClientOptionReturn',
      'GestionClientOptionHasOption' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Bridage\\GestionClientOptionHasOption',
      'GestionClientOptionHasOptionReturn' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Bridage\\GestionClientOptionHasOptionReturn',
    );

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct(array $options = array(), $wsdl = 'http://127.0.0.1/1.9.0/web/app_dev.php/ws/option/wsdl')
    {
      foreach (self::$classmap as $key => $value) {
        if (!isset($options['classmap'][$key])) {
          $options['classmap'][$key] = $value;
        }
      }
      $options = array_merge(array (
      'features' => 1,
    ), $options);
      parent::__construct($wsdl, $options);
    }

    /**
     * addOption
     *
     * @param GestionClientOptionAddOption $trameClient
     * @return GestionClientOptionReturn
     */
    public function addOption(GestionClientOptionAddOption $trameClient)
    {
      return $this->__soapCall('addOption', array($trameClient));
    }

    /**
     * hasOption
     *
     * @param GestionClientOptionHasOption $trameClient
     * @return GestionClientOptionHasOptionReturn
     */
    public function hasOption(GestionClientOptionHasOption $trameClient)
    {
      return $this->__soapCall('hasOption', array($trameClient));
    }

}
