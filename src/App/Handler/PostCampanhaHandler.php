<?php

declare(strict_types=1);

namespace App\Handler;

use Exception;
use App\Util\Enum\StatusHttp;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use App\Service\PostCampanhaService;

use Psr\Http\Server\RequestHandlerInterface;
use App\Service\Response\ApiResponse;

use App\Exception\CampanhaDatabaseException;

class PostCampanhaHandler implements RequestHandlerInterface
{
    /**
     * @var PostCampanhaService
     */
    private $postCampanhaService;

    public function __construct(
        PostCampanhaService $postCampanhaService
    ) {
        $this->postCampanhaService = $postCampanhaService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        try {
            $response = $this->postCampanhaService->insertCampanha(
                $request->getAttribute('postCampanha')
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