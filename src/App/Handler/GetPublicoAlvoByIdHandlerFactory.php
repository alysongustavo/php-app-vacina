<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use App\Handler\GetPublicoAlvoByIdHandler;
use App\Service\GetPublicoAlvoService;

class GetPublicoAlvoByIdHandlerFactory
{
    public function __invoke(ContainerInterface $container): GetPublicoAlvoByIdHandler
    {
        $getPublicoAlvo = $container->get(GetPublicoAlvoService::class);
        return new GetPublicoAlvoByIdHandler(
            $getPublicoAlvo
        );
    }
}