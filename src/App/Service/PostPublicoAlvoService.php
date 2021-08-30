<?php

declare(strict_types=1);

namespace App\Service;

use DateTime;
use App\Repository\PublicoAlvoRepository;
use App\Entity\PublicoAlvo;
use App\Exception\PublicoAlvoDatabaseException;

class PostPublicoAlvoService
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
    public function insertPublicoAlvo(PublicoAlvo $publicoAlvo): PublicoAlvo
    {
        return $this->publicoAlvoRepository->insertPublicoAlvo($publicoAlvo);
    }
}