<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use App\Service\GetCampanhaService;

class GetAllCampanhaHandlerFactory
{
    public function __invoke(ContainerInterface $container): GetAllCampanhaHandler
    {
        $getCampanha = $container->get(GetCampanhaService::class);
        return new GetAllCampanhaHandler($getCampanha);
    }
}