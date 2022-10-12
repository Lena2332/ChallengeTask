<?php

declare(strict_types=1);

namespace Project\Controllers;

use Project\Repositories\RepositoryIntrface;

abstract class Controller
{
    protected RepositoryIntrface $repository;

    protected function render(string $output)
    {
        unset($_SESSION['success']);
        unset($_SESSION['warning']);

        header('Content-Type: text/html; charset=utf-8');

        echo $output;
    }

}