<?php

namespace App\Entity;

use App\Repository\DomaineFormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DomaineFormationRepository::class)]
class DomaineFormation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(targetEntity: ThematiqueFormation::class, mappedBy: 'domaine')]
    private Collection $thematiqueFormations;

    #[ORM\Column(length: 10)]
    private ?string $couleur = null;

    #[ORM\Column(length: 20)]
    private ?string $slug = null;

    public function __construct()
    {
        $this->thematiqueFormations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, ThematiqueFormation>
     */
    public function getThematiqueFormations(): Collection
    {
        return $this->thematiqueFormations;
    }

    public function addThematiqueFormation(ThematiqueFormation $thematiqueFormation): static
    {
        if (!$this->thematiqueFormations->contains($thematiqueFormation)) {
            $this->thematiqueFormations->add($thematiqueFormation);
            $thematiqueFormation->setDomaine($this);
        }

        return $this;
    }

    public function removeThematiqueFormation(ThematiqueFormation $thematiqueFormation): static
    {
        if ($this->thematiqueFormations->removeElement($thematiqueFormation)) {
            // set the owning side to null (unless already changed)
            if ($thematiqueFormation->getDomaine() === $this) {
                $thematiqueFormation->setDomaine(null);
            }
        }

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): static
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}
