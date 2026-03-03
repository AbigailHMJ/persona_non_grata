<?php

namespace App\Entity;

use App\Repository\ShareRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShareRepository::class)]
class Share
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $shared_by = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_share = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'sharing')]
    private ?User $user = null;

    /**
     * @var Collection<int, Campaign>
     */
    #[ORM\OneToMany(targetEntity: Campaign::class, mappedBy: 'shared')]
    private Collection $campaigns;

    public function __construct()
    {
        $this->campaigns = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSharedBy(): ?string
    {
        return $this->shared_by;
    }

    public function setSharedBy(string $shared_by): static
    {
        $this->shared_by = $shared_by;

        return $this;
    }

    public function getDateShare(): ?\DateTime
    {
        return $this->date_share;
    }

    public function setDateShare(\DateTime $date_share): static
    {
        $this->date_share = $date_share;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

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
            $campaign->setShared($this);
        }

        return $this;
    }

    public function removeCampaign(Campaign $campaign): static
    {
        if ($this->campaigns->removeElement($campaign)) {
            // set the owning side to null (unless already changed)
            if ($campaign->getShared() === $this) {
                $campaign->setShared(null);
            }
        }

        return $this;
    }
}
