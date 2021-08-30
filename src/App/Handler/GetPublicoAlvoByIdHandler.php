<?php

declare(strict_types=1);

namespace App\Handler;

use Exception;
use App\Util\Enum\StatusHttp;
use App\Util\Enum\ErrorMessage;
use App\Service\Response\ApiResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use App\Service\GetPublicoAlvoService;
use App\Exception\PublicoAlvoIdException;
use App\Exception\PublicoAlvoDatabaseException;

class GetPublicoAlvoByIdHandler implements RequestHandlerInterface
{
    /**
     * @var GetPublicoAlvoService
     */
    private $getPublicoAlvoService;

    public function __construct(
        GetPublicoAlvoService $getPublicoAlvoService
    ) {
        $this->getPublicoAlvoService = $getPublicoAlvoService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $publicoAlvoId = intval($request->getAttribute("id"));

            $getPublicoAlvo = $this->getPublicoAlvoService->getPublicoAlvoById(
                $publicoAlvoId
            );

            if (!$getPublicoAlvo) {
                throw new PublicoAlvoIdException(
                    StatusHttp::NOT_FOUND,
                    sprintf(
                        ErrorMessage::ERROR_REGISTER_NOT_FOUND,
                        $publicoAlvoId
                    )
                );
            }

            return new ApiResponse(
                $publicoAlvoId,
                StatusHttp::OK,
                ApiResponse::SUCCESS
            );
        } catch (PublicoAlvoDatabaseException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (PublicoAlvoIdException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (Exception $e) {
            return new ApiResponse($e->getMessage(), $e->getCode(), ApiResponse::ERROR);
        }
    }
}