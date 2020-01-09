<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use DateTime;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class PicturesFixtures extends Fixture
{
    private $webDirectory;
    private $imageLocation;

    public function __construct($webDirectory)
    {
        $this->webDirectory = $webDirectory;
        $this->imageLocation = $webDirectory . 'uploads/images/gallery/';
    }

    public function load(ObjectManager $manager)
    {
        $path = $this->imageLocation;
        $directory = new RecursiveDirectoryIterator($path);
        $iterator = new RecursiveIteratorIterator($directory);

        foreach ($iterator as $info) {
            $picture = new Picture();
            $picture->setName($info->getFileName());
            $picture->setUpdatedAt(new DateTime('now'));
            if ($info->getFileName() !== '.' && $info->getFileName() !== '..') {
                $manager->persist($picture);
            }
        }
        $manager->flush();
    }
}
