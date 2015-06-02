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

    public function __construct(ValidatorInterface $validator,LoggerInterface $logger,SaveEvenementService $saveEvenementService)
    {
        $this->validator = $validator;
        $this->logger = $logger;
        $this->saveEvenementService = $saveEvenementService;
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
        
        /*if (!preg_match('/\b((\d){10})\b/', $request->msisdn, $matches)) {
           throw new InvalidArgumentException('The MSISDN must be composed by 10 digits');
           
        }
        
        if (!preg_match('/[a-zA-Z]/', $request->code, $matches)) {
           throw new InvalidArgumentException('The CODE must be composed by 10 caracters');
           
        }*/
        
        
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
