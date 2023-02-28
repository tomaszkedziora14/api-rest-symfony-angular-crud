<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movie = new Movie();
        $movie->setTitle('The Dark Knight');
        $movie->setMoveYear(2008);
        $movie->setDescription('This is the description of the Dark Knight');

        
        //Add Data To Pivot Table
        $movie->addActor($this->getReference('actor_1'));
        $movie->addActor($this->getReference('actor_2'));

        $movie->addMovieCategory($this->getReference('category_1'));
        $movie->addMovieCategory($this->getReference('category_2'));

        $manager->persist($movie);

        $movie2 = new Movie();
        $movie2->setTitle('Avengers: Endgame');
        $movie2->setMoveYear(2019);
        $movie2->setDescription('This is the description of Avengers: Endgame');

        //Add Data To Pivot Table
        $movie2->addActor($this->getReference('actor_3'));
        $movie2->addActor($this->getReference('actor_4'));

        $movie->addMovieCategory($this->getReference('category_2'));

        $manager->persist($movie2);

        $manager->flush();
    }
}
