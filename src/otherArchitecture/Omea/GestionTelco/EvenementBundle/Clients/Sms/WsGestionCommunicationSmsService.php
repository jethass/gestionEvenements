<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Sms;

class WsGestionCommunicationSmsService extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
      'GestionCommunicationSendSms' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Sms\\GestionCommunicationSendSms',
      'GestionCommunicationSendSmsReturn' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Sms\\GestionCommunicationSendSmsReturn',
      'GestionCommunicationResendSms' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Sms\\GestionCommunicationResendSms',
      'GestionCommunicationConsultSms' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Sms\\GestionCommunicationConsultSms',
      'GestionCommunicationConsultSmsReturn' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Sms\\GestionCommunicationConsultSmsReturn',
      'GestionCommunicationNotifierOptionSms' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Sms\\GestionCommunicationNotifierOptionSms',
      'GestionCommunicationNotifierRelanceOptionSms' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Sms\\GestionCommunicationNotifierRelanceOptionSms',
      'GestionCommunicationNotifierModalitePaiementSms' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Sms\\GestionCommunicationNotifierModalitePaiementSms',
      'GestionCommunicationNotifierRelanceMaterielSms' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Sms\\GestionCommunicationNotifierRelanceMaterielSms',
      'GestionCommunicationNotifierAppairageLigneSms' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Sms\\GestionCommunicationNotifierAppairageLigneSms',
      'GestionCommunicationNotifierRetractationSms' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Sms\\GestionCommunicationNotifierRetractationSms',
      'GestionCommunicationNotifierEvenementSms' => 'Omea\\GestionTelco\\EvenementBundle\\Clients\\Sms\\GestionCommunicationNotifierEvenementSms',
    );

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct(array $options = array(), $wsdl = 'http://127.0.0.1/1.13.0/web/app_dev.php/ws/sms/wsdl')
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
