<?php

namespace App\DataFixtures;

use App\Entity\Document;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class DocumentFixtures extends Fixture
{

    public const DOCUMENTS = [
        'Certificat médical',
        'Règlement intérieur',
        'Attestation de droit à l\'image'
    ];

    public function load(ObjectManager $manager)
    {

        foreach (self::DOCUMENTS as $documentName) {
            $document = new Document();
            $document->setName($documentName);
            $document->setPath('url du doc');
            $manager->persist($document);
        }

        $manager->flush();
    }
}
