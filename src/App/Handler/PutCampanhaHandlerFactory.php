<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use App\Service\PutCampanhaService;

class PutCampanhaHandlerFactory
{
    public function __invoke(ContainerInterface $container): PutCampanhaHandler
    {
        $getCampanha = $container->get(PutCampanhaService::class);
        return new PutCampanhaHandler(
            $getCampanha
        );
    }
}