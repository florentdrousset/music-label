<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Faker\Factory::create();
        for($i = 0 ; $i < 10; $i++)
        {
            $artist = new Artist();
            $artist->setName($faker->name);
            $artist->setCountry($faker->country);
            $artist->setGenre($faker->jobTitle);
            $artist->setDescription($faker->catchPhrase);
            $manager->persist($artist);
        }

        $manager->flush();
    }
}
