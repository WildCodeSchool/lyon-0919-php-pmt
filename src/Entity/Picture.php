<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PictureRepository")
 * @Vich\Uploadable
 */
class Picture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $name;

    /**
     * @Vich\UploadableField(mapping="gallery_images", fileNameProperty="name")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Trip", inversedBy="picture", cascade={"persist", "remove"})
     */
    private $trip;

    public function __toString(): string
    {
        return $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrip(): ?Trip
    {
        return $this->trip;
    }

    public function setTrip(?Trip $trip): self
    {
        $this->trip = $trip;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setImageFile(File $name = null)
    {
        $this->imageFile = $name;
        if ($name) {
            // if 'updatedAt' is not defined in your entity, use another property
//            $this->updatedAt = new DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }
}
