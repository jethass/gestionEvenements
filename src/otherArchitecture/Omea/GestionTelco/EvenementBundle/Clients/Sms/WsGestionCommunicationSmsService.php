<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Sms;

class WsGestionCommunicationSmsService extends \SoapClient
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
     * sendSms
     *
     * @param GestionCommunicationSendSms $trameClient
     * @return GestionCommunicationSendSmsReturn
     */
    public function sendSms(GestionCommunicationSendSms $trameClient)
    {
      return $this->__soapCall('sendSms', array($trameClient));
    }

    /**
     * resendSms
     *
     * @param GestionCommunicationResendSms $trameClient
     * @return GestionCommunicationSendSmsReturn
     */
    public function resendSms(GestionCommunicationResendSms $trameClient)
    {
      return $this->__soapCall('resendSms', array($trameClient));
    }

    /**
     * consultSms
     *
     * @param GestionCommunicationConsultSms $trameClient
     * @return GestionCommunicationConsultSmsReturn
     */
    public function consultSms(GestionCommunicationConsultSms $trameClient)
    {
      return $this->__soapCall('consultSms', array($trameClient));
    }

    /**
     * notifierOptionSms
     *
     * @param GestionCommunicationNotifierOptionSms $trameClient
     * @return GestionCommunicationSendSmsReturn
     */
    public function notifierOptionSms(GestionCommunicationNotifierOptionSms $trameClient)
    {
      return $this->__soapCall('notifierOptionSms', array($trameClient));
    }

    /**
     * notifierRelanceOptionSms
     *
     * @param GestionCommunicationNotifierRelanceOptionSms $trameClient
     * @return GestionCommunicationSendSmsReturn
     */
    public function notifierRelanceOptionSms(GestionCommunicationNotifierRelanceOptionSms $trameClient)
    {
      return $this->__soapCall('notifierRelanceOptionSms', array($trameClient));
    }

    /**
     * notifierModalitePaiementSms
     *
     * @param GestionCommunicationNotifierModalitePaiementSms $trameClient
     * @return GestionCommunicationSendSmsReturn
     */
    public function notifierModalitePaiementSms(GestionCommunicationNotifierModalitePaiementSms $trameClient)
    {
      return $this->__soapCall('notifierModalitePaiementSms', array($trameClient));
    }

    /**
     * notifierRelanceMaterielSms
     *
     * @param GestionCommunicationNotifierRelanceMaterielSms $trameClient
     * @return GestionCommunicationSendSmsReturn
     */
    public function notifierRelanceMaterielSms(GestionCommunicationNotifierRelanceMaterielSms $trameClient)
    {
      return $this->__soapCall('notifierRelanceMaterielSms', array($trameClient));
    }

    /**
     * notifierAppairageLigneSms
     *
     * @param GestionCommunicationNotifierAppairageLigneSms $trameClient
     * @return GestionCommunicationSendSmsReturn
     */
    public function notifierAppairageLigneSms(GestionCommunicationNotifierAppairageLigneSms $trameClient)
    {
      return $this->__soapCall('notifierAppairageLigneSms', array($trameClient));
    }

    /**
     * notifierRetractationSms
     *
     * @param GestionCommunicationNotifierRetractationSms $trameClient
     * @return GestionCommunicationSendSmsReturn
     */
    public function notifierRetractationSms(GestionCommunicationNotifierRetractationSms $trameClient)
    {
      return $this->__soapCall('notifierRetractationSms', array($trameClient));
    }

    /**
     * notifierEvenementSms
     *
     * @param GestionCommunicationNotifierEvenementSms $trameClient
     * @return GestionCommunicationSendSmsReturn
     */
    public function notifierEvenementSms(GestionCommunicationNotifierEvenementSms $trameClient)
    {
      return $this->__soapCall('notifierEvenementSms', array($trameClient));
    }

}
