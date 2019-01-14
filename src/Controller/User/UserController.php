<?php

namespace App\Controller\User;

use App\Entity\User\User;
use App\Service\User\UserService;
use Goulaheau\RestBundle\Controller\RestController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/user")
 */
class UserController extends RestController
{
    public function __construct(UserService $service)
    {
        parent::__construct(User::class, $service);
    }
}
