<?php

namespace App\Entity;

use App\Repository\PathologyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PathologyRepository::class)]
class Pathology
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?PathologyType $pathologyType = null;

    #[ORM\ManyToOne(inversedBy: 'pathologies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Beast $beast = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPathologyType(): ?PathologyType
    {
        return $this->pathologyType;
    }

    public function setPathologyType(?PathologyType $pathologyType): self
    {
        $this->pathologyType = $pathologyType;

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
