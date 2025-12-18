<?php

namespace App\Entity;

use App\Repository\ChapitreModuleFormationRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChapitreModuleFormationRepository::class)]
class ChapitreModuleFormation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'chapitreModuleFormations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ModuleFormation $moduleFormation = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?int $ordre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModuleFormation(): ?ModuleFormation
    {
        return $this->moduleFormation;
    }

    public function setModuleFormation(?ModuleFormation $moduleFormation): static
    {
        $this->moduleFormation = $moduleFormation;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): static
    {
        $this->ordre = $ordre;

        return $this;
    }
}
