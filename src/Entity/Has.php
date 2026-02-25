<?php

namespace App\Entity;

use App\Repository\HasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HasRepository::class)]
class Has
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Campaign>
     */
    #[ORM\ManyToMany(targetEntity: Campaign::class, inversedBy: 'has')]
    private Collection $has_campaign;

    /**
     * @var Collection<int, Genres>
     */
    #[ORM\ManyToMany(targetEntity: Genres::class, inversedBy: 'has')]
    private Collection $has_genres;

    public function __construct()
    {
        $this->has_campaign = new ArrayCollection();
        $this->has_genres = new ArrayCollection();
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

    /**
     * @return Collection<int, Campaign>
     */
    public function getHasCampaign(): Collection
    {
        return $this->has_campaign;
    }

    public function addHasCampaign(Campaign $hasCampaign): static
    {
        if (!$this->has_campaign->contains($hasCampaign)) {
            $this->has_campaign->add($hasCampaign);
        }

        return $this;
    }

    public function removeHasCampaign(Campaign $hasCampaign): static
    {
        $this->has_campaign->removeElement($hasCampaign);

        return $this;
    }

    /**
     * @return Collection<int, Genres>
     */
    public function getHasGenres(): Collection
    {
        return $this->has_genres;
    }

    public function addHasGenre(Genres $hasGenre): static
    {
        if (!$this->has_genres->contains($hasGenre)) {
            $this->has_genres->add($hasGenre);
        }

        return $this;
    }

    public function removeHasGenre(Genres $hasGenre): static
    {
        $this->has_genres->removeElement($hasGenre);

        return $this;
    }
}
