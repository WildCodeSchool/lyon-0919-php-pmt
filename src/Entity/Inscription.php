<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InscriptionRepository")
 */
class Inscription
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $internalProcedure;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $medicalCertificate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $inscriptionSheet;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=12, nullable=true)
     */
    private $inscriptionYear;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $imageRight;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="inscriptions",  cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\InscriptionStatus", inversedBy="inscription")
     */
    private $inscriptionStatus;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Insurance", inversedBy="inscription")
     */
    private $insurance;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AdhesionPrice", inversedBy="inscription")
     */
    private $adhesionPrice;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getstatus();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getInternalProcedure(): ?string
    {
        return $this->internalProcedure;
    }

    public function setInternalProcedure(string $internalProcedure): self
    {
        $this->internalProcedure = $internalProcedure;

        return $this;
    }

    public function getMedicalCertificate(): ?string
    {
        return $this->medicalCertificate;
    }

    public function setMedicalCertificate(string $medicalCertificate): self
    {
        $this->medicalCertificate = $medicalCertificate;

        return $this;
    }

    public function getInscriptionSheet(): ?string
    {
        return $this->inscriptionSheet;
    }

    public function setInscriptionSheet(string $inscriptionSheet): self
    {
        $this->inscriptionSheet = $inscriptionSheet;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getInscriptionYear(): ?string
    {
        return $this->inscriptionYear;
    }

    public function setInscriptionYear(string $inscriptionYear): self
    {
        $this->inscriptionYear = $inscriptionYear;

        return $this;
    }

    public function getImageRight(): ?bool
    {
        return $this->imageRight;
    }

    public function setImageRight(bool $imageRight): self
    {
        $this->imageRight = $imageRight;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getInscriptionStatus(): ?InscriptionStatus
    {
        return $this->inscriptionStatus;
    }

    public function setInscriptionStatus(?InscriptionStatus $inscriptionStatus): self
    {
        $this->inscriptionStatus = $inscriptionStatus;

        return $this;
    }

    public function getInsurance(): ?Insurance
    {
        return $this->insurance;
    }

    public function setInsurance(?Insurance $insurance): self
    {
        $this->insurance = $insurance;

        return $this;
    }

    public function getAdhesionPrice(): ?AdhesionPrice
    {
        return $this->adhesionPrice;
    }

    public function setAdhesionPrice(?AdhesionPrice $adhesionPrice): self
    {
        $this->adhesionPrice = $adhesionPrice;

        return $this;
    }
}
