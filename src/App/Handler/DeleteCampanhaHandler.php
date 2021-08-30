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

use App\Service\DeleteCampanhaService;

use App\Exception\CampanhaDatabaseException;
use app\Exception\CampanhaIdException;

class DeleteCampanhaHandler implements RequestHandlerInterface
{
    /**
     * @var DeleteCampanhaService
     */
    private $deleteCampanhaService;

    public function __construct(
        DeleteCampanhaService $deleteCampanhaService
    ) {
        $this->deleteCampanhaService = $deleteCampanhaService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $campanhaId = intval($request->getAttribute("id"));

            $this->deleteCampanhaService->deleteCampanha($campanhaId);

            return new ApiResponse(
                sprintf(
                    SuccessMessage::DELETING_RECORD,
                    $campanhaId
                ),
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