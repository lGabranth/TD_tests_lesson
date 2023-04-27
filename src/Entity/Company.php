<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $img = null;

    #[ORM\Column(length: 255)]
    private ?string $color = null;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: User::class)]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: Race::class)]
    private Collection $races;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: Beast::class)]
    private Collection $beasts;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: PathologyType::class)]
    private Collection $pathologyTypes;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: HostFamily::class)]
    private Collection $hostFamily;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: MedicalAppointment::class)]
    private Collection $medicalAppointments;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->races = new ArrayCollection();
        $this->beasts = new ArrayCollection();
        $this->pathologyTypes = new ArrayCollection();
        $this->hostFamily = new ArrayCollection();
        $this->medicalAppointments = new ArrayCollection();
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

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setCompany($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCompany() === $this) {
                $user->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Race>
     */
    public function getRaces(): Collection
    {
        return $this->races;
    }

    public function addRace(Race $race): self
    {
        if (!$this->races->contains($race)) {
            $this->races->add($race);
            $race->setCompany($this);
        }

        return $this;
    }

    public function removeRace(Race $race): self
    {
        if ($this->races->removeElement($race)) {
            // set the owning side to null (unless already changed)
            if ($race->getCompany() === $this) {
                $race->setCompany(null);
            }
        }

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
            $beast->setCompany($this);
        }

        return $this;
    }

    public function removeBeast(Beast $beast): self
    {
        if ($this->beasts->removeElement($beast)) {
            // set the owning side to null (unless already changed)
            if ($beast->getCompany() === $this) {
                $beast->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PathologyType>
     */
    public function getPathologyTypes(): Collection
    {
        return $this->pathologyTypes;
    }

    public function addPathologyType(PathologyType $pathologyType): self
    {
        if (!$this->pathologyTypes->contains($pathologyType)) {
            $this->pathologyTypes->add($pathologyType);
            $pathologyType->setCompany($this);
        }

        return $this;
    }

    public function removePathologyType(PathologyType $pathologyType): self
    {
        if ($this->pathologyTypes->removeElement($pathologyType)) {
            // set the owning side to null (unless already changed)
            if ($pathologyType->getCompany() === $this) {
                $pathologyType->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, HostFamily>
     */
    public function getHostFamily(): Collection
    {
        return $this->hostFamily;
    }

    public function addHostFamily(HostFamily $hostFamily): self
    {
        if (!$this->hostFamily->contains($hostFamily)) {
            $this->hostFamily->add($hostFamily);
            $hostFamily->setCompany($this);
        }

        return $this;
    }

    public function removeHostFamily(HostFamily $hostFamily): self
    {
        if ($this->hostFamily->removeElement($hostFamily)) {
            // set the owning side to null (unless already changed)
            if ($hostFamily->getCompany() === $this) {
                $hostFamily->setCompany(null);
            }
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
            $medicalAppointment->setCompany($this);
        }

        return $this;
    }

    public function removeMedicalAppointment(MedicalAppointment $medicalAppointment): self
    {
        if ($this->medicalAppointments->removeElement($medicalAppointment)) {
            // set the owning side to null (unless already changed)
            if ($medicalAppointment->getCompany() === $this) {
                $medicalAppointment->setCompany(null);
            }
        }

        return $this;
    }
}
