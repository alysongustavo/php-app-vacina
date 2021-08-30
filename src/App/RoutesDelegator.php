<?php

declare(strict_types=1);

namespace App;

use Mezzio\Application;
use Psr\Container\ContainerInterface;
use App\Middleware\PostCampanhaMiddleware;
use App\Handler\PostCampanhaHandler;
use App\Middleware\PutCampanhaMiddleware;
use App\Handler\PutCampanhaHandler;
use App\Handler\GetAllCampanhaHandler;
use App\Handler\GetCampanhaByIdHandler;
use App\Handler\DeleteCampanhaHandler;
use App\Middleware\PostPublicoAlvoMiddleware;
use App\Handler\PostPublicoAlvoHandler;
use App\Middleware\PutPublicoAlvoMiddleware;
use App\Handler\PutPublicoAlvoHandler;
use App\Handler\DeletePublicoAlvoHandler;
use App\Handler\GetAllPublicoAlvoHandler;
use App\Handler\GetPublicoAlvoByIdHandler;

class RoutesDelegator
{
    /**
     * @param ContainerInterface $container
     * @param string $serviceName
     * @param callable $callback
     * @return Application
     */
    public function __invoke(ContainerInterface $container, string $serviceName, callable $callback): Application
    {
        /**
         * @var Application $app
         */
        $app = $callback();

        // ROTAS CAMPANHA
        $app->post("/v1/campanha", [
            PostCampanhaMiddleware::class,
            PostCampanhaHandler::class,
        ], "post.campanha");

        $app->put("/v1/campanha/{id:\d+}", [
            PutCampanhaMiddleware::class,
            PutCampanhaHandler::class,
        ], "put.campanha");

        $app->delete("/v1/campanha/{id:\d+}", [
            DeleteCampanhaHandler::class,
        ], "delete.campanha");

        $app->get("/v1/campanhas", [
            GetAllCampanhaHandler::class,
        ], "get.all_campanha");

        $app->get("/v1/campanha/{id:\d+}", [
            GetCampanhaByIdHandler::class,
        ], "get.campanha_byid");

        // ROTAS PUBLICO ALVO
        $app->post("/v1/publicoalvo", [
            PostPublicoAlvoMiddleware::class,
            PostPublicoAlvoHandler::class,
        ], "post.publicoalvo");

        $app->put("/v1/publicoalvo/{id:\d+}", [
            PutPublicoAlvoMiddleware::class,
            PutPublicoAlvoHandler::class,
        ], "put.publicoalvo");

        $app->delete("/v1/publicoalvo/{id:\d+}", [
            DeletePublicoAlvoHandler::class,
        ], "delete.publicoalvo");

        $app->get("/v1/publicosalvos", [
            GetAllPublicoAlvoHandler::class,
        ], "get.all_publicoalvo");

        $app->get("/v1/publicoalvo/{id:\d+}", [
            GetPublicoAlvoByIdHandler::class,
        ], "get.publicoalvo_byid");

        return $app;
    }
}