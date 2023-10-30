<?php

namespace App\Entity;

use App\Repository\SortieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SortieRepository::class)]
class Sortie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message:'La saisie du nom de la sortie est obligatoire.')]
    #[Assert\Length(max: 100, maxMessage: 'Le nom de votre sortie ne doit pas dépasser 100 caractères.')]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank(message:'La saisie de l\'heure de début est obligatoire.')]
    private ?\DateTimeInterface $dateHeureDebut = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:'La durée de la sortie est obligatoire.')]
    private ?int $duree = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank(message:'La date limite d\'inscription est obligatoire.')]
    private ?\DateTimeInterface $dateLimiteInscription = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:'La nombre maximum d\'inscrits est obligatoire.')]
    private ?int $nbInscriptionMax = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:'Les infos concernat la sortie sont obligatoires.')]
    #[Assert\Length(min: 20, max: 250, minMessage: 'La description doit faire au minimum 20 caractères.', maxMessage: 'La description doit faire maximum 250 caractères.')]
    private ?string $infosSortie = null;

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

    public function getDateHeureDebut(): ?\DateTimeInterface
    {
        return $this->dateHeureDebut;
    }

    public function setDateHeureDebut(\DateTimeInterface $dateHeureDebut): static
    {
        $this->dateHeureDebut = $dateHeureDebut;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDateLimiteInscription(): ?\DateTimeInterface
    {
        return $this->dateLimiteInscription;
    }

    public function setDateLimiteInscription(\DateTimeInterface $dateLimiteInscription): static
    {
        $this->dateLimiteInscription = $dateLimiteInscription;

        return $this;
    }

    public function getNbInscriptionMax(): ?int
    {
        return $this->nbInscriptionMax;
    }

    public function setNbInscriptionMax(int $nbInscriptionMax): static
    {
        $this->nbInscriptionMax = $nbInscriptionMax;

        return $this;
    }

    public function getInfosSortie(): ?string
    {
        return $this->infosSortie;
    }

    public function setInfosSortie(string $infosSortie): static
    {
        $this->infosSortie = $infosSortie;

        return $this;
    }
}
