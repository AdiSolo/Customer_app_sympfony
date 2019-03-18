<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TripsRepository")
 */
class Trips
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $fly_from;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $fly_to;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $depart_time;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $arrival_time;

    /**
    *
    *  @ORM\ManyToMany(targetEntity="App\Entity\Passengers", inversedBy="pass" )
    * @ORM\JoinTable(name="passenger_trips")
    */

    private $pass;

    public function __construct()
    {
        $this->trips = new ArrayCollection();
        $this->pass = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFlyFrom(): ?string
    {
        return $this->fly_from;
    }

    public function setFlyFrom(string $fly_from): self
    {
        $this->fly_from = $fly_from;

        return $this;
    }

    public function getFlyTo(): ?string
    {
        return $this->fly_to;
    }

    public function setFlyTo(string $fly_to): self
    {
        $this->fly_to = $fly_to;

        return $this;
    }

    public function getDepartTime(): ?string
    {
        return $this->depart_time;
    }

    public function setDepartTime(string $depart_time): self
    {
        $this->depart_time = $depart_time;

        return $this;
    }

    public function getArrivalTime(): ?string
    {
        return $this->arrival_time;
    }

    public function setArrivalTime(string $arrival_time): self
    {
        $this->arrival_time = $arrival_time;

        return $this;
    }


    /**
     * @return Collection|Passengers[]
     */
    public function getPass(): Collection
    {
        return $this->pass;
    }

    public function addPass(Passengers $pass): self
    {
        if (!$this->pass->contains($pass)) {
            $this->pass[] = $pass;
        }

        return $this;
    }

    public function removePass(Passengers $pass): self
    {
        if ($this->pass->contains($pass)) {
            $this->pass->removeElement($pass);
        }

        return $this;
    }

    public function toString(){
        return $this->surname;
    }
}
