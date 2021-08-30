<?php

declare(strict_types=1);

namespace App\Service;

use Doctrine\ORM\EntityManager;
use GeoNamesApp\City\Entity\City;
use Psr\Container\ContainerInterface;
use App\Service\PutCampanhaService;
use App\Entity\Campanha;

class PutCampanhaServiceFactory
{
    public function __invoke(ContainerInterface $container): PutCampanhaService
    {
        $entityManager = $container->get(EntityManager::class);
        $campanhaRepository = $entityManager->getRepository(Campanha::class);
        return new PutCampanhaService(
            $campanhaRepository
        );
    }
}