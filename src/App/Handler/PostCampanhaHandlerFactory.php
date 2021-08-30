<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use App\Handler\PostCampanhaHandler;
use App\Service\PostCampanhaService;

class PostCampanhaHandlerFactory
{
    public function __invoke(ContainerInterface $container): PostCampanhaHandler
    {
        $getCampanha = $container->get(PostCampanhaService::class);
        return new PostCampanhaHandler(
            $getCampanha
        );
    }
}