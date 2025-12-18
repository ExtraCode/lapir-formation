<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'formations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ThematiqueFormation $thematique = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 10)]
    private ?string $reference = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $courteDescription = null;


    #[ORM\ManyToOne(inversedBy: 'formations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?NiveauFormation $niveau = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $eligibleCpf = false;

    #[ORM\OneToMany(mappedBy: 'formation', targetEntity: AvisFormation::class, orphanRemoval: true)]
    private Collection $avisFormations;

    #[ORM\OneToMany(mappedBy: 'formation', targetEntity: ObjectifFormation::class, orphanRemoval: true)]
    private Collection $objectifFormations;

    #[ORM\OneToMany(mappedBy: 'formation', targetEntity: PublicFormation::class, orphanRemoval: true)]
    private Collection $publicFormation;

    #[ORM\OneToMany(mappedBy: 'formation', targetEntity: PrerequisFormation::class, orphanRemoval: true)]
    private Collection $prerequisFormations;

    #[ORM\OneToMany(mappedBy: 'formation', targetEntity: ModuleFormation::class, orphanRemoval: true)]
    private Collection $moduleFormations;

    #[ORM\OneToMany(mappedBy: 'formation', targetEntity: InscriptionInterFormation::class)]
    private Collection $inscriptionInterFormations;

    #[ORM\Column(nullable: true)]
    private ?int $prixInter = null;

    #[ORM\Column(nullable: true)]
    private ?int $prixIntra = null;

    #[ORM\Column]
    private ?int $nbApprenant = null;

    #[ORM\Column]
    private ?bool $auTop = false;

    #[ORM\Column]
    private ?float $nbJour = null;

    #[ORM\Column(length: 100, unique: true)]
    private ?string $slug = null;

    public function __construct()
    {
        $this->avisFormations = new ArrayCollection();
        $this->objectifFormations = new ArrayCollection();
        $this->publicFormation = new ArrayCollection();
        $this->prerequisFormations = new ArrayCollection();
        $this->moduleFormations = new ArrayCollection();
        $this->inscriptionInterFormations = new ArrayCollection();
    }

    // Retourne les modules d'une formation triés selon le champ de l'entité choisi
    public function getModulesFormationTries($champ = "ordre")
    {
        $criteria = Criteria::create()->orderBy([$champ => Criteria::ASC]);
        return $this->moduleFormations->matching($criteria);

    }

    // Retourne les publics d'une formation triés selon le champ de l'entité choisi
    public function getPublicFormationTries($champ = "ordre")
    {
        $criteria = Criteria::create()->orderBy([$champ => Criteria::ASC]);
        return $this->publicFormation->matching($criteria);

    }

    // Retourne les prérequis d'une formation triés selon le champ de l'entité choisi
    public function getPrerequisFormationTries($champ = "ordre")
    {
        $criteria = Criteria::create()->orderBy([$champ => Criteria::ASC]);
        return $this->prerequisFormations->matching($criteria);

    }

    // Retourne les objectifs d'une formation triés selon le champ de l'entité choisi
    public function getObjectifsFormationTries($champ = "ordre")
    {
        $criteria = Criteria::create()->orderBy([$champ => Criteria::ASC]);
        return $this->objectifFormations->matching($criteria);

    }

    // Retourne la moyenne des avis d'une formation
    public function getMoyenneAvis()
    {
        $moyenne = 0;
        foreach ($this->avisFormations as $avisFormation) {

            $moyenne += $avisFormation->getNote();

        }

        return round($moyenne / count($this->avisFormations), 2);

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getThematique(): ?ThematiqueFormation
    {
        return $this->thematique;
    }

    public function setThematique(?ThematiqueFormation $thematique): static
    {
        $this->thematique = $thematique;

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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getCourteDescription(): ?string
    {
        return $this->courteDescription;
    }

    public function setCourteDescription(string $courteDescription): static
    {
        $this->courteDescription = $courteDescription;

        return $this;
    }

    public function getNiveau(): ?NiveauFormation
    {
        return $this->niveau;
    }

    public function setNiveau(?NiveauFormation $niveau): static
    {
        $this->niveau = $niveau;

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

    public function isEligibleCpf(): ?bool
    {
        return $this->eligibleCpf;
    }

    public function setEligibleCpf(bool $eligibleCpf): static
    {
        $this->eligibleCpf = $eligibleCpf;

        return $this;
    }


    /**
     * @return Collection<int, AvisFormation>
     */
    public function getAvisFormations(): Collection
    {
        return $this->avisFormations;
    }

    public function addAvisFormation(AvisFormation $avisFormation): static
    {
        if (!$this->avisFormations->contains($avisFormation)) {
            $this->avisFormations->add($avisFormation);
            $avisFormation->setFormation($this);
        }

        return $this;
    }

    public function removeAvisFormation(AvisFormation $avisFormation): static
    {
        if ($this->avisFormations->removeElement($avisFormation)) {
            // set the owning side to null (unless already changed)
            if ($avisFormation->getFormation() === $this) {
                $avisFormation->setFormation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ObjectifFormation>
     */
    public function getObjectifFormations(): Collection
    {
        return $this->objectifFormations;
    }

    public function addObjectifFormation(ObjectifFormation $objectifFormation): static
    {
        if (!$this->objectifFormations->contains($objectifFormation)) {
            $this->objectifFormations->add($objectifFormation);
            $objectifFormation->setFormation($this);
        }

        return $this;
    }

    public function removeObjectifFormation(ObjectifFormation $objectifFormation): static
    {
        if ($this->objectifFormations->removeElement($objectifFormation)) {
            // set the owning side to null (unless already changed)
            if ($objectifFormation->getFormation() === $this) {
                $objectifFormation->setFormation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PublicFormation>
     */
    public function getPublicFormation(): Collection
    {
        return $this->publicFormation;
    }

    public function addPublicFormation(PublicFormation $publicFormation): static
    {
        if (!$this->publicFormation->contains($publicFormation)) {
            $this->publicFormation->add($publicFormation);
            $publicFormation->setFormation($this);
        }

        return $this;
    }

    public function removePublicFormation(PublicFormation $publicFormation): static
    {
        if ($this->publicFormation->removeElement($publicFormation)) {
            // set the owning side to null (unless already changed)
            if ($publicFormation->getFormation() === $this) {
                $publicFormation->setFormation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PrerequisFormation>
     */
    public function getPrerequisFormations(): Collection
    {
        return $this->prerequisFormations;
    }

    public function addPrerequisFormation(PrerequisFormation $prerequisFormation): static
    {
        if (!$this->prerequisFormations->contains($prerequisFormation)) {
            $this->prerequisFormations->add($prerequisFormation);
            $prerequisFormation->setFormation($this);
        }

        return $this;
    }

    public function removePrerequisFormation(PrerequisFormation $prerequisFormation): static
    {
        if ($this->prerequisFormations->removeElement($prerequisFormation)) {
            // set the owning side to null (unless already changed)
            if ($prerequisFormation->getFormation() === $this) {
                $prerequisFormation->setFormation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ModuleFormation>
     */
    public function getModuleFormations(): Collection
    {
        return $this->moduleFormations;
    }

    public function addModuleFormation(ModuleFormation $moduleFormation): static
    {
        if (!$this->moduleFormations->contains($moduleFormation)) {
            $this->moduleFormations->add($moduleFormation);
            $moduleFormation->setFormation($this);
        }

        return $this;
    }

    public function removeModuleFormation(ModuleFormation $moduleFormation): static
    {
        if ($this->moduleFormations->removeElement($moduleFormation)) {
            // set the owning side to null (unless already changed)
            if ($moduleFormation->getFormation() === $this) {
                $moduleFormation->setFormation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InscriptionInterFormation>
     */
    public function getInscriptionInterFormations(): Collection
    {
        return $this->inscriptionInterFormations;
    }

    public function addInscriptionInterFormation(InscriptionInterFormation $inscriptionInterFormation): static
    {
        if (!$this->inscriptionInterFormations->contains($inscriptionInterFormation)) {
            $this->inscriptionInterFormations->add($inscriptionInterFormation);
            $inscriptionInterFormation->setFormation($this);
        }

        return $this;
    }

    public function removeInscriptionInterFormation(InscriptionInterFormation $inscriptionInterFormation): static
    {
        if ($this->inscriptionInterFormations->removeElement($inscriptionInterFormation)) {
            // set the owning side to null (unless already changed)
            if ($inscriptionInterFormation->getFormation() === $this) {
                $inscriptionInterFormation->setFormation(null);
            }
        }

        return $this;
    }

    public function getPrixInter(): ?int
    {
        return $this->prixInter;
    }

    public function setPrixInter(?int $prixInter): static
    {
        $this->prixInter = $prixInter;

        return $this;
    }

    public function getPrixIntra(): ?int
    {
        return $this->prixIntra;
    }

    public function setPrixIntra(?int $prixIntra): static
    {
        $this->prixIntra = $prixIntra;

        return $this;
    }

    public function getNbApprenant(): ?int
    {
        return $this->nbApprenant;
    }

    public function setNbApprenant(int $nbApprenant): static
    {
        $this->nbApprenant = $nbApprenant;

        return $this;
    }

    public function isAuTop(): ?bool
    {
        return $this->auTop;
    }

    public function setAuTop(bool $auTop): static
    {
        $this->auTop = $auTop;

        return $this;
    }

    public function getNbJour(): ?float
    {
        return $this->nbJour;
    }

    public function setNbJour(float $nbJour): static
    {
        $this->nbJour = $nbJour;

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
