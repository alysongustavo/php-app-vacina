<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\SQLFileNotFoundException;
use App\Repository\CampanhaRepository;
use App\Exception\CampanhaDatabaseException;
use App\Entity\Campanha;
use App\DTO\CampanhaDto;

class GetCampanhaService
{
    /**
     * @var CampanhaRepository
     */
    private $campanhaRepository;

    public function __construct(CampanhaRepository $campanhaRepository) {
        $this->campanhaRepository = $campanhaRepository;
    }

    /**
     * @param int $id
     * @return array|null
     * @throws CampanhaDatabaseException
     */
    public function getCampanhaById(int $id): ?Campanha
    {
        return $this->campanhaRepository->findByCampanhaId($id);
    }

    /**
     * @return array|null
     * @throws CampanhaDatabaseException
     */
    public function getAllCampanhas(): ?array
    {
        $allCampanhas = $this->campanhaRepository->findAllCampanhas();

        $allCampanhasResult = [];
        foreach ($allCampanhas as $key => $value) {
            $campanhaDto = new CampanhaDto();
            $campanhaDto->setId($value->getId());
            $campanhaDto->setTitulo($value->getTitulo());
            $campanhaDto->setDescricao($value->getDescricao());
            $campanhaDto->setDataIni($value->getDataIni());
            $campanhaDto->setDataFim($value->getDataFim());
            array_push($allCampanhasResult, $campanhaDto);
        }

        return $allCampanhasResult;
    }

    /**
     * @param string $titulo
     * @return array|null
     * @throws CampanhaDatabaseException
     * @throws SQLFileNotFoundException
     */
    public function getCampanhaByTitulo(string $titulo): ?array
    {
        return $this->campanhaRepository->findCampanhaByTitulo($titulo);
    }
}