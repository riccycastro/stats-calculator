<?php

namespace App\Exception;

use Exception;
use Throwable;

class HttpException extends Exception implements HttpExceptionInterface
{
    private int $statusCode;

    public function __construct(int $statusCode, string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $this->statusCode = $statusCode;

        parent::__construct($message, $code, $previous);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
