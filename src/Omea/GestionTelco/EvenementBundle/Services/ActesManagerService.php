<?php
/**
 * Created by PhpStorm.
 * User: rserale
 * Date: 29/06/15
 * Time: 14:30
 */


namespace Omea\GestionTelco\EvenementBundle\Services;

use Doctrine\ORM\EntityManager;
use Omea\GestionTelco\EvenementBundle\Entity\GestionEvenementErreur;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

use SoapClientBundle\Exception\SoapClientException;
use SoapClientBundle\Services\SoapClientService;
use Omea\GestionTelco\EvenementBundle\Exception\NotFoundException;

class ActesManagerService {
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityManager
     */
    protected $emMain;

    /**
     * @var SoapClientService
     */
    protected $soapClient;



    /**
     * @param LoggerInterface $logger
     * @param RegistryInterface $doctrine
     * @param SoapClientService $soapClient
     */
    public function __construct(LoggerInterface $logger, RegistryInterface $doctrine,SoapClientService $soapClient)
    {
        $this->logger = $logger;
        $this->em = $doctrine->getManager();
        $this->emMain = $doctrine->getManager('main');
        $this->soapClient = $soapClient;
    }

    /**
     * @param string $msisdn
     * @return \Omea\Domain\Main\StockMsisdn
     * @throws NotFoundException
     */
    public function getStockMsisdn($msisdn)
    {
        $stockMsisdn = $this->emMain->getRepository('Omea\Domain\Main\StockMsisdn')->find($msisdn);
        if (empty($stockMsisdn)) {
            throw new NotFoundException('Le MSISDN ' . $msisdn . ' n\'existe pas', NotFoundException::MSISDN);
        }
        return $stockMsisdn;
    }


    public function traceActeError($id_event,$id_acte,$message)
    {
        $gee = new GestionEvenementErreur();
        $this->em->getConnection()->beginTransaction();
        try {
            $trame = $this->em->getRepository("OmeaGestionTelcoEvenementBundle:GestionEvenementErreur")->findActesByEvenementId($id_event);

            $gee->setActeKo($id_acte);
            $gee->setDateErreur(new \Datetime('now'));
            $gee->setErreurMessage($message);
            $gee->setAbandon(GestionEvenementErreur::ABANDON_NON);
            //TODO: verif serialization entite
            $gee->setTrame($trame);

            $this->em->persist($gee);
            $this->em->flush();
            $this->em->getConnection()->commit();
        } catch (Exception $e) {
            $this->em->getConnection()->rollback();
            $this->em->close();
            throw $e;
        }
    }

    public function validateActe($id_event)
    {
        $evenement= $this->em->getRepository("OmeaGestionTelcoEvenementBundle:Evenement")->find($id_event);
        $evenement->setDateTraitement();
        $this->em->flush();
    }

    public function doCallWSPoseHisto($id_client,$id_event,$commMan,$priorite,$id_conseiller,  $id_acte)
    {
        $trame=array(
            'params' => array(
                'idClient' => $id_client,
                'idEvent' => $id_event,
                'commMan' => $commMan,
                'priorite' => $priorite,
                'idConseiller' => $id_conseiller
            )
        );
        $this->soapClient->setOptions('uri', $this->wsPoseHisto);
        $this->soapClient->setOptions('location', $this->wsPoseHisto);
        $this->soapClient->setOptions('soap_version', SOAP_1_1);
        $this->soapClient->setPathWsdl($this->wsPoseHisto . '/wsdl');
        $this->soapClient->setServiceName('poseHistoByEvent');
        try {
            $this->soapClient->send($trame);
            $this->logger->info('Successfully Pose Histo Event ');
        } catch (\Exception $e) {
            $this->logger->error('Failed Pose Histo Event : ' . $e->getCode() . ' ' . $e->getMessage() );
            $message="Code Erreur: ".$e->getCode()." Message d'erreur : ".$e->getMessage();
            $this->traceActeError($id_event,$id_acte,$message);
        }
    }

    public function doCallWsAddBridage($msisdn, $id_event, $id_client, $id_acte) {
        $trame = array(
            'params' => array(
                'msisdn' => $msisdn,
                'idEvent' => $id_event,
                'idClient' => $id_client
            )
        );
        $this->soapClient->setOptions('uri', $this->wsAddBridge);
        $this->soapClient->setOptions('location', $this->wsAddBridge);
        $this->soapClient->setOptions('soap_version', SOAP_1_1);
        $this->soapClient->setPathWsdl($this->wsAddBridage . '/wsdl');
        $this->soapClient->setServiceName('GestionClientOptionAddOption');
        try {
            $this->soapClient->send($trame);
            $this->logger->info('Successfully Add bridage ');
        } catch (\Exception $e) {
            $this->logger->error('Failed Add bridage : ' . $e->getCode() . ' ' . $e->getMessage());
            $message = "Code Erreur: " . $e->getCode() . " Message d'erreur : " . $e->getMessage();
            $this->traceActeError($id_event, $id_acte, $message);
        }
        return true;
    }

    public function doCallWSEnvoiSms($msisdn,$id_event,$id_client,$id_template,$id_acte)
    {
        $trame=array(
            'params' => array(
                'msisdn' => $msisdn,
                'idEvent' => $id_event,
                'idClient' => $id_client,
                'idTemplate' => $id_template
            )
        );
        $this->soapClient->setOptions('uri', $this->wsEnvoiSms);
        $this->soapClient->setOptions('location', $this->wsEnvoiSms);
        $this->soapClient->setOptions('soap_version', SOAP_1_1);
        $this->soapClient->setPathWsdl($this->wsEnvoiSms . '/wsdl');
        $this->soapClient->setServiceName('sendSmsForEvent');
        try {
            $this->soapClient->send($trame);
            $this->logger->info('Successfully Send SMS Event ');
        } catch (\Exception $e) {
            $this->logger->error('Failed Send SMS Event : ' . $e->getCode() . ' ' . $e->getMessage());
            $message="Code Erreur: ".$e->getCode()." Message d'erreur : ".$e->getMessage();
            $this->traceActeError($id_event,$id_acte,$message);
        }
    }


    public function doCallWSEligibilityPassEurope($msisdn,$id_event,$id_client,  $id_acte){
        $trame=array(
            'params' => array(
                'msisdn' => $msisdn,
                'idEvent' => $id_event,
                'idClient' => $id_client
            )
        );
        $this->soapClient->setOptions('uri', $this->wsEligibilityPassEurope);
        $this->soapClient->setOptions('location', $this->wsEligibilityPassEurope);
        $this->soapClient->setOptions('soap_version', SOAP_1_1);
        $this->soapClient->setPathWsdl($this->wsEligibilityPassEurope . '/wsdl');
        $this->soapClient->setServiceName('checkEligibilityPassEurope');
        try {
            $this->soapClient->send($trame);
            $this->logger->info('Eligible To Pass Europe ');
            return true;
        } catch (\Exception $e) {
            $this->logger->error('Not Eligible To Pass Europe : ' . $e->getCode() . ' ' . $e->getMessage() );
            $message="Code Erreur: ".$e->getCode()." Message d'erreur : ".$e->getMessage();
            $this->traceActeError($id_event,$id_acte,$message);
            return false;
        }

    }
}