<?php

declare(strict_types=1);

require_once __DIR__.'/vendor/autoload.php';

$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__.'/config/di.php');
$container = $containerBuilder->build();
$router = $container->get('Project\Route');
$router->route();


