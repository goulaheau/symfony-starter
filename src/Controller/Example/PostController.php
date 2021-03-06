<?php

namespace App\Controller\Example;

use App\Entity\Example\Post;
use App\Service\Example\PostService;
use Goulaheau\RestBundle\Controller\RestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/example/post")
 */
class PostController extends RestController
{
    public function __construct(PostService $service)
    {
        parent::__construct(Post::class, $service);
    }
}
