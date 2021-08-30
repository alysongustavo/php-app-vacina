<?php

declare(strict_types=1);

namespace App\Service;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use App\Entity\PublicoAlvo;

class PutPublicoAlvoServiceFactory
{
    public function __invoke(ContainerInterface $container): PutPublicoAlvoService
    {
        $entityManager = $container->get(EntityManager::class);
        $publicoAlvoRepository = $entityManager->getRepository(PublicoAlvo::class);
        return new PutPublicoAlvoService(
            $publicoAlvoRepository
        );
    }
}