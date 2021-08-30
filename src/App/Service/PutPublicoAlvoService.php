<?php

declare(strict_types=1);

namespace App\Service;

use Datetime;
use App\Repository\PublicoAlvoRepository;

use App\Entity\PublicoAlvo;
use App\Exception\PublicoAlvoDatabaseException;

class PutPublicoAlvoService
{
    /**
     * @var PublicoAlvoRepository
     */
    private $publicoAlvoRepository;

    public function __construct(
        PublicoAlvoRepository $publicoAlvoRepository
    ) {
        $this->publicoAlvoRepository = $publicoAlvoRepository;
    }

    /**
     * @param PublicoAlvo $publicoAlvo
     * @return PublicoAlvo
     * @throws PublicoAlvoDatabaseException
     */
    public function updatePublicoAlvo(PublicoAlvo $publicoAlvo): PublicoAlvo
    {
        $databasePublicoAlvo = $this->publicoAlvoRepository->findByPublicoAlvoId($publicoAlvo->getId());

        $databasePublicoAlvo->setTitulo(strtoupper($publicoAlvo->getTitulo()));
        $databasePublicoAlvo->setDescricao($publicoAlvo->getDescricao());
        $databasePublicoAlvo->setStatus($publicoAlvo->getStatus());
        $databasePublicoAlvo->setCampanha($publicoAlvo->getCampanha());

        return $this->publicoAlvoRepository->updatePublicoAlvo($databasePublicoAlvo);
    }
}