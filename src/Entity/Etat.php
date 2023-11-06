<?php

namespace App\Entity;

use App\Repository\EtatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: EtatRepository::class)]
class Etat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 15, options: ['default' => 'Ouvert'])]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'etat', targetEntity: Sortie::class)]
    private Collection $sortie;

    public function __construct()
    {
        $this->libelle = "Ouvert";
        $this->sortie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Sortie>
     */
    public function getSortie(): Collection
    {
        return $this->sortie;
    }

    public function addSortie(Sortie $sortie): static
    {
        if (!$this->sortie->contains($sortie)) {
            $this->sortie->add($sortie);
            $sortie->setEtat($this);
        }

        return $this;
    }

    public function removeSortie(Sortie $sortie): static
    {
        if ($this->sortie->removeElement($sortie)) {
            // set the owning side to null (unless already changed)
            if ($sortie->getEtat() === $this) {
                $sortie->setEtat(null);
            }
        }

        return $this;
    }
}
