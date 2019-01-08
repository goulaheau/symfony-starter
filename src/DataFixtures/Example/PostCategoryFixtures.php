<?php

namespace App\DataFixtures\Example;

use App\Entity\Example\PostCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PostCategoryFixtures extends Fixture implements FixtureGroupInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 5; ++$i) {
            $postCategory = (new PostCategory())->setName('Catégorie ' . $i);

            $manager->persist($postCategory);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    public static function getGroups(): array
    {
        return ['example'];
    }
}
