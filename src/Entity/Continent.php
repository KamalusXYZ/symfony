<?php

namespace App\Entity;

use App\Repository\ContinentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContinentRepository::class)]
class Continent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'continent', targetEntity: Country::class, orphanRemoval: true)]
    private $countriesList;

    public function __construct()
    {
        $this->countriesList = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function __toString()
    {
        return $this->name;
    }


    /**
     * @return Collection<int, Country>
     */
    public function getCountriesList(): Collection
    {
        return $this->countriesList;
    }

    public function addCountriesList(Country $countriesList): self
    {
        if (!$this->countriesList->contains($countriesList)) {
            $this->countriesList[] = $countriesList;
            $countriesList->setContinent($this);
        }

        return $this;
    }

    public function removeCountriesList(Country $countriesList): self
    {
        if ($this->countriesList->removeElement($countriesList)) {
            // set the owning side to null (unless already changed)
            if ($countriesList->getContinent() === $this) {
                $countriesList->setContinent(null);
            }
        }

        return $this;
    }
}
