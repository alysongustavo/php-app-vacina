<?php

declare(strict_types=1);

namespace App\Service;

use App\Util\Enum\StatusHttp;
use App\Util\Enum\ErrorMessage;

use App\Repository\PublicoAlvoRepository;
use App\Service\GetPublicoAlvoService;

use App\Exception\PublicoAlvoIdException;
use App\Exception\PublicoAlvoDatabaseException;

class DeletePublicoAlvoService
{
    /**
     * @var PublicoAlvoRepository
     */
    private $publicoAlvoRepository;

    /**
     * @var GetPublicoAlvoService
     */
    private $getPublicoAlvoService;

    public function __construct(
        PublicoAlvoRepository $publicoAlvoRepository,
        GetPublicoAlvoService $getPublicoAlvoService
    ) {
        $this->publicoAlvoRepository = $publicoAlvoRepository;
        $this->getPublicoAlvoService = $getPublicoAlvoService;
    }

    /**
     * @param int $publicoAlvoId
     * @throws PublicoAlvoIdException
     * @throws PublicoAlvoDatabaseException
     */
    public function deletePublicoAlvo(int $publicoAlvoId): void
    {
        $publicoAlvo = $this->getPublicoAlvoService->getPublicoAlvoById($publicoAlvoId);

        if($publicoAlvo) {
            $this->publicoAlvoRepository->deletePublicoAlvo($publicoAlvo);
        } else {
            throw new PublicoAlvoIdException(
                StatusHttp::NOT_FOUND,
                sprintf(
                    ErrorMessage::ERROR_REGISTER_NOT_FOUND,
                    $publicoAlvoId
                )
            );
        }
    }
}