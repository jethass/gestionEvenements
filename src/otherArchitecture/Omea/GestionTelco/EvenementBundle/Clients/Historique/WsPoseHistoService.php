<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Historique;

class WsPoseHistoService extends \SoapClient
{
    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct($wsdl, array $options)
    {
      $options = array_merge(array (
      'soap_version'   => SOAP_1_2
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
