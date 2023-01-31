<?php

namespace App\Action\Factory;

use App\Action\GetUserByEmailAction;
use App\Action\GetUserByEmailActionInterface;
use App\Database\UserRepository;

class GetUserByEmailActionFactory
{
    public static function create(): GetUserByEmailActionInterface
    {
        $userDatabase = new UserRepository();

        return new GetUserByEmailAction($userDatabase);
    }
}
