<?php

namespace App\Entity;

use phpDocumentor\Reflection\DocBlock\Tags\Property;
use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100,)
     * @Assert\Regex(
     *     pattern="/^[A-Za-z\é\è\ê\-]+/"
     * )
     */
    private $lastname;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min="10")
     *
     */
    private $message;


    /**
     * @var Property|null
     */
    private $property;

    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string|null $lastname
     * @return Contact
     */
    public function setLastname(?string $lastname): Contact
    {
        $this->lastname = $lastname;
        return $this;
    }


    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Contact
     */
    public function setEmail(?string $email): Contact
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     * @return Contact
     */
    public function setMessage(?string $message): Contact
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return Property|null
     */
    public function getProperty(): ?Property
    {
        return $this->property;
    }

    /**
     * @param Property|null $property
     * @return Contact
     */
    public function setProperty(?Property $property): Contact
    {
        $this->property = $property;
        return $this;
    }
}
