<?php
namespace Omea\GestionTelco\PatesBundle\Services;

use Omea\GestionTelco\PatesBundle\Exception\AccessDeniedException;
use Omea\GestionTelco\PatesBundle\Types\AbstractRequestType;
use Omea\GestionTelco\PatesBundle\Types\BaseResponse;
use Omea\GestionTelco\PatesBundle\Types\EligibilityRequest;
use Omea\GestionTelco\PatesBundle\Types\EligibilityResponse;
use Omea\GestionTelco\PatesBundle\Types\CreateOrderRequest;
use Omea\GestionTelco\PatesBundle\Types\CancellationRequest;
use Omea\GestionTelco\PatesBundle\Types\ActivateFAPRequest;
use Omea\GestionTelco\PatesBundle\Types\GetAdditionalsListRequest;
use Omea\GestionTelco\PatesBundle\Types\GetAdditionalsListResponse;
use Omea\GestionTelco\PatesBundle\Types\ChangeMsisdnRequest;
use Omea\GestionTelco\PatesBundle\Types\ChangeImsiRequest;

use Omea\GestionTelco\PatesBundle\Services\Femto\DeviceService;
use Omea\GestionTelco\PatesBundle\Services\Femto\EligibilityService;
use Omea\GestionTelco\PatesBundle\Services\Femto\UserService;

use Omea\GestionTelco\PatesBundle\Types\SetAdditionalsListRequest;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Omea\GestionTelco\PatesBundle\Exception\InvalidArgumentException;
use Omea\GestionTelco\PatesBundle\Exception\NotFoundException;
use Omea\GestionTelco\PatesBundle\Exception\EligibilityException;

class PatesService
{
    /**
     * @var ValidatorInterface $validator
     */
    private $validator;

    /**
     * @var EligibilityService
     */
    private $eligibilityService;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var DeviceService
     */
    private $deviceService;

    /**
     * @var UserService
     */
    private $femtoUserService;

    public function __construct(
        ValidatorInterface $validator,
        LoggerInterface $logger,
        EligibilityService $eligibilityService,
        DeviceService $deviceService,
        UserService $femtoUserService
    ) {
        $this->validator = $validator;
        $this->logger = $logger;
        $this->eligibilityService = $eligibilityService;
        $this->deviceService = $deviceService;
        $this->femtoUserService = $femtoUserService;
    }

    /**
     *
     * @param Omea\GestionTelco\PatesBundle\Types\EligibilityRequest $request
     * @return Omea\GestionTelco\PatesBundle\Types\EligibilityResponse $response
     */
    public function checkEligibility(EligibilityRequest $request)
    {
        $response = $this->doAction(__FUNCTION__, 'eligibilityService', $request);

        if (!$response instanceof BaseResponse) {
            $response = new EligibilityResponse(0, '', $response);
        } else {
            $response = new EligibilityResponse($response->responseCode, $response->message, false);
        }

        return $response;
    }

    /**
     *
     * @param Omea\GestionTelco\PatesBundle\Types\CreateOrderRequest $request
     * @return Omea\GestionTelco\PatesBundle\Types\BaseResponse $response
     */
    public function createOrder(CreateOrderRequest $request)
    {
        $response = $this->doAction(__FUNCTION__, 'deviceService', $request);

        if (!$response instanceof BaseResponse) {
            $response = new BaseResponse(0, '');
        }

        return $response;
    }

    /**
     *
     * @param Omea\GestionTelco\PatesBundle\Types\CancellationRequest $request
     * @return Omea\GestionTelco\PatesBundle\Types\BaseResponse $response
     */
    public function cancellation(CancellationRequest $request)
    {
        $response = $this->doAction(__FUNCTION__, 'deviceService', $request);

        if (!$response instanceof BaseResponse) {
            $response = new BaseResponse(0, '');
        }

        return $response;
    }

    /**
     * @param Omea\GestionTelco\PatesBundle\Types\ActivateFAPRequest $request
     * @return Omea\GestionTelco\PatesBundle\Types\BaseResponse $response
     */
    public function activateFAP(ActivateFAPRequest $request)
    {
        $response = $this->doAction(__FUNCTION__, 'deviceService', $request);

        if (!$response instanceof BaseResponse) {
            $response = new BaseResponse(0, '');
        }

        return $response;
    }

    /**
     *
     * @param Omea\GestionTelco\PatesBundle\Types\GetAdditionalsListRequest $request
     * @return Omea\GestionTelco\PatesBundle\Types\GetAdditionalsListResponse $response
     */
    public function getAdditionalsList(GetAdditionalsListRequest $request)
    {
        $response = $this->doAction(__FUNCTION__, 'femtoUserService', $request);
        
        if (!$response instanceof BaseResponse) {
            $activationDate = $this->doAction('getFemtoActivationDate', 'femtoUserService', $request);
            $response = new GetAdditionalsListResponse(0, '', $response, $activationDate);
        } else {
            $response = new GetAdditionalsListResponse($response->responseCode, $response->message, null, null);
        }

        return $response;
    }

    /**
     *
     * @param Omea\GestionTelco\PatesBundle\Types\SetAdditionalsListRequest $request
     * @return Omea\GestionTelco\PatesBundle\Types\BaseResponse $response
     */
    public function setAdditionalsList(SetAdditionalsListRequest $request)
    {
        $response = $this->doAction(__FUNCTION__, 'femtoUserService', $request);

        if (!$response instanceof BaseResponse) {
            $response = new BaseResponse(0, '');
        }

        return $response;
    }

    /**
     *
     * @param Omea\GestionTelco\PatesBundle\Types\ChangeMsisdnRequest $request
     * @return Omea\GestionTelco\PatesBundle\Types\BaseResponse $response
     */
    public function changeMsisdn(ChangeMsisdnRequest $request)
    {
        $response = $this->doAction(__FUNCTION__, 'femtoUserService', $request);

        if (!$response instanceof BaseResponse) {
            $response = new BaseResponse(0, '');
        }

        return $response;
    }

    /**
     *
     * @param Omea\GestionTelco\PatesBundle\Types\ChangeImsiRequest $request
     * @return Omea\GestionTelco\PatesBundle\Types\BaseResponse $response
     */
    public function changeImsi(ChangeImsiRequest $request)
    {
        $response = $this->doAction(__FUNCTION__, 'femtoUserService', $request);

        if (!$response instanceof BaseResponse) {
            $response = new BaseResponse(0, '');
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
        } catch (EligibilityException $e) {
            $logLvl = 'info';
            $response = new BaseResponse($e->getCode(), $e->getMessage());
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
