<?php

namespace App\DataFixtures;

use App\Entity\Level;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LevelFixtures extends Fixture
{
    const LEVELS = [
        1 => 'N1',
        2 => 'PE40',
        3 => 'PA20',
        4 => 'N2',
        5 => 'N3',
        6 => 'N4(GP)',
        7 => 'E1(initiateur)',
        8 => 'E2',
        9 => 'E3(MF1)',
        10 => 'E4(MF2)'
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::LEVELS as $order => $name) {
            $level = new Level();
            $level->setName($name);
            $level->setOrderLevel($order);
            $manager->persist($level);
        }

        $manager->flush();
    }
}
