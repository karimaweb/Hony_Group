<?php

namespace App\Entity;

use App\Repository\CircuitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CircuitRepository::class)]
class Circuit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message: "Le titre du circuit est obligatoire."
    )]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: "Le titre doit contenir au minimum {{ limit }} caractères.",
        maxMessage: "Le titre ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $titreCircuit = null;


    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Length(
        min: 20,
        minMessage: "La description doit contenir au minimum {{ limit }} caractères."
    )]
    private ?string $descriptionLongue = null;


    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Length(
        min: 10,
        minMessage: "L'itinéraire doit contenir au minimum {{ limit }} caractères."
    )]
    private ?string $itineraire = null;


    #[ORM\Column(length: 100, nullable: true)]
    #[Assert\Length(
        max: 100,
        maxMessage: "La durée ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $duree = null;


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
        inversedBy: 'circuit',
        cascade: ['persist', 'remove']
    )]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull(
        message: "Une prestation doit être associée au circuit."
    )]
    private ?Prestation $prestation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreCircuit(): ?string
    {
        return $this->titreCircuit;
    }

    public function setTitreCircuit(string $titreCircuit): static
    {
        $this->titreCircuit = $titreCircuit;

        return $this;
    }

    public function getDescriptionLongue(): ?string
    {
        return $this->descriptionLongue;
    }

    public function setDescriptionLongue(?string $descriptionLongue): static
    {
        $this->descriptionLongue = $descriptionLongue;

        return $this;
    }

    public function getItineraire(): ?string
    {
        return $this->itineraire;
    }

    public function setItineraire(?string $itineraire): static
    {
        $this->itineraire = $itineraire;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(?string $duree): static
    {
        $this->duree = $duree;

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
