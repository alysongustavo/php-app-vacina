<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use App\Service\GetPublicoAlvoService;

class GetAllPublicoAlvoHandlerFactory
{
    public function __invoke(ContainerInterface $container): GetAllPublicoAlvoHandler
    {
        $getPublicoAlvo = $container->get(GetPublicoAlvoService::class);
        return new GetAllPublicoAlvoHandler($getPublicoAlvo);
    }
}