<?php

declare(strict_types=1);

session_start();

try {

    require_once 'bootstrap.php';

} catch (\Throwable $e) {
    echo "{$e->getMessage()} in file {$e->getFile()} at line {$e->getLine()}";
    exit(1);
}

