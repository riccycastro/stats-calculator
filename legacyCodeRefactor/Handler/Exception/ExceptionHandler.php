<?php

namespace App\Handler\Exception;

use App\Exception\HttpExceptionInterface;
use App\Exception\InternalServerErrorException;
use InvalidArgumentException;
use Throwable;

class ExceptionHandler
{
    public static function handler(Throwable $throwable): void
    {
        error_log(self::generateErrorLog($throwable));

        if ($throwable instanceof HttpExceptionInterface) {
            http_response_code($throwable->getStatusCode());
            echo $throwable->getMessage();
            return;
        }

        if ($throwable instanceof InvalidArgumentException) {
            http_response_code(400);
            echo $throwable->getMessage();
            return;
        }

        http_response_code(500);
        echo InternalServerErrorException::ERROR_MESSAGE;
    }

    private static function generateErrorLog(?Throwable $throwable): string
    {
        if (null === $throwable) {
            return '';
        }

        return $throwable->getMessage() . ' ::: ' . self::generateErrorLog($throwable->getPrevious());
    }
}
