<?php

namespace App\DataFixtures;

use App\Entity\Insurance;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class InsuranceFixtures extends Fixture
{
    const INSURANCE = [
        'Loisir 1' => 0,
        'Loisir 2' => 11.05,
        'Loisir 3' => 34.20,
        'Piscine' => 0,
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::INSURANCE as $insurance => $price) {
            $typeInsurance = new Insurance();
            $typeInsurance->setName($insurance);
            $typeInsurance->setPrice($price);
            $manager->persist($typeInsurance);
        }
        $manager->flush();
    }
}
