<?php

declare(strict_types=1);

namespace App\Service;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use App\Entity\PublicoAlvo;

class PostPublicoAlvoServiceFactory
{
    public function __invoke(ContainerInterface $container): PostPublicoAlvoService
    {
        $entityManager = $container->get(EntityManager::class);
        $publicoAlvoRepository = $entityManager->getRepository(PublicoAlvo::class);
        return new PostPublicoAlvoService(
            $publicoAlvoRepository
        );
    }
}