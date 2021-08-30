<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Util\Serialize\SerializeUtil;
use Psr\Container\ContainerInterface;
use App\Util\Validation\ValidationService;
use App\Service\GetCampanhaService;

class PutCampanhaMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): PutCampanhaMiddleware
    {
        $serialize = $container->get(SerializeUtil::class);
        $validationService = $container->get(ValidationService::class);
        $getCampanhaService = $container->get(GetCampanhaService::class);
        return new PutCampanhaMiddleware(
            $serialize,
            $validationService,
            $getCampanhaService
        );
    }
}