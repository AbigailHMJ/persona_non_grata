<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
// Ensures no username can be used more than once
#[UniqueEntity(fields: ['username'], message: 'Ce nom d\'utilisateur est déjà pris')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', unique: true)]
    private ?string $username = null;

    #[ORM\Column(type: 'string', unique: true)]
    // Prevents use of the same email twice
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $birthdate = null;

    #[ORM\Column(type: 'json', nullable: true)]
    private array $roles = [];

    /**
     * @var Collection<int, Character>
     */
    #[ORM\OneToMany(targetEntity: Character::class, mappedBy: 'user')]
    private Collection $characters;

    /**
     * @var Collection<int, Share>
     */
    #[ORM\OneToMany(targetEntity: Share::class, mappedBy: 'user')]
    private Collection $sharing;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
        $this->sharing = new ArrayCollection();
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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    } 

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getBirthdate(): ?\DateTime
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTime $birthdate): static
    {
        $this->birthdate = $birthdate;

        return $this;
    }

   public function getRoles(): array
    {
        // Guarantees to at least get the role user at registration
        $roles = $this->roles;
        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }
        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->username;
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
            $character->setUser($this);
        }

        return $this;
    }

    public function removeCharacter(Character $character): static
    {
        if ($this->characters->removeElement($character)) {
            // set the owning side to null (unless already changed)
            if ($character->getUser() === $this) {
                $character->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Share>
     */
    public function getSharing(): Collection
    {
        return $this->sharing;
    }

    public function addSharing(Share $sharing): static
    {
        if (!$this->sharing->contains($sharing)) {
            $this->sharing->add($sharing);
            $sharing->setUser($this);
        }

        return $this;
    }

    public function removeSharing(Share $sharing): static
    {
        if ($this->sharing->removeElement($sharing)) {
            // set the owning side to null (unless already changed)
            if ($sharing->getUser() === $this) {
                $sharing->setUser(null);
            }
        }

        return $this;
    }
}