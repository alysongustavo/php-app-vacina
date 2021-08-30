<?php

declare(strict_types=1);

namespace App\Handler;

use Exception;
use App\Util\Enum\StatusHttp;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use App\Service\PostPublicoAlvoService;

use Psr\Http\Server\RequestHandlerInterface;
use App\Service\Response\ApiResponse;

use App\Exception\PublicoAlvoDatabaseException;

class PostPublicoAlvoHandler implements RequestHandlerInterface
{
    /**
     * @var PostPublicoAlvoService
     */
    private $postPublicoAlvoService;

    public function __construct(
        PostPublicoAlvoService $postPublicoAlvoService
    ) {
        $this->postPublicoAlvoService = $postPublicoAlvoService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        try {
            $response = $this->postPublicoAlvoService->insertPublicoAlvo(
                $request->getAttribute('postPublicoAlvo')
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