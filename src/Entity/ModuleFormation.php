<?php

namespace App\Entity;

use App\Repository\ModuleFormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModuleFormationRepository::class)]
class ModuleFormation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'moduleFormations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Formation $formation = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?int $ordre = null;

    #[ORM\OneToMany(mappedBy: 'moduleFormation', targetEntity: ChapitreModuleFormation::class, orphanRemoval: true)]
    private Collection $chapitreModuleFormations;

    public function __construct()
    {
        $this->chapitreModuleFormations = new ArrayCollection();
    }

    // Retourne les chapitres d'un module d'une formation triés selon le champ de l'entité choisi
    public function getChapitresModuleFormationTries($champ = "ordre")
    {
        $criteria = Criteria::create()->orderBy([$champ => Criteria::ASC]);
        return $this->chapitreModuleFormations->matching($criteria);

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): static
    {
        $this->formation = $formation;

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

    /**
     * @return Collection<int, ChapitreModuleFormation>
     */
    public function getChapitreModuleFormations(): Collection
    {
        return $this->chapitreModuleFormations;
    }

    public function addChapitreModuleFormation(ChapitreModuleFormation $chapitreModuleFormation): static
    {
        if (!$this->chapitreModuleFormations->contains($chapitreModuleFormation)) {
            $this->chapitreModuleFormations->add($chapitreModuleFormation);
            $chapitreModuleFormation->setModuleFormation($this);
        }

        return $this;
    }

    public function removeChapitreModuleFormation(ChapitreModuleFormation $chapitreModuleFormation): static
    {
        if ($this->chapitreModuleFormations->removeElement($chapitreModuleFormation)) {
            // set the owning side to null (unless already changed)
            if ($chapitreModuleFormation->getModuleFormation() === $this) {
                $chapitreModuleFormation->setModuleFormation(null);
            }
        }

        return $this;
    }
}
