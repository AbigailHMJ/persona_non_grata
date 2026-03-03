<?php

namespace App\Entity;

use App\Repository\CampaignRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampaignRepository::class)]
class Campaign
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, Character>
     */
    #[ORM\OneToMany(targetEntity: Character::class, mappedBy: 'campaign')]
    private Collection $characters;

    /**
     * @var Collection<int, Genres>
     */
    #[ORM\ManyToMany(targetEntity: Genres::class, inversedBy: 'campaigns')]
    private Collection $genre;

    #[ORM\ManyToOne(inversedBy: 'campaigns')]
    private ?Share $shared = null;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
        $this->genre = new ArrayCollection();
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Character>
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter(Character $character): static
    {
        if (!$this->characters->contains($character)) {
            $this->characters->add($character);
            $character->setCampaign($this);
        }

        return $this;
    }

    public function removeCharacter(Character $character): static
    {
        if ($this->characters->removeElement($character)) {
            // set the owning side to null (unless already changed)
            if ($character->getCampaign() === $this) {
                $character->setCampaign(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Genres>
     */
    public function getGenre(): Collection
    {
        return $this->genre;
    }

    public function addGenre(Genres $genre): static
    {
        if (!$this->genre->contains($genre)) {
            $this->genre->add($genre);
        }

        return $this;
    }

    public function removeGenre(Genres $genre): static
    {
        $this->genre->removeElement($genre);

        return $this;
    }

    public function getShared(): ?Share
    {
        return $this->shared;
    }

    public function setShared(?Share $shared): static
    {
        $this->shared = $shared;

        return $this;
    }
}
