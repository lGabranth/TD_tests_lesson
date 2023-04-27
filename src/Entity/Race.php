<?php

namespace App\Entity;

use App\Repository\RaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RaceRepository::class)]
class Race
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'races')]
    private ?Company $company = null;

    #[ORM\OneToMany(mappedBy: 'race', targetEntity: Beast::class)]
    private Collection $beasts;

    #[ORM\ManyToMany(targetEntity: HostFamily::class, mappedBy: 'speciesAccepted')]
    private Collection $hostFamilies;

    public function __construct()
    {
        $this->beasts = new ArrayCollection();
        $this->hostFamilies = new ArrayCollection();
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

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return Collection<int, Beast>
     */
    public function getBeasts(): Collection
    {
        return $this->beasts;
    }

    public function addBeast(Beast $beast): self
    {
        if (!$this->beasts->contains($beast)) {
            $this->beasts->add($beast);
            $beast->setRace($this);
        }

        return $this;
    }

    public function removeBeast(Beast $beast): self
    {
        if ($this->beasts->removeElement($beast)) {
            // set the owning side to null (unless already changed)
            if ($beast->getRace() === $this) {
                $beast->setRace(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, HostFamily>
     */
    public function getHostFamilies(): Collection
    {
        return $this->hostFamilies;
    }

    public function addHostFamily(HostFamily $hostFamily): self
    {
        if (!$this->hostFamilies->contains($hostFamily)) {
            $this->hostFamilies->add($hostFamily);
            $hostFamily->addSpeciesAccepted($this);
        }

        return $this;
    }

    public function removeHostFamily(HostFamily $hostFamily): self
    {
        if ($this->hostFamilies->removeElement($hostFamily)) {
            $hostFamily->removeSpeciesAccepted($this);
        }

        return $this;
    }
}
