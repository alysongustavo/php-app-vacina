<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Util\Serialize\SerializeUtil;
use Psr\Container\ContainerInterface;
use App\Util\Validation\ValidationService;
use App\Service\GetPublicoAlvoService;
use App\Service\GetCampanhaService;

class PutPublicoAlvoMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): PutPublicoAlvoMiddleware
    {
        $serialize = $container->get(SerializeUtil::class);
        $validationService = $container->get(ValidationService::class);
        $getPublicoAlvoService = $container->get(GetPublicoAlvoService::class);
        $getCampanhaService = $container->get(GetCampanhaService::class);
        return new PutPublicoAlvoMiddleware(
            $serialize,
            $validationService,
            $getPublicoAlvoService,
            $getCampanhaService
        );
    }
}