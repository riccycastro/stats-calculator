<?php

namespace App\Handler\Param;

class ParamHandler
{
    public static function handle(array $request): RequestParam
    {
        return (new RequestParam())
            ->setEmail($request['email'] ?? null)
            ->setMasterEmail($request['masterEmail'] ?? 'unknown');
    }
}
