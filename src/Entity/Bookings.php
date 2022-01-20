<?php

namespace App\Entity;

use App\Repository\BookingsRepository;
use DateTime;
use Date;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=BookingsRepository::class)
 */
class Bookings
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * 
     * @Assert\GreaterThan("today", message="La date de retrait doit être superieur à la date d'aujourd'hui")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     * 
     * @Assert\GreaterThanOrEqual(propertyPath="startDate", message="La date de retour doit être égal ou superieur à la date de retrait")
     */
    private $endDate;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="bookings")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Cars::class, inversedBy="bookings")
     */
    private $cars;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getUser(): ?users
    {
        return $this->user;
    }

    public function setUser(?users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCars(): ?Cars
    {
        return $this->cars;
    }

    public function setCars(?Cars $cars): self
    {
        $this->cars = $cars;

        return $this;
    }
    
    /**
     * Method bookingDays
     *  Permet de récuperer le nombre de jours d'une location 
     * @return void
     */
    public function bookingDays()
    {
        $diffdays = $this->startDate->diff($this->endDate);
        return $diffdays->days;
    }
}
