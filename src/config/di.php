<?php

declare(strict_types=1);

return [
    \Project\Repositories\RepositoryIntrface::class => DI\get(
        \Project\DB::class
    ),

    \Project\DB::class =>  DI\autowire(\Project\DB::class)
        ->constructorParameter(
            'connectionParams',
            [
                \Project\DB::DB_NAME     => 'challenge',
                \Project\DB::DB_USER     => 'test',
                \Project\DB::DB_PASSWORD => 'my-password',
                \Project\DB::DB_HOST     => 'mysql',
                \Project\DB::DB_PORT     => '3306'
            ]
        ),

    CompanyController::class => \DI\create(\Project\Controllers\CompanyController::class)
        ->constructor(\DI\autowire(\Project\Repositories\CompanyRepository::class)),

    StoreController::class => \DI\create(\Project\Controllers\StoreController::class)
        ->constructor(\DI\get(\Project\Repositories\StoreRepository::class)),

    NotFoundController::class => \DI\create(\Project\Controllers\NotFoundController::class)
];
