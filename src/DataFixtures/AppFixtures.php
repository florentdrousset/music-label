<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Entity\User;
use App\Entity\Event;
use App\Entity\Product;
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
        $artists = [];
        for($i = 0 ; $i < 10; $i++)
        {
            $artist = new Artist();
            $artist->setName($faker->name);
            $artist->setCountry($faker->country);
            $artist->setGenre($faker->randomElement(array('Rock', 'Jazz', 'Soul', 'Ambient')));
            $artist->setDescription($faker->catchPhrase);
            $manager->persist($artist);
            $artists[] = $artist;
        }

        for ($i = 0; $i < 10; $i++)
        {
            $artist = $artists[mt_rand(0, count($artists) -1)];
            $product = new Productn();
            $product->setName($faker->name);
            $product->setDescription($faker->catchPhrase);
            $product->setProductionDate($faker->dateTimeBetween('-40 years'));
            $product->setArtist($artist);
        }
/*
        for($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setFirstName($faker->firstName);
            $user->setLastName($faker->lastName);
            $user->setRoles(['USER_ROLE']);
        }*/
        $manager->flush();
    }
}
