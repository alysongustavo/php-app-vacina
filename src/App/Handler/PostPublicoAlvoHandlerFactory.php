<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use App\Service\PostPublicoAlvoService;

class PostPublicoAlvoHandlerFactory
{
    public function __invoke(ContainerInterface $container): PostPublicoAlvoHandler
    {
        $getPublicoAlvo = $container->get(PostPublicoAlvoService::class);
        return new PostPublicoAlvoHandler(
            $getPublicoAlvo
        );
    }
}