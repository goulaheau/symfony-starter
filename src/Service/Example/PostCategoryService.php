<?php

namespace App\Service\Example;

use App\Entity\Example\PostCategory;
use App\Repository\Example\PostCategoryRepository;
use Goulaheau\RestBundle\Service\RestService;

class PostCategoryService extends RestService
{
    public function __construct(PostCategoryRepository $repository)
    {
        parent::__construct(PostCategory::class, $repository);
    }
}
