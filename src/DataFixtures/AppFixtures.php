<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    protected $faker;

    public function load(ObjectManager $manager)
    {

        $this->manager = $manager;
        $this->faker = Factory::create('fr_FR');

        // 5 admin et plongeurs
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setFirstname($this->faker->firstName);
            $user->setLastname($this->faker->name);
            $user->setMail($this->faker->email);
            $user->setHomePhone($this->faker->phoneNumber);
            $user->setMobilePhone($this->faker->phoneNumber);
            $user->setBirthday($this->faker->dateTime);
            $user->setAddress($this->faker->streetAddress);
            $user->setZipCode($this->faker->numberBetween(10000, 60000));
            $user->setCity($this->faker->city);
            $user->setComment($this->faker->text(150));
            $user->setPicture($this->faker->imageUrl());
            $date = new \DateTime('@' . strtotime('now'));
            $user->setCreatedAt($date);
            $user->setUpdateAt($date);
            $user->setIsAdmin(1);
            $user->setIsDiver(1);
            $this->addReference('adherent' . $i, $user);
            $manager->persist($user);
        }

        //5 moniteurs et plongeurs
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setFirstname($this->faker->firstName);
            $user->setLastname($this->faker->name);
            $user->setMail($this->faker->email);
            $user->setHomePhone($this->faker->phoneNumber);
            $user->setMobilePhone($this->faker->phoneNumber);
            $user->setBirthday($this->faker->dateTime);
            $user->setAddress($this->faker->streetAddress);
            $user->setZipCode($this->faker->numberBetween(10000, 60000));
            $user->setCity($this->faker->city);
            $user->setComment($this->faker->text(150));
            $user->setPicture($this->faker->imageUrl());
            $date = new \DateTime('@' . strtotime('now'));
            $user->setCreatedAt($date);
            $user->setUpdateAt($date);
            $user->setIsMonitor(1);
            $user->setIsDiver(1);
            $this->addReference('adherent' . ($i + 5), $user);
            $manager->persist($user);
        }

        //100 plogneurs
        for ($i = 0; $i < 100; $i++) {
            $user = new User();
            $user->setFirstname($this->faker->firstName);
            $user->setLastname($this->faker->name);
            $user->setMail($this->faker->email);
            $user->setHomePhone($this->faker->phoneNumber);
            $user->setMobilePhone($this->faker->phoneNumber);
            $user->setBirthday($this->faker->dateTime);
            $user->setAddress($this->faker->streetAddress);
            $user->setZipCode($this->faker->numberBetween(10000, 60000));
            $user->setCity($this->faker->city);
            $user->setComment($this->faker->text(150));
            $user->setPicture($this->faker->imageUrl());
            $date = new \DateTime('@' . strtotime('now'));
            $user->setCreatedAt($date);
            $user->setUpdateAt($date);
            $user->setIsDiver(1);
            $this->addReference('adherent' . ($i + 10), $user);
            $manager->persist($user);
        }

        //5 handisub et plaongues
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setFirstname($this->faker->firstName);
            $user->setLastname($this->faker->name);
            $user->setMail($this->faker->email);
            $user->setHomePhone($this->faker->phoneNumber);
            $user->setMobilePhone($this->faker->phoneNumber);
            $user->setBirthday($this->faker->dateTime);
            $user->setAddress($this->faker->streetAddress);
            $user->setZipCode($this->faker->numberBetween(10000, 60000));
            $user->setCity($this->faker->city);
            $user->setComment($this->faker->text(150));
            $user->setPicture($this->faker->imageUrl());
            $date = new \DateTime('@' . strtotime('now'));
            $user->setCreatedAt($date);
            $user->setUpdateAt($date);
            $user->setIsDiver(1);
            $user->setIsHandi(1);
            $this->addReference('adherent' . ($i + 110), $user);
            $manager->persist($user);
        }

        //50 nageurs
        for ($i = 0; $i < 50; $i++) {
            $user = new User();
            $user->setFirstname($this->faker->firstName);
            $user->setLastname($this->faker->name);
            $user->setMail($this->faker->email);
            $user->setHomePhone($this->faker->phoneNumber);
            $user->setMobilePhone($this->faker->phoneNumber);
            $user->setBirthday($this->faker->dateTime);
            $user->setAddress($this->faker->streetAddress);
            $user->setZipCode($this->faker->numberBetween(10000, 60000));
            $user->setCity($this->faker->city);
            $user->setComment($this->faker->text(150));
            $user->setPicture($this->faker->imageUrl());
            $date = new \DateTime('@' . strtotime('now'));
            $user->setCreatedAt($date);
            $user->setUpdateAt($date);
            $user->setIsSwim(1);
            $this->addReference('adherent' . ($i + 115), $user);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
