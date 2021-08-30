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

use App\Service\GetPublicoAlvoService;
use App\Service\GetCampanhaAlvoService;
use App\Entity\PublicoAlvo;

use App\Exception\PublicoAlvoDatabaseException;
use App\Exception\CampanhaDatabaseException;
use App\Exception\CampanhaIdException;
use App\Service\GetCampanhaService;
use App\Util\Enum\StatusHttp;
use App\Util\Enum\ErrorMessage;
use App\DTO\PublicoAlvoDto;

class PostPublicoAlvoMiddleware implements MiddlewareInterface
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
     * @var GetPublicoAlvoService;
     */
    private $getPublicoAlvoService;

    /**
     * @var GetCampanhaService;
     */
    private $getCampanhaService;

    public function __construct(
        SerializeUtil $serialize,
        ValidationService $validationService,
        GetPublicoAlvoService $getPublicoAlvoService,
        GetCampanhaService $getCampanhaService
    ) {
        $this->serialize = $serialize;
        $this->validationService = $validationService;
        $this->getPublicoAlvoService = $getPublicoAlvoService;
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

            $publicoAlvoDto = $this->serialize->deserialize(
                $request->getBody()->getContents(),
                PublicoAlvoDto::class,
                'json'
            );

            $campanha = $this->getCampanhaService->getCampanhaById($publicoAlvoDto->getCampanhaId());

            if (!$campanha) {
                throw new CampanhaIdException(
                    StatusHttp::BAD_REQUEST,
                    sprintf(
                        ErrorMessage::ERROR_REGISTER_NOT_FOUND,
                        $publicoAlvoDto->getCampanhaId()
                    )
                );
            }

            $publicoAlvo = new PublicoAlvo();
            $publicoAlvo->setTitulo($publicoAlvoDto->getTitulo());
            $publicoAlvo->setDescricao($publicoAlvoDto->getDescricao());
            $publicoAlvo->setStatus($publicoAlvoDto->getStatus());
            $publicoAlvo->setCampanha($campanha);

            $this->validationService->validateEntity($publicoAlvo, ['insert']);

            $databasePublicoAlvo = $this->getPublicoAlvoService->getPublicoAlvoByTitulo($publicoAlvo->getTitulo());

            if ($databasePublicoAlvo && $databasePublicoAlvo['campanha_id'] == $publicoAlvo->getCampanha()->getId()) {
                throw new PublicoAlvoDatabaseException(
                    StatusHttp::CONFLICT,
                    sprintf(
                        ErrorMessage::ERROR_PUBLICO_ALVO_DUPLICATED,
                        $publicoAlvo->getCampanha()->getTitulo()
                    )
                );
            }

        } catch (BaseEntityException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (BaseEntityViolationsException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (PublicoAlvoDatabaseException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (Exception $e) {
            return new ApiResponse($e->getMessage(), $e->getCode(), ApiResponse::ERROR);
        }

        return $handler->handle($request->withAttribute('postPublicoAlvo', $publicoAlvo));
    }
}