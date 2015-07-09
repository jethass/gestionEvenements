<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Eligibilite;

class WsGestionClientPassService extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
      'GestionClientPassAddPass' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Eligibilite\\GestionClientPassAddPass',
      'GestionClientPassReturn' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Eligibilite\\GestionClientPassReturn',
      'GestionClientPassGetClientPasses' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Eligibilite\\GestionClientPassGetClientPasses',
      'GestionClientPassReturnPasses' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Eligibilite\\GestionClientPassReturnPasses',
      'GestionClientPassVerifEligibilitePass' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Eligibilite\\GestionClientPassVerifEligibilitePass',
    );

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct(array $options = array(), $wsdl = 'http://127.0.0.1/1.9.0/web/app_dev.php/ws/pass/wsdl')
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
     * addPass
     *
     * @param GestionClientPassAddPass $trameClient
     * @return GestionClientPassReturn
     */
    public function addPass(GestionClientPassAddPass $trameClient)
    {
      return $this->__soapCall('addPass', array($trameClient));
    }

    /**
     * getClientPasses
     *
     * @param GestionClientPassGetClientPasses $trameClient
     * @return GestionClientPassReturnPasses
     */
    public function getClientPasses(GestionClientPassGetClientPasses $trameClient)
    {
      return $this->__soapCall('getClientPasses', array($trameClient));
    }

    /**
     * verifEligibilitePass
     *
     * @param GestionClientPassVerifEligibilitePass $trameClient
     * @return GestionClientPassReturnPasses
     */
    public function verifEligibilitePass(GestionClientPassVerifEligibilitePass $trameClient)
    {
      return $this->__soapCall('verifEligibilitePass', array($trameClient));
    }

}
