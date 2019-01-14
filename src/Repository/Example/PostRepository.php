<?php

namespace App\Repository\Example;

use App\Entity\Example\Post;
use Goulaheau\RestBundle\Repository\RestRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class PostRepository extends RestRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Post::class);
    }
}
