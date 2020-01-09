<?php

namespace App\DataFixtures;

use App\Entity\Inscription;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class InscriptionFixtures extends Fixture implements DependentFixtureInterface
{
    protected $faker;

    public function load(ObjectManager $manager)
    {

        $this->faker = Factory::create('fr_FR');

        //165 adherents inscrits dans la base
        for ($i = 0; $i < 27; $i++) {
            $inscription = new Inscription();
            $inscription->setStatus($this->getReference('inscriptionStatus' .
                $this->faker->numberBetween(0, 2))->getId());
            $inscription->setInscriptionStatus($this->getReference('inscriptionStatus' .
                $this->faker->numberBetween(0, 2)));
            $inscription->setInternalProcedure('urlReglInterior');
            $inscription->setMedicalCertificate('urlMedical');
            $inscription->setInscriptionSheet('urlinscription');
            $date = new DateTime('@' . strtotime('now'));
            $inscription->setCreatedAt($date);
            $inscription->setUpdatedAt($date);
            $inscription->setInscriptionYear('2019-2020');
            $inscription->setImageRight($this->faker->numberBetween(0, 1));
            $inscription->setUser($this->getReference('adherent' . $i));
            $manager->persist($inscription);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [InscriptionStatusFixtures::class];
    }
}
