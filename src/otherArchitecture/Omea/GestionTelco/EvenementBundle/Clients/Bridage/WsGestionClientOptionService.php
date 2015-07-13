<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Bridage;

class WsGestionClientOptionService extends \SoapClient
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
