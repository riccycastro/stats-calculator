<?php

use App\Database\Database;
use App\Handler\Exception\ExceptionHandler;
use Dotenv\Dotenv;
use Handler\Request\RequestHandler;

require __DIR__ . '/../vendor/autoload.php';

$dotEnv = Dotenv::createImmutable(__DIR__);
$dotEnv->load();

set_exception_handler(function (Throwable $throwable) {
    ExceptionHandler::handler($throwable);
});

Database::init();

RequestHandler::handle($_REQUEST);
