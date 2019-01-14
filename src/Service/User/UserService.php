<?php

namespace App\Service\User;

use App\Entity\User\User;
use App\Repository\User\UserRepository;
use Goulaheau\RestBundle\Service\RestService;

class UserService extends RestService
{
    public function __construct(UserRepository $repository)
    {
        parent::__construct(User::class, $repository);
    }
}
