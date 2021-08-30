<?php

declare(strict_types=1);

namespace App\Handler;

use Exception;
use App\Util\Enum\StatusHttp;
use App\Service\Response\ApiResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use App\Service\GetCampanhaService;

use App\Exception\CampanhaDatabaseException;

class GetAllCampanhaHandler implements RequestHandlerInterface
{
    /**
     * @var GetCampanhaService
     */
    private $getCampanhaService;

    public function __construct(
        GetCampanhaService $getCampanhaService
    ) {
        $this->getCampanhaService = $getCampanhaService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $getCampanha = $this->getCampanhaService->getAllCampanhas();

            return new ApiResponse(
                $getCampanha,
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