<?php

declare(strict_types=1);

namespace App\Service;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use App\Entity\Campanha;

class DeleteCampanhaServiceFactory
{
    public function __invoke(ContainerInterface $container): DeleteCampanhaService
    {
        $entityManager = $container->get(EntityManager::class);
        $campanhaRepository = $entityManager->getRepository(Campanha::class);
        $getCampanhaService = $container->get(GetCampanhaService::class);
        return new DeleteCampanhaService(
            $campanhaRepository,
            $getCampanhaService
        );
    }
}