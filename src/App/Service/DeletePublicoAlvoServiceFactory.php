<?php

declare(strict_types=1);

namespace App\Service;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use App\Entity\PublicoAlvo;

class DeletePublicoAlvoServiceFactory
{
    public function __invoke(ContainerInterface $container): DeletePublicoAlvoService
    {
        $entityManager = $container->get(EntityManager::class);
        $publicoAlvoRepository = $entityManager->getRepository(PublicoAlvo::class);
        $getPublicoAlvoService = $container->get(GetPublicoAlvoService::class);
        return new DeletePublicoAlvoService(
            $publicoAlvoRepository,
            $getPublicoAlvoService
        );
    }
}