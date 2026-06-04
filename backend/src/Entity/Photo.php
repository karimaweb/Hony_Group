<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: PhotoRepository::class)]
#[Vich\Uploadable]
class Photo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message: "La photo est obligatoire."
    )]
    #[Assert\Length(
        max: 255,
        maxMessage: "Le nom du fichier ne doit pas dépasser {{ limit }} caractères."
    )]
    private ?string $urlFichier = null;


    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(
    message: "La légende de la photo est obligatoire."
)]
    #[Assert\Length(
    min: 3,
    max: 255,
    minMessage: "La légende doit contenir au minimum {{ limit }} caractères.",
    maxMessage: "La légende ne peut pas dépasser {{ limit }} caractères."
)]
    private ?string $legende = null;


    #[Assert\File(
        maxSize: "5M",
        mimeTypes: [
            "image/jpeg",
            "image/png",
            "image/webp"
        ],
        mimeTypesMessage: "Le fichier doit être une image valide (JPEG, PNG ou WEBP)."
    )]
    private ?File $imageFile = null;


    #[ORM\OneToOne(mappedBy: 'photo', cascade: ['persist', 'remove'])]
    private ?Prestation $prestation = null;


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getUrlFichier(): ?string
    {
        return $this->urlFichier;
    }


    public function setUrlFichier(string $urlFichier): static
    {
        $this->urlFichier = $urlFichier;

        return $this;
    }


    public function getLegende(): ?string
    {
        return $this->legende;
    }


    public function setLegende(?string $legende): static
    {
        $this->legende = $legende;

        return $this;
    }


    public function getPrestation(): ?Prestation
    {
        return $this->prestation;
    }


    public function setPrestation(?Prestation $prestation): static
    {
        if ($prestation === null && $this->prestation !== null) {
            $this->prestation->setPhoto(null);
        }

        if ($prestation !== null && $prestation->getPhoto() !== $this) {
            $prestation->setPhoto($this);
        }

        $this->prestation = $prestation;

        return $this;
    }


    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }


    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }


    public function __toString(): string
    {
        return $this->legende ?? 'Photo';
    }
}