<?php

namespace App\Entity;

use App\Repository\AvisFormationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisFormationRepository::class)]
class AvisFormation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'avisFormations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Formation $formation = null;

    #[ORM\Column(length: 50)]
    private ?string $prenomAuteur = null;

    #[ORM\Column(length: 50)]
    private ?string $nomAuteur = null;

    #[ORM\Column]
    private ?int $note = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $texteSurFormateur = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $texteSurContenu = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $texteSurSalle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $texteSurPlusApprecie = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $texteSurMoinsApprecie = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $resume = null;

    public function getFullName(): ?string
    {
        return $this->prenomAuteur . ' ' . $this->nomAuteur;
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

    public function getPrenomAuteur(): ?string
    {
        return $this->prenomAuteur;
    }

    public function setPrenomAuteur(string $prenomAuteur): static
    {
        $this->prenomAuteur = $prenomAuteur;

        return $this;
    }

    public function getNomAuteur(): ?string
    {
        return $this->nomAuteur;
    }

    public function setNomAuteur(string $nomAuteur): static
    {
        $this->nomAuteur = $nomAuteur;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getTexteSurFormateur(): ?string
    {
        return $this->texteSurFormateur;
    }

    public function setTexteSurFormateur(?string $texteSurFormateur): static
    {
        $this->texteSurFormateur = $texteSurFormateur;

        return $this;
    }

    public function getTexteSurContenu(): ?string
    {
        return $this->texteSurContenu;
    }

    public function setTexteSurContenu(?string $texteSurContenu): static
    {
        $this->texteSurContenu = $texteSurContenu;

        return $this;
    }

    public function getTexteSurSalle(): ?string
    {
        return $this->texteSurSalle;
    }

    public function setTexteSurSalle(?string $texteSurSalle): static
    {
        $this->texteSurSalle = $texteSurSalle;

        return $this;
    }

    public function getTexteSurPlusApprecie(): ?string
    {
        return $this->texteSurPlusApprecie;
    }

    public function setTexteSurPlusApprecie(string $texteSurPlusApprecie): static
    {
        $this->texteSurPlusApprecie = $texteSurPlusApprecie;

        return $this;
    }

    public function getTexteSurMoinsApprecie(): ?string
    {
        return $this->texteSurMoinsApprecie;
    }

    public function setTexteSurMoinsApprecie(string $texteSurMoinsApprecie): static
    {
        $this->texteSurMoinsApprecie = $texteSurMoinsApprecie;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): static
    {
        $this->resume = $resume;

        return $this;
    }
}
