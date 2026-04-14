<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacterRepository::class)]
#[ORM\Table(name: '`character`')]
class Character
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $age = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $physical_traits = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $character_traits = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $background = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $others = null;

    #[ORM\Column(nullable: true)]
    private ?string $illustration = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    private ?Campaign $campaign = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    private ?User $user = null;

    #[ORM\OneToOne(mappedBy: 'addon')] 
    private ?Addons $addons = null;

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

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(string $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getPhysicalTraits(): ?string
    {
        return $this->physical_traits;
    }

    public function setPhysicalTraits(?string $physical_traits): static
    {
        $this->physical_traits = $physical_traits;

        return $this;
    }

    public function getCharacterTraits(): ?string
    {
        return $this->character_traits;
    }

    public function setCharacterTraits(?string $character_traits): static
    {
        $this->character_traits = $character_traits;

        return $this;
    }

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function setBackground(?string $background): static
    {
        $this->background = $background;

        return $this;
    }

    public function getOthers(): ?string
    {
        return $this->others;
    }

    public function setOthers(?string $others): static
    {
        $this->others = $others;

        return $this;
    }

    public function getIllustration(): ?string
    {
        return $this->illustration;
    }

    public function setIllustration(?string $illustration): static
    {
        $this->illustration = $illustration;

        return $this;
    }

    public function getCampaign(): ?Campaign
    {
        return $this->campaign;
    }

    public function setCampaign(?Campaign $campaign): static
    {
        $this->campaign = $campaign;

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

    public function getAddons(): ?Addons
    {
        return $this->addons;
    }

    public function setAddons(?Addons $addons): static
    {
        // unset the owning side of the relation if necessary
        if ($addons === null && $this->addons !== null) {
            $this->addons->setAddon(null);
        }

        // set the owning side of the relation if necessary
        if ($addons !== null && $addons->getAddon() !== $this) {
            $addons->setAddon($this);
        }

        $this->addons = $addons;

        return $this;
    }

}