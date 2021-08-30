<?php

declare(strict_types=1);

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'aliases' to alias a service name to another service. The
        // key is the alias name, the value is the service to which it points.
        'aliases' => [
            // Fully\Qualified\ClassOrInterfaceName::class => Fully\Qualified\ClassName::class,
            "doctrine.entity_manager.orm_default" => Doctrine\ORM\EntityManager::class,
        ],
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            // Fully\Qualified\InterfaceName::class => Fully\Qualified\ClassName::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            // Fully\Qualified\ClassName::class => Fully\Qualified\FactoryName::class,
            Doctrine\ORM\EntityManager::class => \Roave\PsrContainerDoctrine\EntityManagerFactory::class,

            \Doctrine\Migrations\Tools\Console\Command\ExecuteCommand::class => \Roave\PsrContainerDoctrine\Migrations\CommandFactory::class,

            // Optionally, you could make your container aware of additional factories as of migrations release v3.0:
            \Doctrine\Migrations\Configuration\Migration\ConfigurationLoader::class => \Roave\PsrContainerDoctrine\Migrations\ConfigurationLoaderFactory::class,
            \Doctrine\Migrations\DependencyFactory::class => \Roave\PsrContainerDoctrine\Migrations\DependencyFactoryFactory::class,
        ],
    ],
];
