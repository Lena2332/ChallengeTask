<?php

declare(strict_types=1);

namespace Project\Controllers;

class NotFoundController
{
    const TEMPL = __DIR__ . '/../../templates/404.php';

    /**
     * @return void
     */
    public function return404(): void
    {
        $title = 'Page Not Found';

        header("HTTP/1.0 404 Not Found");

        require_once self::TEMPL;

        exit();
    }
}