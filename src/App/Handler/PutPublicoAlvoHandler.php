<?php

declare(strict_types=1);

namespace App\Handler;

use Exception;
use App\Util\Enum\StatusHttp;
use App\Service\Response\ApiResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use App\Service\PutPublicoAlvoService;
use App\Exception\PublicoAlvoDatabaseException;

class PutPublicoAlvoHandler implements RequestHandlerInterface
{
    /**
     * @var PutPublicoAlvoService
     */
    private $putPublicoAlvoService;

    public function __construct(
        PutPublicoAlvoService $putPublicoAlvoService
    ) {
        $this->putPublicoAlvoService = $putPublicoAlvoService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $response = $this->putPublicoAlvoService->updatePublicoAlvo(
                $request->getAttribute('putPublicoAlvo')
            );

            return new ApiResponse(
                $response,
                StatusHttp::OK,
                ApiResponse::SUCCESS
            );
        } catch (PublicoAlvoDatabaseException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (Exception $e) {
            return new ApiResponse($e->getMessage(), $e->getCode(), ApiResponse::ERROR);
        }
    }
}