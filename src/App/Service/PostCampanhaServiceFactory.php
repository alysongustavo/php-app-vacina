<?php

declare(strict_types=1);

namespace App\Service;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use App\Entity\Campanha;

class PostCampanhaServiceFactory
{
    public function __invoke(ContainerInterface $container): PostCampanhaService
    {
        $entityManager = $container->get(EntityManager::class);
        $campanhaRepository = $entityManager->getRepository(Campanha::class);
        return new PostCampanhaService(
            $campanhaRepository
        );
    }
}