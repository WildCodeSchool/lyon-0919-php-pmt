<?php


namespace App\DataFixtures;

use App\Entity\Office;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Self_;

class OfficeFixtures extends Fixture
{
    const OFFICES = [
        'Présidente',
        'VicePrésident',
        'Trésorier',
        'Trésorier Adjoint',
        'Secrétaire',
        'Secrétaire Adjoint',
        'Membres actifs'
    ];

    /**
     * Load data fixtures with the passed EntityManager
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach (self::OFFICES as $key => $name) {
            $office = new Office();
            $office->setName($name);
            $manager->persist($office);
            $this->addReference('office' .$key, $office);
        }
        $manager->flush();
    }
}
