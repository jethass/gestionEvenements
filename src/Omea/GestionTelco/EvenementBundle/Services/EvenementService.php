<?php
namespace Omea\GestionTelco\EvenementBundle\Services;

use Omea\GestionTelco\EvenementBundle\ActeManager\ActesManager;
use Omea\GestionTelco\EvenementBundle\Exception\AccessDeniedException;
use Omea\GestionTelco\EvenementBundle\Exception\InvalidArgumentException;
use Omea\GestionTelco\EvenementBundle\Exception\NotFoundException;

use Omea\GestionTelco\EvenementBundle\Types\SaveEvenementRequest;
use Omea\GestionTelco\EvenementBundle\Types\SaveEvenementResponse;

use Omea\GestionTelco\EvenementBundle\Types\AbstractRequestType;
use Omea\GestionTelco\EvenementBundle\Types\BaseResponse;

use Psr\Log\LoggerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Omea\GestionTelco\EvenementBundle\Entity\Evenement;
use Omea\GestionTelco\EvenementBundle\Entity\EvenementRepository;
use Omea\GestionTelco\EvenementBundle\Entity\ActeDefinition;

use Omea\GestionTelco\EvenementBundle\Tests\Stubs\InMeMoryActeDefinitionRepository;

class EvenementService
{
    /**
     * @var ValidatorInterface $validator
     */
    private $validator;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityManager
     */
   // protected $emMain;

    /**
     *
     * @var \Omea\GestionTelco\EvenementBundle\Entity\EvenementRepository
     */
    private $evenementRepository;

    /**
     *
     * @var \Omea\GestionTelco\EvenementBundle\ActeManager\ActesManager
     */
    private $actesManager;

    public function __construct(ValidatorInterface $validator,
                                LoggerInterface $logger,
                                RegistryInterface $doctrine,
                                EvenementRepository $evenementRepository,
                                ActesManager $actesManager)
    {
        $this->validator = $validator;
        $this->logger = $logger;
        $this->em = $doctrine->getManager();
        //$this->emMain = $doctrine->getManager('main');
        $this->evenementRepository = $evenementRepository;
        $this->actesManager = $actesManager;
    }

    /**
     *
     * @param Omea\GestionTelco\EvenementBundle\Types\SaveEvenementRequest $request
     * @return Omea\GestionTelco\EvenementBundle\Types\SaveEvenementResponse $response
     */
    public function saveEvenement(SaveEvenementRequest $request)
    {
        $this->logger->info(sprintf('Save Evenement start with request: %s', print_r($request, true)));
        try {
            $this->validate($request);
            $response = $this->saveAction($request);
            $logLvl = 'info';

        } catch (AccessDeniedException $e) {
            $logLvl = 'warning';
            $response = new BaseResponse($e->getCode(), $e->getMessage());
        } catch (NotFoundException $e) {
            $logLvl = 'warning';
            $response = new BaseResponse($e->getCode(), $e->getMessage());
        } catch (InvalidArgumentException $e) {
            $logLvl = 'warning';
            $response = new BaseResponse($e->getCode(), $e->getMessage());
        } catch (\Exception $e) {
            $logLvl = 'error';
            $response = new BaseResponse($e->getCode(), $e->getMessage());
        }

        $this->logger->$logLvl(sprintf('Save Evenement end with response: %s', print_r($response, true)));

        if (!$response instanceof BaseResponse) {
            $response = new SaveEvenementResponse(0, '', $response);
        } else {
            $response = new SaveEvenementResponse($response->responseCode, $response->message, false);
        }

        return $response;
    }


     /**
     * Method validating a request using the validator component
     *
     * @param $request
     * @throw InvalidArgumentException
     */
    private function validate($request)
    {
        $this->logger->debug(sprintf('Validating %s', get_class($request)));
        $errorList = $this->validator->validate($request);

        if (count($errorList) > 0) {
            $errorMessage = "";
            foreach ($errorList as $err) {
                $errorMessage .= $err->getMessage() . ' - ';
            }
            $this->logger->debug(sprintf('Error during validation : %s', $errorMessage));
            throw new InvalidArgumentException($errorMessage);
        }
    }

    private function saveAction(SaveEvenementRequest $request)
     {
        $this->logger->debug('save evenement begin');

        if($request->msisdn && $request->code && $request->type ){
            $this->em->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                $evenement= new Evenement();
                $msisdn = $request->msisdn;
                $code = $request->code;
                $type= $request->type;

                $evenement->setMsisdn($msisdn);
                $evenement->setCode($code);
                $evenement->setType($type);
                $evenement->setDateAppel(new \Datetime('now'));
                $evenement->setDateTraitement(Null);
                
                $this->em->persist($evenement);
                $this->em->flush();

                $this->em->getConnection()->commit();

                return "Inserted OK";

            } catch (Exception $e) {
                $this->em->getConnection()->rollback();
                $this->em->close();
                throw $e;
            }
        }
    }

    public function handleEvenements()
    {
        $evenements = $this->evenementRepository->findBy(array('dateTraitement' => null));
        foreach ($evenements as $key => $evenement) {
            try
            {
                $actesManager->handle($evenement);
            }
            catch (Exception $e)
            {
                $this->logger->error("Erreur lors de la gestion de l'évènement '".$evenement->getCode()."': ".$e->getMessage()."");
            }
        }
    }

}
