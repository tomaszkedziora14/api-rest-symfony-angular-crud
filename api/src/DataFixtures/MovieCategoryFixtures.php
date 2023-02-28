<?php

namespace App\DataFixtures;

use App\Entity\MovieCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MovieCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $moveCategory1 = new MovieCategory();
        $moveCategory1->setName('S-f');
        $manager->persist($moveCategory1);

        $moveCategory2 = new MovieCategory();
        $moveCategory2->setName('Criminal');
        $manager->persist($moveCategory2);
        $manager->flush();

        $this->addReference('category_1', $moveCategory1);
        $this->addReference('category_2', $moveCategory2);

    }
}
