<?php

declare(strict_types=1);

namespace App\Handler;

use Exception;
use App\Util\Enum\StatusHttp;
use App\Util\Enum\SuccessMessage;
use App\Service\Response\ApiResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use App\Service\DeletePublicoAlvoService;

use App\Exception\PublicoAlvoDatabaseException;
use app\Exception\PublicoAlvoIdException;

class DeletePublicoAlvoHandler implements RequestHandlerInterface
{
    /**
     * @var DeletePublicoAlvoService
     */
    private $deletePublicoAlvoService;

    public function __construct(
        DeletePublicoAlvoService $deletePublicoAlvoService
    ) {
        $this->deletePublicoAlvoService = $deletePublicoAlvoService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $publicoAlvoId = intval($request->getAttribute("id"));

            $this->deletePublicoAlvoService->deletePublicoAlvo($publicoAlvoId);

            return new ApiResponse(
                sprintf(
                    SuccessMessage::DELETING_RECORD,
                    $publicoAlvoId
                ),
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