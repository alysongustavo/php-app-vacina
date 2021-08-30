<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use App\Service\DeleteCampanhaService;

class DeleteCampanhaHandlerFactory
{
    public function __invoke(ContainerInterface $container): DeleteCampanhaHandler
    {
        $deleteCampanhaService = $container->get(DeleteCampanhaService::class);
        return new DeleteCampanhaHandler(
            $deleteCampanhaService
        );
    }
}