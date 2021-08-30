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

use App\Service\GetCampanhaService;
use App\Exception\CampanhaIdException;
use App\Exception\CampanhaDatabaseException;

class GetCampanhaByIdHandler implements RequestHandlerInterface
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

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $campanhaId = intval($request->getAttribute("id"));

            $getCampanha = $this->getCampanhaService->getCampanhaById(
                $campanhaId
            );

            if (!$getCampanha) {
                throw new CampanhaIdException(
                    StatusHttp::NOT_FOUND,
                    sprintf(
                        ErrorMessage::ERROR_REGISTER_NOT_FOUND,
                        $campanhaId
                    )
                );
            }

            return new ApiResponse(
                $campanhaId,
                StatusHttp::OK,
                ApiResponse::SUCCESS
            );
        } catch (CampanhaDatabaseException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (CampanhaIdException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (Exception $e) {
            return new ApiResponse($e->getMessage(), $e->getCode(), ApiResponse::ERROR);
        }
    }
}