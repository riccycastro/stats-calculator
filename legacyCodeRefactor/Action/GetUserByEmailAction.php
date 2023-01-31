<?php

namespace App\Action;

use App\Database\UserRepositoryInterface;
use App\Exception\UserNotFoundException;
use App\Model\User;
use App\Value\GetUserByEmailValue;

class GetUserByEmailAction implements GetUserByEmailActionInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws UserNotFoundException
     */
    public function run(GetUserByEmailValue $value): User
    {
        $user = $this->userRepository->findUserByEmail($value->getEmail());

        if (!$user) {
            throw new UserNotFoundException('email', $value->getEmail());
        }

        return $user;
    }
}
