<?php

namespace App\Entity;

use App\Repository\MedicalAppointmentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedicalAppointmentRepository::class)]
class MedicalAppointment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'medicalAppointments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Company $company = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $appenedOn = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $reason = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $diagnostic = null;

    #[ORM\Column(length: 255)]
    private ?string $doctorName = null;

    #[ORM\ManyToOne(inversedBy: 'medicalAppointments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Beast $beast = null;

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

    public function getAppenedOn(): ?\DateTimeInterface
    {
        return $this->appenedOn;
    }

    public function setAppenedOn(\DateTimeInterface $appenedOn): self
    {
        $this->appenedOn = $appenedOn;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function getDiagnostic(): ?string
    {
        return $this->diagnostic;
    }

    public function setDiagnostic(string $diagnostic): self
    {
        $this->diagnostic = $diagnostic;

        return $this;
    }

    public function getDoctorName(): ?string
    {
        return $this->doctorName;
    }

    public function setDoctorName(string $doctorName): self
    {
        $this->doctorName = $doctorName;

        return $this;
    }

    public function getBeast(): ?Beast
    {
        return $this->beast;
    }

    public function setBeast(?Beast $beast): self
    {
        $this->beast = $beast;

        return $this;
    }
}
