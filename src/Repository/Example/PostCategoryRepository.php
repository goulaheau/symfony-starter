<?php

namespace App\Repository\Example;

use App\Entity\Example\PostCategory;
use Goulaheau\RestBundle\Repository\RestRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class PostCategoryRepository extends RestRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PostCategory::class);
    }
}
