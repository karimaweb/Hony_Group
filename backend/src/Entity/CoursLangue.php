<?php

namespace App\Entity;

use App\Repository\CoursLangueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity(
    fields: ['langue'],
    message: 'Ce cours de langue existe déjà.'
)]
#[ORM\Entity(repositoryClass: CoursLangueRepository::class)]
class CoursLangue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(
        message: "La langue est obligatoire."
    )]
    #[Assert\Length(
        min: 2,
        max: 100,
        minMessage: "La langue doit contenir au minimum {{ limit }} caractères.",
        maxMessage: "La langue ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $langue = null;


    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\Choice(
        choices: ['Débutant', 'Intermédiaire', 'Avancé'],
        message: "Le niveau doit être Débutant, Intermédiaire ou Avancé."
    )]
    private ?string $niveau = null;


    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Length(
        min: 20,
        minMessage: "Le descriptif du programme doit contenir au minimum {{ limit }} caractères."
    )]
    private ?string $descriptifProgramme = null;


    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(
        message: "Le statut est obligatoire."
    )]
    #[Assert\Choice(
        choices: ['actif', 'inactif'],
        message: "Le statut doit être actif ou inactif."
    )]
    private ?string $statut = null;


    #[ORM\OneToOne(
        inversedBy: 'coursLangue',
        cascade: ['persist', 'remove']
    )]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull(
        message: "Une prestation doit être associée au cours de langue."
    )]
    private ?Prestation $prestation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): static
    {
        $this->langue = $langue;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(?string $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getDescriptifProgramme(): ?string
    {
        return $this->descriptifProgramme;
    }

    public function setDescriptifProgramme(?string $descriptifProgramme): static
    {
        $this->descriptifProgramme = $descriptifProgramme;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getPrestation(): ?Prestation
    {
        return $this->prestation;
    }

    public function setPrestation(Prestation $prestation): static
    {
        $this->prestation = $prestation;

        return $this;
    }
}
