<?php

namespace App\Entity;

use App\Repository\BeastRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BeastRepository::class)]
class Beast
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'beasts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Race $race = null;

    #[ORM\ManyToOne(inversedBy: 'beasts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Company $company = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $chip = false;

    #[ORM\Column(length: 255)]
    private ?string $chipNumber = null;

    #[ORM\Column]
    private ?bool $tattoo = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $arrivalDate = null;

    #[ORM\Column(length: 255)]
    private ?string $arrivalReason = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $exitDate = null;

    #[ORM\Column(length: 255)]
    private ?string $exitReason = null;

    #[ORM\Column(length: 255)]
    private ?string $identification = null;

    #[ORM\OneToMany(mappedBy: 'beast', targetEntity: Pathology::class)]
    private Collection $pathologies;

    #[ORM\OneToMany(mappedBy: 'beast', targetEntity: Vaccin::class)]
    private Collection $vaccins;

    #[ORM\ManyToMany(targetEntity: HostFamily::class, mappedBy: 'beasts')]
    private Collection $hostFamilies;

    #[ORM\OneToMany(mappedBy: 'beast', targetEntity: MedicalAppointment::class)]
    private Collection $medicalAppointments;

    public function __construct()
    {
        $this->pathologies = new ArrayCollection();
        $this->vaccins = new ArrayCollection();
        $this->hostFamilies = new ArrayCollection();
        $this->medicalAppointments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRace(): ?Race
    {
        return $this->race;
    }

    public function setRace(?Race $race): self
    {
        $this->race = $race;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function hasChip(): bool
    {
        return $this->chip;
    }

    public function setHasChip(bool $chip): self
    {
        $this->chip = $chip;

        return $this;
    }

    public function getChipNumber(): ?string
    {
        return $this->chipNumber;
    }

    public function setChipNumber(string $chipNumber): self
    {
        $this->chipNumber = $chipNumber;

        return $this;
    }

    public function hasTatoo(): bool
    {
        return $this->tattoo;
    }

    public function setHasTattoo(bool $tattoo): self
    {
        $this->tattoo = $tattoo;

        return $this;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->arrivalDate;
    }

    public function setArrivalDate(\DateTimeInterface $arrivalDate): self
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    public function getArrivalReason(): ?string
    {
        return $this->arrivalReason;
    }

    public function setArrivalReason(string $arrivalReason): self
    {
        $this->arrivalReason = $arrivalReason;

        return $this;
    }

    public function getExitDate(): ?\DateTimeInterface
    {
        return $this->exitDate;
    }

    public function setExitDate(\DateTimeInterface $exitDate): self
    {
        $this->exitDate = $exitDate;

        return $this;
    }

    public function getExitReason(): ?string
    {
        return $this->exitReason;
    }

    public function setExitReason(string $exitReason): self
    {
        $this->exitReason = $exitReason;

        return $this;
    }

    public function getIdentification(): ?string
    {
        return $this->identification;
    }

    public function setIdentification(string $identification): self
    {
        $this->identification = $identification;

        return $this;
    }

    /**
     * @return Collection<int, Pathology>
     */
    public function getPathologies(): Collection
    {
        return $this->pathologies;
    }

    public function addPathology(Pathology $pathology): self
    {
        if (!$this->pathologies->contains($pathology)) {
            $this->pathologies->add($pathology);
            $pathology->setBeast($this);
        }

        return $this;
    }

    public function removePathology(Pathology $pathology): self
    {
        if ($this->pathologies->removeElement($pathology)) {
            // set the owning side to null (unless already changed)
            if ($pathology->getBeast() === $this) {
                $pathology->setBeast(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Vaccin>
     */
    public function getVaccins(): Collection
    {
        return $this->vaccins;
    }

    public function addVaccin(Vaccin $vaccin): self
    {
        if (!$this->vaccins->contains($vaccin)) {
            $this->vaccins->add($vaccin);
            $vaccin->setBeast($this);
        }

        return $this;
    }

    public function removeVaccin(Vaccin $vaccin): self
    {
        if ($this->vaccins->removeElement($vaccin)) {
            // set the owning side to null (unless already changed)
            if ($vaccin->getBeast() === $this) {
                $vaccin->setBeast(null);
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
            $hostFamily->addBeast($this);
        }

        return $this;
    }

    public function removeHostFamily(HostFamily $hostFamily): self
    {
        if ($this->hostFamilies->removeElement($hostFamily)) {
            $hostFamily->removeBeast($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, MedicalAppointment>
     */
    public function getMedicalAppointments(): Collection
    {
        return $this->medicalAppointments;
    }

    public function addMedicalAppointment(MedicalAppointment $medicalAppointment): self
    {
        if (!$this->medicalAppointments->contains($medicalAppointment)) {
            $this->medicalAppointments->add($medicalAppointment);
            $medicalAppointment->setBeast($this);
        }

        return $this;
    }

    public function removeMedicalAppointment(MedicalAppointment $medicalAppointment): self
    {
        if ($this->medicalAppointments->removeElement($medicalAppointment)) {
            // set the owning side to null (unless already changed)
            if ($medicalAppointment->getBeast() === $this) {
                $medicalAppointment->setBeast(null);
            }
        }

        return $this;
    }
}
