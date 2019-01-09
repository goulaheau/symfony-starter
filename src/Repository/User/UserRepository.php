<?php

namespace App\Repository\User;

use App\Entity\User\User;
use Goulaheau\RestBundle\Repository\RestRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends RestRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }
}
