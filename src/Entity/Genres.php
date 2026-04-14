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
    private ?string $keyword = null;

    /**
     * @var Collection<int, Campaign>
     */
    #[ORM\ManyToMany(targetEntity: Campaign::class, mappedBy: 'genre')]
    private Collection $campaigns;

       public function __toString()
    {
        return $this->keyword;
    }

    public function __construct()
    {
        $this->campaigns = new ArrayCollection();
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

    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    public function setKeyword(string $keyword): static
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * @return Collection<int, Campaign>
     */
    public function getCampaigns(): Collection
    {
        return $this->campaigns;
    }

    public function addCampaign(Campaign $campaign): static
    {
        if (!$this->campaigns->contains($campaign)) {
            $this->campaigns->add($campaign);
            $campaign->addGenre($this);
        }

        return $this;
    }

    public function removeCampaign(Campaign $campaign): static
    {
        if ($this->campaigns->removeElement($campaign)) {
            $campaign->removeGenre($this);
        }

        return $this;
    }
}