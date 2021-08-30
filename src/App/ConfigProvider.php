<?php

declare(strict_types=1);

namespace App;

use Mezzio\Application;
use App\Handler\DeleteCampanhaHandler;
use App\Handler\DeleteCampanhaHandlerFactory;
use App\Handler\GetAllCampanhaHandler;
use App\Handler\GetAllCampanhaHandlerFactory;
use App\Handler\GetCampanhaByIdHandler;
use App\Handler\PostCampanhaHandler;
use App\Handler\PostCampanhaHandlerFactory;
use App\Handler\PutCampanhaHandler;
use App\Handler\PutCampanhaHandlerFactory;
use App\Service\DeleteCampanhaService;
use App\Service\DeleteCampanhaServiceFactory;
use App\Service\GetCampanhaService;
use App\Service\GetCampanhaServiceFactory;
use App\Service\PostCampanhaService;
use App\Service\PostCampanhaServiceFactory;
use App\Service\PutCampanhaService;
use App\Service\PutCampanhaServiceFactory;
use App\Middleware\PostCampanhaMiddleware;
use App\Middleware\PostCampanhaMiddlewareFactory;
use App\Middleware\PutCampanhaMiddleware;
use App\Middleware\PutCampanhaMiddlewareFactory;
use App\Util\Serialize\SerializeUtil;
use App\Util\Serialize\SerializeUtilFactory;
use App\Util\Validation\ValidationService;
use App\Util\Validation\ValidationServiceFactory;
use Symfony\Component\Validator\Validation;
use App\Util\ReadArchive\ReadArchiveSQL;
use App\Util\ReadArchive\ReadArchiveSQLFactory;
use App\Container\JMSFactory;
use App\Container\ValidationFactory;
use App\Handler\DeletePublicoAlvoHandler;
use App\Handler\GetAllPublicoAlvoHandler;
use App\Handler\GetPublicoAlvoByIdHandler;
use App\Handler\PostPublicoAlvoHandler;
use App\Handler\PutPublicoAlvoHandler;
use App\Handler\DeletePublicoAlvoHandlerFactory;
use App\Handler\GetAllPublicoAlvoHandlerFactory;
use App\Handler\GetPublicoAlvoByIdHandlerFactory;
use App\Handler\PostPublicoAlvoHandlerFactory;
use App\Handler\PutPublicoAlvoHandlerFactory;
use App\Service\DeletePublicoAlvoService;
use App\Service\DeletePublicoAlvoServiceFactory;
use App\Service\GetPublicoAlvoService;
use App\Service\GetPublicoAlvoServiceFactory;
use App\Service\PostPublicoAlvoService;
use App\Service\PostPublicoAlvoServiceFactory;
use App\Service\PutPublicoAlvoServiceFactory;
use App\Service\PutPublicoAlvoService;
use App\Middleware\PostPublicoAlvoMiddleware;
use App\Middleware\PostPublicoAlvoMiddlewareFactory;
use App\Middleware\PutPublicoAlvoMiddleware;
use App\Middleware\PutPublicoAlvoMiddlewareFactory;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies()
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'delegators' => [
                Application::class => [RoutesDelegator::class]
            ],

            'invokables' => [
                Handler\PingHandler::class => Handler\PingHandler::class,
            ],
            'factories'  => [
                
                # Utilitários
                SerializeUtil::class => SerializeUtilFactory::class,
                ValidationService::class => ValidationServiceFactory::class,
                Validation::class => ValidationFactory::class,
                ReadArchiveSQL::class => ReadArchiveSQLFactory::class,

                # Handler

                #Campanha
                DeleteCampanhaHandler::class => DeleteCampanhaHandlerFactory::class,
                GetAllCampanhaHandler::class => GetAllCampanhaHandlerFactory::class,
                GetCampanhaByIdHandler::class => GetCampanhaByIdHandlerFactory::class,
                PostCampanhaHandler::class => PostCampanhaHandlerFactory::class,
                PutCampanhaHandler::class => PutCampanhaHandlerFactory::class,

                #PublicoAlvo
                DeletePublicoAlvoHandler::class => DeletePublicoAlvoHandlerFactory::class,
                GetAllPublicoAlvoHandler::class => GetAllPublicoAlvoHandlerFactory::class,
                GetPublicoAlvoByIdHandler::class => GetPublicoAlvoByIdHandlerFactory::class,
                PostPublicoAlvoHandler::class => PostPublicoAlvoHandlerFactory::class,
                PutPublicoAlvoHandler::class => PutPublicoAlvoHandlerFactory::class,

                # Service

                # Campanha
                DeleteCampanhaService::class => DeleteCampanhaServiceFactory::class,
                GetCampanhaService::class => GetCampanhaServiceFactory::class,
                PostCampanhaService::class => PostCampanhaServiceFactory::class,
                PutCampanhaService::class => PutCampanhaServiceFactory::class,

                # PublicoAlvo
                DeletePublicoAlvoService::class => DeletePublicoAlvoServiceFactory::class,
                GetPublicoAlvoService::class => GetPublicoAlvoServiceFactory::class,
                PostPublicoAlvoService::class => PostPublicoAlvoServiceFactory::class,
                PutPublicoAlvoService::class => PutPublicoAlvoServiceFactory::class,

                # Middleware

                # Campanha
                PostCampanhaMiddleware::class => PostCampanhaMiddlewareFactory::class,
                PutCampanhaMiddleware::class => PutCampanhaMiddlewareFactory::class,

                # PublicoAlvo
                PostPublicoAlvoMiddleware::class => PostPublicoAlvoMiddlewareFactory::class,
                PutPublicoAlvoMiddleware::class => PutPublicoAlvoMiddlewareFactory::class,

                'serializer' => JMSFactory::class,
                
            ],
        ];
    }
}
