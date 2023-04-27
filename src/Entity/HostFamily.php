<?php

namespace App\Entity;

use App\Repository\HostFamilyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HostFamilyRepository::class)]
class HostFamily
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'hostFamily')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Company $company = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $zipcode = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $hostingCapacity = null;

    #[ORM\Column]
    private bool $truthworthy = true;

    #[ORM\ManyToMany(targetEntity: Race::class, inversedBy: 'hostFamilies')]
    private Collection $speciesAccepted;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[ORM\Column]
    private ?int $petsQuantity = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $hostingConditions = null;

    #[ORM\Column]
    private ?bool $isolationPossible = false;

    #[ORM\Column]
    private ?bool $vehicle = null;

    #[ORM\Column(length: 255)]
    private ?string $maxRange = null;

    #[ORM\Column(length: 255)]
    private ?string $accomodationType = null;

    #[ORM\Column]
    private ?bool $children = null;

    public function __construct()
    {
        $this->speciesAccepted = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getHostingCapacity(): ?string
    {
        return $this->hostingCapacity;
    }

    public function setHostingCapacity(string $hostingCapacity): self
    {
        $this->hostingCapacity = $hostingCapacity;

        return $this;
    }

    public function isTruthworthy(): bool
    {
        return $this->truthworthy;
    }

    public function setIsTruthworthy(bool $truthworthy): self
    {
        $this->truthworthy = $truthworthy;

        return $this;
    }

    /**
     * @return Collection<int, Race>
     */
    public function getSpeciesAccepted(): Collection
    {
        return $this->speciesAccepted;
    }

    public function addSpeciesAccepted(Race $speciesAccepted): self
    {
        if (!$this->speciesAccepted->contains($speciesAccepted)) {
            $this->speciesAccepted->add($speciesAccepted);
        }

        return $this;
    }

    public function removeSpeciesAccepted(Race $speciesAccepted): self
    {
        $this->speciesAccepted->removeElement($speciesAccepted);

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

    public function getPetsQuantity(): ?int
    {
        return $this->petsQuantity;
    }

    public function setPetsQuantity(int $petsQuantity): self
    {
        $this->petsQuantity = $petsQuantity;

        return $this;
    }

    public function getHostingConditions(): ?string
    {
        return $this->hostingConditions;
    }

    public function setHostingConditions(string $hostingConditions): self
    {
        $this->hostingConditions = $hostingConditions;

        return $this;
    }

    public function isIsolationPossible(): bool
    {
        return $this->isolationPossible;
    }

    public function setIsIsolationPossible(bool $isolationPossible): self
    {
        $this->isolationPossible = $isolationPossible;

        return $this;
    }

    public function hasVehicle(): bool
    {
        return $this->vehicle;
    }

    public function setHasVehicle(bool $vehicle): self
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    public function getMaxRange(): ?string
    {
        return $this->maxRange;
    }

    public function setMaxRange(string $maxRange): self
    {
        $this->maxRange = $maxRange;

        return $this;
    }

    public function getAccomodationType(): ?string
    {
        return $this->accomodationType;
    }

    public function setAccomodationType(string $accomodationType): self
    {
        $this->accomodationType = $accomodationType;

        return $this;
    }

    public function hasChildren(): bool
    {
        return $this->children;
    }

    public function setHasChildren(bool $children): self
    {
        $this->children = $children;

        return $this;
    }
}
