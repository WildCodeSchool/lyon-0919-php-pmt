<?php

namespace App\DataFixtures;

use App\Entity\AdhesionPrice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AdhesionPriceFixtures extends Fixture
{
    const ADHESION = [
        'Plongeur TREVOUX' => 150,
        'Plongeur AUTRE' => 160,
        'PISCINE adulte' => 60,
        'PISCINE enfant' => 40,
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::ADHESION as $adhesion => $price) {
            $typeInsurance = new AdhesionPrice();
            $typeInsurance->setName($adhesion);
            $typeInsurance->setPrice($price);
            $manager->persist($typeInsurance);
        }
        $manager->flush();
    }
}
