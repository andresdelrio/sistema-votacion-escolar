<?php

namespace App\Entity;

use App\Repository\SedeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SedeRepository::class)]
class Sede
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\OneToMany(mappedBy: 'sede', targetEntity: Grado::class)]
    private Collection $grados;

    public function __construct()
    {
        $this->grados = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection<int, Grado>
     */
    public function getGrados(): Collection
    {
        return $this->grados;
    }

    public function addGrado(Grado $grado): static
    {
        if (!$this->grados->contains($grado)) {
            $this->grados->add($grado);
            $grado->setSede($this);
        }

        return $this;
    }

    public function removeGrado(Grado $grado): static
    {
        if ($this->grados->removeElement($grado)) {
            // set the owning side to null (unless already changed)
            if ($grado->getSede() === $this) {
                $grado->setSede(null);
            }
        }

        return $this;
    }
}
