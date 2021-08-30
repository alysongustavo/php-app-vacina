<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use App\Service\PutPublicoAlvoService;

class PutPublicoAlvoHandlerFactory
{
    public function __invoke(ContainerInterface $container): PutPublicoAlvoHandler
    {
        $getPublicoAlvo = $container->get(PutPublicoAlvoService::class);
        return new PutPublicoAlvoHandler(
            $getPublicoAlvo
        );
    }
}