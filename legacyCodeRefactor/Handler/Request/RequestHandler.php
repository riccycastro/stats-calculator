<?php

namespace Handler\Request;

use App\Action\Factory\GetUserByEmailActionFactory;
use App\Handler\Param\ParamHandler;
use App\Value\GetUserByEmailValue;

class RequestHandler
{
    public static function handle(array $request): void
    {
        $requestParam = ParamHandler::handle($request);

        $masterEmail = $requestParam->getMasterEmail();

        echo 'The master email is ' . $masterEmail . '\n';

        $getUserByEmailAction = GetUserByEmailActionFactory::create();

        $user = $getUserByEmailAction->run(
            GetUserByEmailValue::fromRequestParam($requestParam)
        );

        echo $user->getUsername() . "\n";
    }
}
