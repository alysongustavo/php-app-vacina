<?php

declare(strict_types=1);

namespace App\Service;

use App\Util\Enum\StatusHttp;
use App\Util\Enum\ErrorMessage;

use App\Repository\CampanhaRepository;
use App\Service\GetCampanhaService;

use App\Exception\CampanhaIdException;
use App\Exception\CampanhaDatabaseException;

class DeleteCampanhaService
{
    /**
     * @var CampanhaRepository
     */
    private $campanhaRepository;

    /**
     * @var GetCampanhaService
     */
    private $getCampanhaService;

    public function __construct(
        CampanhaRepository $campanhaRepository,
        GetCampanhaService $getCampanhaService
    ) {
        $this->campanhaRepository = $campanhaRepository;
        $this->getCampanhaService = $getCampanhaService;
    }

    /**
     * @param int $campanhaId
     * @throws CampanhaIdException
     * @throws CampanhaDatabaseException
     */
    public function deleteCampanha(int $campanhaId): void
    {
        $campanha = $this->getCampanhaService->getCampanhaById($campanhaId);

        if($campanha) {
            $this->campanhaRepository->deleteCampanha($campanha);
        } else {
            throw new CampanhaIdException(
                StatusHttp::NOT_FOUND,
                sprintf(
                    ErrorMessage::ERROR_REGISTER_NOT_FOUND,
                    $campanhaId
                )
            );
        }
    }
}