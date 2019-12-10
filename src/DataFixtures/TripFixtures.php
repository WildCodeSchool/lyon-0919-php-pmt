<?php

namespace App\DataFixtures;

use App\Entity\TypeTrip;
use App\Entity\Trip;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class TripFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $trip = new Trip();
            $type = new TypeTrip();
            $type->setName($faker->domainWord);
            $trip->setLocation($faker->country);
            $trip->setName($faker->city);
            $trip->setDescription($faker->text);
            $trip->setPrice($faker->randomNumber());
            $trip->setDateStart($faker->dateTimeThisYear);
            $trip->setDateEnd($faker->dateTimeThisYear);
            $trip->setCreatedAt($faker->dateTimeThisYear);
            $trip->setUpdatedAt($faker->dateTimeThisYear);
            $trip->setNbMonitor($faker->randomDigit);
            $trip->setNbDiver($faker->numberBetween(0, 35));
            $manager->persist($trip);
            $manager->persist($type);
        }
        $manager->flush();
    }
}
