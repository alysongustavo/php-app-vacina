<?php

declare(strict_types=1);

use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'params' => ['url' => 'mysql://root:computacao2014@db/db_vacina'],
            ],
        ],
        'driver' => [
            'orm_default' => [
                'class' => MappingDriverChain::class,
                'drivers' => ['App\Entity' => 'app_entity'],
            ],
            'app_entity' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . './../../src/App/Entity'],
            ],
        ],
        'migrations' => [
            'orm_default' => [
                'table_storage' => [
                    'table_name' => 'migrations_executed',
                    'version_column_name' => 'version',
                    'version_column_length' => 255,
                    'executed_at_column_name' => 'executed_at',
                    'execution_time_column_name' => 'execution_time',
                ],
                'migrations_paths' => ['My\Migrations' => __DIR__ . './../../data/Migrations'],
                'all_or_nothing' => true,
                'check_database_platform' => true,
            ],
        ],
    ],
];
