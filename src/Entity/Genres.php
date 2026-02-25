<?php

namespace App\Entity;

use App\Repository\GenresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenresRepository::class)]
class Genres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Has>
     */
    #[ORM\ManyToMany(targetEntity: Has::class, mappedBy: 'has_genres')]
    private Collection $has;

    public function __construct()
    {
        $this->has = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Has>
     */
    public function getHas(): Collection
    {
        return $this->has;
    }

    public function addHa(Has $ha): static
    {
        if (!$this->has->contains($ha)) {
            $this->has->add($ha);
            $ha->addHasGenre($this);
        }

        return $this;
    }

    public function removeHa(Has $ha): static
    {
        if ($this->has->removeElement($ha)) {
            $ha->removeHasGenre($this);
        }

        return $this;
    }
}
