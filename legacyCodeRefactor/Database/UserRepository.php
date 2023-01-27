<?php

namespace App\Database;

use App\Model\User;
use PDO;

class UserRepository extends Database implements UserRepositoryInterface
{
    public function findUserByEmail(string $email): ?User
    {
        $stmt = $this->prepare("SELECT * FROM users WHERE email=:email");
        $stmt->execute(['email' => $email]);

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$userData) {
            return null;
        }

        return $this->hydrateUser($userData);
    }

    private function hydrateUser(array $userData): User
    {
        return (new User())
            ->setUsername($userData['username'] ?? null);
    }
}
