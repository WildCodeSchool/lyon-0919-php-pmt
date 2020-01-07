<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use DateTime;

class PicturesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 11; $i++) {
            $picture = new Picture();
            $picture->setName($faker->imageUrl(640, 480));
            $picture->setUpdatedAt(new DateTime('now'));
            $this->addReference('trip' . $i, $picture);

            $manager->persist($picture);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [TripFixtures::class];
    }
}
