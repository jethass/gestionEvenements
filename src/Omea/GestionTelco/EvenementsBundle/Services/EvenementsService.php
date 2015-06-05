<?php
namespace Omea\GestionTelco\EvenementsBundle\Services;

use Omea\GestionTelco\EvenementsBundle\Exception\AccessDeniedException;
use Omea\GestionTelco\EvenementsBundle\Exception\InvalidArgumentException;
use Omea\GestionTelco\EvenementsBundle\Exception\NotFoundException;

use Omea\GestionTelco\EvenementsBundle\Types\SaveEvenementRequest;
use Omea\GestionTelco\EvenementsBundle\Types\SaveEvenementResponse;

use Omea\GestionTelco\EvenementsBundle\Services\SaveEvenementService;

use Omea\GestionTelco\EvenementsBundle\Types\AbstractRequestType;
use Omea\GestionTelco\EvenementsBundle\Types\BaseResponse;

use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Omea\GestionTelco\EvenementsBundle\EvenementManager\EvenementManager;
use Omea\GestionTelco\EvenementsBundle\Entity\EvenementRepository;


class EvenementsService
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
    * @var SaveEvenementService
    */
   private $saveEvenementService;
   
   /**
    *
    * @var \Omea\GestionTelco\EvenementsBundle\Manager\Eventmanager
    */
   private $evenementManager;
   
   /**
    *
    * @var \Omea\GestionTelco\EvenementsBundle\Entity\EvenementRepository
    */
   private $evenementRepository;

    public function __construct(
        ValidatorInterface $validator,
        LoggerInterface $logger,
        SaveEvenementService $saveEvenementService,
        EvenementManager $evenementManager,
        EvenementRepository $evenementRepository
    )
    {
        $this->validator = $validator;
        $this->logger = $logger;
        $this->saveEvenementService = $saveEvenementService;
        $this->evenementManager = $evenementManager;
        $this->evenementRepository = $evenementRepository;
    }

    /**
     *
     * @param Omea\GestionTelco\EvenementsBundle\Types\SaveEvenementRequest $request
     * @return Omea\GestionTelco\EvenementsBundle\Types\SaveEvenementResponse $response
     */
    public function saveEvenement(SaveEvenementRequest $request)
    {

        $response = $this->doAction(__FUNCTION__, 'saveEvenementService', $request);

        if (!$response instanceof BaseResponse) {
            $response = new SaveEvenementResponse(0, '', $response);
        } else {
            $response = new SaveEvenementResponse($response->responseCode, $response->message, false);
        }

        return $response;
    }
    
    public function handleEvenements()
    {
        $evenements = $this->evenementRepository->findBy(array('dateTraitement' => null));
        foreach ($evenements as $evenement) {
            try {
                $this->evenementManager->handle($evenement);
            } catch (Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }

    private function doAction($method, $service, AbstractRequestType $request)
    {

        $this->logger->info(sprintf(ucfirst($method).' start with request: %s', print_r($request, true)));
        try {

            // validate the request
            $this->validate($request);
            $response = $this->$service->$method($request);
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
        $this->logger->$logLvl(sprintf(ucfirst($method).' end with response: %s', print_r($response, true)));
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
}
