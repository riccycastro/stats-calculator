<?php

namespace App\Action;

use App\Model\User;
use App\Value\GetUserByEmailValue;

interface GetUserByEmailActionInterface
{
    public function run(GetUserByEmailValue $value): User;
}
