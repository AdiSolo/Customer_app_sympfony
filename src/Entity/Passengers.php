<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PassengersRepository")
 */
class Passengers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $surname;

    /**
       *
       * @ORM\ManyToMany(targetEntity="App\Entity\Trips", mappedBy="trips", cascade={"remove", "persist"} )
       *
       */
    private $trips;


    /**
     * @ORM\Column(type="integer")
     */
    private $passport_id;

    public function __construct()
    {
        $this->trips = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }
    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getPassportId(): ?int
    {
        return $this->passport_id;
    }

    public function setPassportId(int $passport_id): self
    {
        $this->passport_id = $passport_id;

        return $this;
    }


    /**
     * @return Collection|Trips[]
     */
    public function getTrips(): Collection
    {
        return $this->trips;
    }

    public function addTrip(Trips $trip): self
    {
        if (!$this->trips->contains($trip)) {
            $this->trips[] = $trip;
            $trip->addTrip($this);
        }

        return $this;
    }

    public function removeTrip(Trips $trip): self
    {
        if ($this->trips->contains($trip)) {
            $this->trips->removeElement($trip);
            $trip->removeTrip($this);
        }

        return $this;
    }

    public function getOne()
    {
        return $this->getPass()->getFirstName();
    }

    public function __toString(){
        return $this->first_name.' '.$this->surname;
    }

}
