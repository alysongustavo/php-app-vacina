<?php

declare(strict_types=1);

namespace App\Middleware;

use Exception;
use App\Util\Serialize\SerializeUtil;
use App\Service\Response\ApiResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use App\Util\Validation\ValidationService;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Util\Validation\CheckConstraints\Exception\BaseEntityException;
use App\Util\Validation\CheckConstraints\Exception\BaseEntityViolationsException;

use App\Service\GetCampanhaService;
use App\Entity\Campanha;

use App\Exception\CampanhaDatabaseException;

class PostCampanhaMiddleware implements MiddlewareInterface
{
    /**
     * @var SerializeUtil
     */
    private $serialize;

    /**
     * @var ValidationService
     */
    private $validationService;

    /**
     * @var GetCampanhaService
     */
    private $getCampanhaService;

    public function __construct(
        SerializeUtil $serialize,
        ValidationService $validationService,
        GetCampanhaService $getCampanhaService
    ) {
        $this->serialize = $serialize;
        $this->validationService = $validationService;
        $this->getCampanhaService = $getCampanhaService;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
    
        try {

            $campanha = $this->serialize->deserialize(
                $request->getBody()->getContents(),
                Campanha::class,
                'json'
            );      

            $this->validationService->validateEntity($campanha, ['insert']);

            $databaseCampanha = $this->getCampanhaService->getCampanhaByTitulo($campanha->getTitulo());

            $campanha->setTitulo(strtoupper($campanha->getTitulo()));
        } catch (BaseEntityException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (BaseEntityViolationsException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (CampanhaDatabaseException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (Exception $e) {
            return new ApiResponse($e->getMessage(), $e->getCode(), ApiResponse::ERROR);
        }

        return $handler->handle($request->withAttribute('postCampanha', $campanha));
    }
}