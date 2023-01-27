<?php

namespace App\Exception;

class UserNotFoundException extends HttpException
{
    public function __construct(string $property, string $value)
    {
        parent::__construct(
            404,
            sprintf('User with %s %s not found', $property, $value)
        );
    }
}
