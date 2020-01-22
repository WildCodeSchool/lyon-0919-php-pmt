<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TripRepository")
 * @Vich\Uploadable
 */
class Trip
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateStart;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbDiver;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbMonitor;

    /**
     * @var \DateTime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime $updatedAt
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateEnd;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeTrip", inversedBy="trip")
     */
    private $typeTrip;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $imageName = "";

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="imageName")
     * @var file
     */
    private $imageFile;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Participant", mappedBy="trip", cascade={"persist", "remove"})
     */
    private $participant;

    /**
     * @return string
     */
    public function __toString(): ?string
    {
        return strval($this->getName());
    }

    public function getNbParticipant()
    {
        return count($this->participant);
    }

    public function getNbPending()
    {
        $nbPending = 0;
        $size = $this->getNbParticipant();
        for ($i = 0; $i < $size; $i++) {
            if ($this->participant[$i]->getStatus() === "En liste d'attente") {
                $nbPending += 1;
            }
        }
        return $nbPending;
    }

    public function __construct()
    {
        $this->participant = new ArrayCollection();
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new DateTime('now'));
            $this->setUpdatedAt(new DateTime('now'));
        } else {
//            gestion de la update Date quand on update un trip
            $this->setUpdatedAt(new DateTime('now'));
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTime $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getNbDiver(): ?int
    {
        return $this->nbDiver;
    }

    public function setNbDiver(int $nbDiver): self
    {
        $this->nbDiver = $nbDiver;

        return $this;
    }

    public function getNbMonitor(): ?int
    {
        return $this->nbMonitor;
    }

    public function setNbMonitor(int $nbMonitor): self
    {
        $this->nbMonitor = $nbMonitor;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

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

    public function getTypeTrip(): ?TypeTrip
    {
        return $this->typeTrip;
    }

    public function setTypeTrip(?TypeTrip $typeTrip): self
    {
        $this->typeTrip = $typeTrip;

        return $this;
    }

    /**
     * @return Collection|Participant[]
     */
    public function getParticipant(): Collection
    {
        return $this->participant;
    }

    public function addParticipant(Participant $participant): self
    {
        if (!$this->participant->contains($participant)) {
            $this->participant[] = $participant;
            $participant->setTrip($this);
        }

        return $this;
    }

    public function removeParticipant(Participant $participant): self
    {
        if ($this->participant->contains($participant)) {
            $this->participant->removeElement($participant);
            // set the owning side to null (unless already changed)
            if ($participant->getTrip() === $this) {
                $participant->setTrip(null);
            }
        }

        return $this;
    }

    /**
     * @param File|UploadedFile $imageFile
     * @throws Exception
     */
    public function setImageFile(?File $imageFile = null): void
    {

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->imageFile = $imageFile;
            $this->updatedAt = new DateTime('now');
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        if (null !== $imageName) {
            $this->imageName = $imageName;
        }
        return $this;
    }
}
