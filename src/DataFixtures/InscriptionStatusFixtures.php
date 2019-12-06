<?php

namespace App\DataFixtures;

use App\Entity\Document;
use App\Entity\InscriptionStatus;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class InscriptionStatusFixtures extends Fixture
{

    public const INSCRIPTIONSTATUS = [
        'Démarrage',
        'Documents réceptionnés',
        'Paiement en cours',
    ];

    public function load(ObjectManager $manager)
    {
        $i = 0;

        foreach (self::INSCRIPTIONSTATUS as $inscriptionName) {
            $inscriptionstatus = new InscriptionStatus();
            $inscriptionstatus->setName($inscriptionName);
            $this->addReference('inscriptionStatus' . $i, $inscriptionstatus);
            $i++;
            $manager->persist($inscriptionstatus);
        }

        $manager->flush();
    }
}
