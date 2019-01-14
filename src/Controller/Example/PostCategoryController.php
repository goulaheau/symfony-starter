<?php

namespace App\Controller\Example;

use App\Entity\Example\PostCategory;
use App\Service\Example\PostCategoryService;
use Goulaheau\RestBundle\Controller\RestController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/example/post-category")
 */
class PostCategoryController extends RestController
{
    public function __construct(PostCategoryService $service)
    {
        parent::__construct(PostCategory::class, $service);
    }
}
