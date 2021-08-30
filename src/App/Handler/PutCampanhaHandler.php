<?php

declare(strict_types=1);

namespace App\Handler;

use Exception;
use App\Util\Enum\StatusHttp;
use App\Service\Response\ApiResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use App\Service\PutCampanhaService;
use App\Exception\CampanhaDatabaseException;

class PutCampanhaHandler implements RequestHandlerInterface
{
    /**
     * @var PutCampanhaService
     */
    private $putCampanhaService;

    public function __construct(
        PutCampanhaService $putCampanhaService
    ) {
        $this->putCampanhaService = $putCampanhaService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $response = $this->putCampanhaService->updateCampanha(
                $request->getAttribute('putCampanha')
            );

            return new ApiResponse(
                $response,
                StatusHttp::OK,
                ApiResponse::SUCCESS
            );
        } catch (CampanhaDatabaseException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (Exception $e) {
            return new ApiResponse($e->getMessage(), $e->getCode(), ApiResponse::ERROR);
        }
    }
}