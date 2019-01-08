<?php

namespace App\DataFixtures\Example;

use App\Entity\Example\Post;
use App\Entity\Example\PostCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PostFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; ++$i) {
            /** @var PostCategory $category */
            $category = $manager
                ->getRepository(PostCategory::class)
                ->findOneBy(['name' => 'Catégorie ' . round($i / 2)]);

            $post = (new Post())->setName('Article ' . $i)->setCategory($category);

            $manager->persist($post);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return [PostCategoryFixtures::class];
    }

    /**
     * @return array
     */
    public static function getGroups(): array
    {
        return ['example'];
    }
}
