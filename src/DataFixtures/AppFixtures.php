<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    protected $faker;

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }



    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->faker = Factory::create('fr_FR');
        // 1 admin et plongeurs
        for ($i = 0; $i < 1; $i++) {
            $user = new User();
            $user->setFirstname($this->faker->firstName);
            $user->setLastname($this->faker->name);
            $user->setEmail('admin@admin.fr');
            $user->setPassword(
                $this->encoder->encodePassword($user, '0000')
            );
            $user->setRoles(['ROLE_ADMIN']);
            $user->setHomePhone($this->faker->phoneNumber);
            $user->setMobilePhone($this->faker->phoneNumber);
            $user->setBirthday($this->faker->dateTime);
            $user->setAddress($this->faker->streetAddress);
            $user->setZipCode($this->faker->numberBetween(10000, 60000));
            $user->setCity($this->faker->city);
            $user->setComment($this->faker->text(150));
            $user->setImageName($this->faker->imageUrl());
            $date = new DateTime('@' . strtotime('now'));
            $user->setCreatedAt($date);
            $user->setUpdateAt($date);
            $user->setIsAdmin(1);
            $user->setIsDiver(1);
            $this->addReference('adherent' . $i, $user);
            $manager->persist($user);
        }
        //5 moniteurs et plongeurs avec level
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setFirstname($this->faker->firstName);
            $user->setLastname($this->faker->name);
            $user->setEmail($this->faker->email);
            $user->setPassword(
                $this->encoder->encodePassword($user, '0000')
            );
            $user->setRoles(['ROLE_SUBSCRIBER']);
            $user->setHomePhone($this->faker->phoneNumber);
            $user->setMobilePhone($this->faker->phoneNumber);
            $user->setBirthday($this->faker->dateTime);
            $user->setAddress($this->faker->streetAddress);
            $user->setZipCode($this->faker->numberBetween(10000, 60000));
            $user->setCity($this->faker->city);
            $user->setComment($this->faker->text(150));
            $user->setImageName($this->faker->imageUrl());
            $date = new DateTime('@' . strtotime('now'));
            $user->setCreatedAt($date);
            $user->setUpdateAt($date);
            $user->setIsMonitor(1);
            $user->setIsDiver(1);
            $manager->persist($user);
            $user->setLevel($this->getReference('level' .random_int(1, 10)));
            $this->addReference('adherent' . ($i + 1), $user);
        }
        //10 plogneurs
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setFirstname($this->faker->firstName);
            $user->setLastname($this->faker->name);
            $user->setEmail($this->faker->email);
            $user->setPassword(
                $this->encoder->encodePassword($user, '0000')
            );
            $user->setRoles(['ROLE_SUBSCRIBER']);
            $user->setHomePhone($this->faker->phoneNumber);
            $user->setMobilePhone($this->faker->phoneNumber);
            $user->setBirthday($this->faker->dateTime);
            $user->setAddress($this->faker->streetAddress);
            $user->setZipCode($this->faker->numberBetween(10000, 60000));
            $user->setCity($this->faker->city);
            $user->setComment($this->faker->text(150));
            $user->setImageName($this->faker->imageUrl());
            $date = new DateTime('@' . strtotime('now'));
            $user->setCreatedAt($date);
            $user->setUpdateAt($date);
            $user->setIsDiver(1);
            $this->addReference('adherent' . ($i + 6), $user);
            $manager->persist($user);
        }
        //5 handisub et plaongues
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setFirstname($this->faker->firstName);
            $user->setLastname($this->faker->name);
            $user->setEmail($this->faker->email);
            $user->setPassword(
                $this->encoder->encodePassword($user, '0000')
            );
            $user->setRoles(['ROLE_SUBSCRIBER']);
            $user->setHomePhone($this->faker->phoneNumber);
            $user->setMobilePhone($this->faker->phoneNumber);
            $user->setBirthday($this->faker->dateTime);
            $user->setAddress($this->faker->streetAddress);
            $user->setZipCode($this->faker->numberBetween(10000, 60000));
            $user->setCity($this->faker->city);
            $user->setComment($this->faker->text(150));
            $user->setImageName($this->faker->imageUrl());
            $date = new DateTime('@' . strtotime('now'));
            $user->setCreatedAt($date);
            $user->setUpdateAt($date);
            $user->setIsDiver(1);
            $user->setIsHandi(1);
            $this->addReference('adherent' . ($i + 106), $user);
            $manager->persist($user);
        }
        //5 nageurs
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setFirstname($this->faker->firstName);
            $user->setLastname($this->faker->name);
            $user->setEmail($this->faker->email);
            $user->setPassword('123456');
            $user->setRoles(['ROLE_SUBSCRIBER']);
            $user->setHomePhone($this->faker->phoneNumber);
            $user->setMobilePhone($this->faker->phoneNumber);
            $user->setBirthday($this->faker->dateTime);
            $user->setAddress($this->faker->streetAddress);
            $user->setZipCode($this->faker->numberBetween(10000, 60000));
            $user->setCity($this->faker->city);
            $user->setComment($this->faker->text(150));
            $user->setImageName($this->faker->imageUrl());
            $date = new DateTime('@' . strtotime('now'));
            $user->setCreatedAt($date);
            $user->setUpdateAt($date);
            $user->setIsSwim(1);
            $this->addReference('adherent' . ($i + 111), $user);
            $manager->persist($user);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [LevelFixtures::class];
        // TODO: Implement getDependencies() method.
    }
}
