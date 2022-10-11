<?php

declare(strict_types=1);

namespace Project\Controllers;

use Project\Repositories\RepositoryIntrface;

abstract class Controller
{
    protected RepositoryIntrface $repository;

    public function render(string $template, array $data)
    {
        ob_start();

        require_once $template;

        return (string) ob_get_clean();


    }
}