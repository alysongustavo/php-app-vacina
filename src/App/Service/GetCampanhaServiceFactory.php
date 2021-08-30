<?php

declare(strict_types=1);

namespace App\Service;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use App\Entity\Campanha;

class GetCampanhaServiceFactory
{
    public function __invoke(ContainerInterface $container): GetCampanhaService
    {
        $entityManager = $container->get(EntityManager::class);
        $campanhaRepository = $entityManager->getRepository(Campanha::class);
        return new GetCampanhaService(
            $campanhaRepository
        );
    }
}