<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use App\Service\DeletePublicoAlvoService;

class DeletePublicoAlvoHandlerFactory
{
    public function __invoke(ContainerInterface $container): DeletePublicoAlvoHandler
    {
        $deletePublicoAlvoService = $container->get(DeletePublicoAlvoService::class);
        return new DeletePublicoAlvoHandler(
            $deletePublicoAlvoService
        );
    }
}