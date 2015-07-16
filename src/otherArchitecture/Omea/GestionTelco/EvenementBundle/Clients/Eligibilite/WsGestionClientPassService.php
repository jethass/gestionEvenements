<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Eligibilite;

class WsGestionClientPassService extends \SoapClient
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
