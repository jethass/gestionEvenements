<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Historique;

class WsPoseHistoService extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
      'PoseHistoData' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Historique\\PoseHistoData',
      'PoseHistoReturn' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Historique\\PoseHistoReturn',
    );

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct(array $options = array(), $wsdl = 'http://services.devter.vm.omertelecom.fr/ws/posehisto/wsdl')
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
     * poseHistoByEvent
     *
     * @param PoseHistoData $trameClient
     * @return PoseHistoReturn
     */
    public function poseHistoByEvent(PoseHistoData $trameClient)
    {
      return $this->__soapCall('poseHistoByEvent', array($trameClient));
    }

}
