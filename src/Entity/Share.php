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

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'shares')]
    private Collection $share_user;

    /**
     * @var Collection<int, Campaign>
     */
    #[ORM\ManyToMany(targetEntity: Campaign::class, inversedBy: 'shares')]
    private Collection $share_campaign;

    public function __construct()
    {
        $this->share_user = new ArrayCollection();
        $this->share_campaign = new ArrayCollection();
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

    /**
     * @return Collection<int, User>
     */
    public function getShareUser(): Collection
    {
        return $this->share_user;
    }

    public function addShareUser(User $shareUser): static
    {
        if (!$this->share_user->contains($shareUser)) {
            $this->share_user->add($shareUser);
        }

        return $this;
    }

    public function removeShareUser(User $shareUser): static
    {
        $this->share_user->removeElement($shareUser);

        return $this;
    }

    /**
     * @return Collection<int, Campaign>
     */
    public function getShareCampaign(): Collection
    {
        return $this->share_campaign;
    }

    public function addShareCampaign(Campaign $shareCampaign): static
    {
        if (!$this->share_campaign->contains($shareCampaign)) {
            $this->share_campaign->add($shareCampaign);
        }

        return $this;
    }

    public function removeShareCampaign(Campaign $shareCampaign): static
    {
        $this->share_campaign->removeElement($shareCampaign);

        return $this;
    }
}
