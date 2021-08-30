<?php

declare(strict_types=1);

namespace App\Handler;

use Exception;
use App\Util\Enum\StatusHttp;
use App\Service\Response\ApiResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use App\Service\GetPublicoAlvoService;

use App\Exception\PublicoAlvoDatabaseException;

class GetAllPublicoAlvoHandler implements RequestHandlerInterface
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

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        try {
            $getPublicoAlvo = $this->getPublicoAlvoService->getAllPublicosAlvos();

            return new ApiResponse(
                $getPublicoAlvo,
                StatusHttp::OK,
                ApiResponse::SUCCESS
            );
        } catch (PublicoALvoDatabaseException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (Exception $e) {
            return new ApiResponse($e->getMessage(), $e->getCode(), ApiResponse::ERROR);
        }
    }
}