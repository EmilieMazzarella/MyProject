<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    /**
     * @var Collection<int, Post>
     */
    #[ORM\ManyToMany(targetEntity: Post::class, inversedBy: 'postsInvalides')]
    #[ORM\JoinTable(name: 'utilisateur_post_invalide')]
    private Collection $invalidateurs;
    /**
     * @var Collection<int, Post>
     */
    #[ORM\ManyToMany(targetEntity: Post::class, inversedBy: 'postsValides')]
    #[ORM\JoinTable(name: 'utilisateur_post_valide')]
    private Collection $validateurs;

    /**
     * @var Collection<int, Post>
     */
    #[ORM\ManyToMany(targetEntity: Post::class, inversedBy: 'postsRediges')]
    #[ORM\JoinTable(name: 'utilisateur_post_redige')]
    private Collection $redacteurs;

    /**
     * @var Collection<int, Post>
     */
    #[ORM\ManyToMany(targetEntity: Post::class, inversedBy: 'postsEnregistres')]
    #[ORM\JoinTable(name: 'utilisateur_post_enregistre')]
    private Collection $enregistreurs;

    public function __construct()
    {
        $this->invalidateurs = new ArrayCollection();
        $this->validateurs = new ArrayCollection();
        $this->redacteurs = new ArrayCollection();
        $this->enregistreurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Ensure the session doesn't contain actual password hashes by CRC32C-hashing them, as supported since Symfony 7.3.
     */
    public function __serialize(): array
    {
        $data = (array) $this;
        $data["\0".self::class."\0password"] = hash('crc32c', $this->password);

        return $data;
    }

    #[\Deprecated]
    public function eraseCredentials(): void
    {
        // @deprecated, to be removed when upgrading to Symfony 8
    }

    /**
     * @return Collection<int, Post>
     */
    public function getInvalidateurs(): Collection
    {
        return $this->invalidateurs;
    }

    public function addInvalidateur(Post $invalidateur): static
    {
        if (!$this->invalidateurs->contains($invalidateur)) {
            $this->invalidateurs->add($invalidateur);
        }

        return $this;
    }

    public function removeInvalidateur(Post $invalidateur): static
    {
        $this->invalidateurs->removeElement($invalidateur);

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getValidateurs(): Collection
    {
        return $this->validateurs;
    }

    public function addValidateur(Post $validateur): static
    {
        if (!$this->validateurs->contains($validateur)) {
            $this->validateurs->add($validateur);
        }

        return $this;
    }

    public function removeValidateur(Post $validateur): static
    {
        $this->validateurs->removeElement($validateur);

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getRedacteurs(): Collection
    {
        return $this->redacteurs;
    }

    public function addRedacteur(Post $redacteur): static
    {
        if (!$this->redacteurs->contains($redacteur)) {
            $this->redacteurs->add($redacteur);
        }

        return $this;
    }

    public function removeRedacteur(Post $redacteur): static
    {
        $this->redacteurs->removeElement($redacteur);

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getEnregistreurs(): Collection
    {
        return $this->enregistreurs;
    }

    public function addEnregistreur(Post $enregistreur): static
    {
        if (!$this->enregistreurs->contains($enregistreur)) {
            $this->enregistreurs->add($enregistreur);
        }

        return $this;
    }

    public function removeEnregistreur(Post $enregistreur): static
    {
        $this->enregistreurs->removeElement($enregistreur);

        return $this;
    }
}
