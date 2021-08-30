<?php

declare(strict_types=1);

namespace App\Service;

use Datetime;
use App\Repository\CampanhaRepository;

use App\Entity\Campanha;
use App\Exception\CampanhaDatabaseException;

class PutCampanhaService
{
    /**
     * @var CampanhaRepository
     */
    private $cityRepository;

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
    public function updateCampanha(Campanha $campanha): Campanha
    {
        $databaseCampanha = $this->campanhaRepository->findByCampanhaId($campanha->getId());

        $databaseCampanha->setTitulo(strtoupper($campanha->getTitulo()));
        $databaseCampanha->setDescricao($campanha->getDescricao());
        $databaseCampanha->setDataIni($campanha->getDataIni());
        $databaseCampanha->setDataFim($campanha->getDataFim());

        return $this->campanhaRepository->updateCampanha($databaseCampanha);
    }
}