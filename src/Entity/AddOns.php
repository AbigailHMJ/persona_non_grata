<?php

namespace App\Entity;

use App\Repository\AddOnsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddOnsRepository::class)]
class AddOns
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 355, nullable: true)]
    private ?string $playlist = null;

    #[ORM\Column(length: 355, nullable: true)]
    private ?string $moodboard = null;

    #[ORM\Column(length: 355, nullable: true)]
    private ?string $other = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getPlaylist(): ?string
    {
        return $this->playlist;
    }

    public function setPlaylist(?string $playlist): static
    {
        $this->playlist = $playlist;

        return $this;
    }

    public function getMoodboard(): ?string
    {
        return $this->moodboard;
    }

    public function setMoodboard(?string $moodboard): static
    {
        $this->moodboard = $moodboard;

        return $this;
    }

    public function getOther(): ?string
    {
        return $this->other;
    }

    public function setOther(?string $other): static
    {
        $this->other = $other;

        return $this;
    }
}
