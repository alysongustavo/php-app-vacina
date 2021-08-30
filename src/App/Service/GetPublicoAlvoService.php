<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\SQLFileNotFoundException;
use App\Repository\PublicoAlvoRepository;
use App\Exception\PublicoAlvoDatabaseException;
use App\Entity\PublicoAlvo;
use App\DTO\PublicoAlvoDto;
use App\DTO\CampanhaDto;

class GetPublicoAlvoService
{
    /**
     * @var PublicoAlvoRepository
     */
    private $publicoAlvoRepository;

    public function __construct(PublicoAlvoRepository $publicoAlvoRepository) {
        $this->publicoAlvoRepository = $publicoAlvoRepository;
    }

    /**
     * @param int $id
     * @return array|null
     * @throws PublicoAlvoDatabaseException
     */
    public function getPublicoAlvoById(int $id): ?PublicoAlvo
    {
        return $this->publicoAlvoRepository->findByPublicoAlvoId($id);
    }

    /**
     * @return array|null
     * @throws PublicoAlvoDatabaseException
     */
    public function getAllPublicosAlvos(): ?array
    {
        $allPublicosAlvos = $this->publicoAlvoRepository->findAllPublicosAlvos();

        $allPublicosAlvosResult = [];
        foreach ($allPublicosAlvos as $key => $value) {
            $publicoAlvoDto = new PublicoAlvoDto();
            $publicoAlvoDto->setId($value->getId());
            $publicoAlvoDto->setTitulo($value->getTitulo());
            $publicoAlvoDto->setDescricao($value->getDescricao());
            $publicoAlvoDto->setStatus($value->getStatus());
            $publicoAlvoDto->setCampanhaId($value->getCampanha()->getId());
            array_push($allPublicosAlvosResult, $publicoAlvoDto);
        }

        return $allPublicosAlvosResult;
    }

    /**
     * @param string $titulo
     * @return array|null
     * @throws PublicoAlvoDatabaseException
     * @throws SQLFileNotFoundException
     */
    public function getPublicoAlvoByTitulo(string $titulo): ?array
    {
        return $this->publicoAlvoRepository->findPublicoAlvoByTitulo($titulo);
    }
}