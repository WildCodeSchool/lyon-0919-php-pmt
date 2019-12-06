<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $internalProcedure;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $medicalCertificate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $inscriptionSheet;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $inscriptionYear;

    /**
     * @ORM\Column(type="boolean")
     */
    private $imageRight;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="inscription")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\InscriptionStatus", inversedBy="inscription")
     */
    private $inscriptionStatus;

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
}