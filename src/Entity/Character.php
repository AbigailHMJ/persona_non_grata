<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\DBAL\Types\Types;
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

    #[ORM\Column(length: 255)]
    private ?string $age = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $physical_traits = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $character_traits = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $background = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $others = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private mixed $illustration = null;

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

    public function setPhysicalTraits(string $physical_traits): static
    {
        $this->physical_traits = $physical_traits;

        return $this;
    }

    public function getCharacterTraits(): ?string
    {
        return $this->character_traits;
    }

    public function setCharacterTraits(string $character_traits): static
    {
        $this->character_traits = $character_traits;

        return $this;
    }

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function setBackground(string $background): static
    {
        $this->background = $background;

        return $this;
    }

    public function getOthers(): ?string
    {
        return $this->others;
    }

    public function setOthers(string $others): static
    {
        $this->others = $others;

        return $this;
    }

    public function getIllustration(): mixed
    {
        return $this->illustration;
    }

    public function setIllustration(mixed $illustration): static
    {
        $this->illustration = $illustration;

        return $this;
    }
}
