<?php

namespace App\Exception;

use Exception;
use Throwable;

class InternalServerErrorException extends HttpException implements HttpExceptionInterface
{
    public const ERROR_MESSAGE = 'Something when wrong from our side, please try again later';

    public function __construct(?Throwable $previous = null)
    {
        parent::__construct(500, self::ERROR_MESSAGE, 0, $previous);
    }
}
