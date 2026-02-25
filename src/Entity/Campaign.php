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

    #[ORM\OneToOne(mappedBy: 'has', cascade: ['persist', 'remove'])]
    private ?Character $character_file = null;

    /**
     * @var Collection<int, Share>
     */
    #[ORM\ManyToMany(targetEntity: Share::class, mappedBy: 'share_campaign')]
    private Collection $shares;

    /**
     * @var Collection<int, Has>
     */
    #[ORM\ManyToMany(targetEntity: Has::class, mappedBy: 'has_campaign')]
    private Collection $has;

    public function __construct()
    {
        $this->shares = new ArrayCollection();
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

    public function getCharacterFile(): ?Character
    {
        return $this->character_file;
    }

    public function setCharacterFile(?Character $character_file): static
    {
        // unset the owning side of the relation if necessary
        if ($character_file === null && $this->character_file !== null) {
            $this->character_file->setHas(null);
        }

        // set the owning side of the relation if necessary
        if ($character_file !== null && $character_file->getHas() !== $this) {
            $character_file->setHas($this);
        }

        $this->character_file = $character_file;

        return $this;
    }

    /**
     * @return Collection<int, Share>
     */
    public function getShares(): Collection
    {
        return $this->shares;
    }

    public function addShare(Share $share): static
    {
        if (!$this->shares->contains($share)) {
            $this->shares->add($share);
            $share->addShareCampaign($this);
        }

        return $this;
    }

    public function removeShare(Share $share): static
    {
        if ($this->shares->removeElement($share)) {
            $share->removeShareCampaign($this);
        }

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
            $ha->addHasCampaign($this);
        }

        return $this;
    }

    public function removeHa(Has $ha): static
    {
        if ($this->has->removeElement($ha)) {
            $ha->removeHasCampaign($this);
        }

        return $this;
    }
}
