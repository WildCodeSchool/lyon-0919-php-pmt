<?php

namespace App\DataFixtures;

use App\Entity\Level;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LevelFixtures extends Fixture
{
    const LEVELS = [
        'Débutant',
        'N1',
        'PE40',
        'PA20',
        'N2',
        'N3',
        'N4(GP)',
        'E1(initiateur)',
        'E2',
        'E3(MF1)',
        'E4(MF2)'
    ];

    public function load(ObjectManager $manager)
    {
        $i = 1;
        foreach (self::LEVELS as $name) {
            $level = new Level();
            $level->setName($name);
            $manager->persist($level);
            $this->addReference('level' . $i, $level);
            $i++;
        }

        $manager->flush();
    }

//    public function getDependencies()
//    {
//        return [AppFixtures::class];
//        // TODO: Implement getDependencies() method.
//    }
}
