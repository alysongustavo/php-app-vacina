<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use App\Handler\GetCampanhaByIdHandler;
use App\Service\GetCampanhaService;

class GetCampanhaByIdHandlerFactory
{
    public function __invoke(ContainerInterface $container): GetCampanhaByIdHandler
    {
        $getCampanha = $container->get(GetCampanhaService::class);
        return new GetCampanhaByIdHandler(
            $getCampanha
        );
    }
}