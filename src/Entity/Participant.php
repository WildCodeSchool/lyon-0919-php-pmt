<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParticipantRepository")
 */
class Participant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbCompanion;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $registerOn;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="participants")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\InscriptionStatus", inversedBy="participant")
     */
    private $inscriptionStatus;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Payment", inversedBy="participant")
     */
    private $payment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trip", inversedBy="participant", cascade={"persist"})
     */
    private $trip;

    /**
     * Participant constructor.
     */
    public function __construct()
    {
        if ($this->getRegisterOn() === null) {
            $this->setRegisterOn(new DateTime('now'));
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getNbCompanion(): ?int
    {
        return $this->nbCompanion;
    }

    public function setNbCompanion(int $nbCompanion): self
    {
        $this->nbCompanion = $nbCompanion;

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

    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    public function setPayment(?Payment $payment): self
    {
        $this->payment = $payment;

        return $this;
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

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getRegisterOn(): ?\DateTimeInterface
    {
        return $this->registerOn;
    }

    public function setRegisterOn(\DateTimeInterface $registerOn): self
    {
        $this->registerOn = $registerOn;

        return $this;
    }
}
