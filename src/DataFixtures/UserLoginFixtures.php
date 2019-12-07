<?php

namespace App\DataFixtures;

use App\Entity\UserLogin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserLoginFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $userLogin = new UserLogin();
        $userLogin->setEmail('admin@admin.com');
        $userLogin->setPassword(
            $this->encoder->encodePassword($userLogin, '0000')
        );
        $manager->persist($userLogin);
        $manager->flush();
    }
}
