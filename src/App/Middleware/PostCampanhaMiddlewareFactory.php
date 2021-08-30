<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Util\Serialize\SerializeUtil;
use Psr\Container\ContainerInterface;
use App\Util\Validation\ValidationService;
use GeoNamesApp\State\Service\GetStateService;
use App\Middleware\PostCampanhaMiddleware;
use App\Service\GetCampanhaService;

class PostCampanhaMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): PostCampanhaMiddleware
    {
        $serialize = $container->get(SerializeUtil::class);
        $validationService = $container->get(ValidationService::class);
        $getCampanhaService = $container->get(GetCampanhaService::class);
        return new PostCampanhaMiddleware(
            $serialize,
            $validationService,
            $getCampanhaService
        );
    }
}