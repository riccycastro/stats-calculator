<?php

namespace App\Database;

use App\Model\User;

interface UserRepositoryInterface
{
    public function findUserByEmail(string $email): ?User;
}
