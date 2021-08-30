<?php

declare(strict_types=1);

namespace App\Service;

use DateTime;
use App\Repository\CampanhaRepository;
use App\Entity\Campanha;
use App\Exception\CampanhaDatabaseException;

class PostCampanhaService
{
    /**
     * @var CampanhaRepository
     */
    private $campanhaRepository;

    public function __construct(
        CampanhaRepository $campanhaRepository
    ) {
        $this->campanhaRepository = $campanhaRepository;
    }

    /**
     * @param Campanha $campanha
     * @return Campanha
     * @throws CampanhaDatabaseException
     */
    public function insertCampanha(Campanha $campanha): Campanha
    {
        $campanha->setDataIni(new DateTime());
        return $this->campanhaRepository->insertCampanha($campanha);
    }
}