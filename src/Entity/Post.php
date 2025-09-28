<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[Broadcast]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $texte = null;

    #[ORM\Column]
    private ?\DateTime $date = null;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'post', orphanRemoval: true)]
    private Collection $commentaires;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sujet $sujet = null;

    /**
     * @var Collection<int, Utilisateur>
     */
    #[ORM\ManyToMany(targetEntity: Utilisateur::class, mappedBy: 'invalidateurs')]
    private Collection $postsInvalides;

    /**
     * @var Collection<int, Utilisateur>
     */
    #[ORM\ManyToMany(targetEntity: Utilisateur::class, mappedBy: 'validateurs')]
    private Collection $postsValides;

    /**
     * @var Collection<int, Utilisateur>
     */
    #[ORM\ManyToMany(targetEntity: Utilisateur::class, mappedBy: 'redacteurs')]
    private Collection $postsRediges;

    /**
     * @var Collection<int, Utilisateur>
     */
    #[ORM\ManyToMany(targetEntity: Utilisateur::class, mappedBy: 'enregistreurs')]
    private Collection $postsEnregistres;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->postsInvalides = new ArrayCollection();
        $this->postsValides = new ArrayCollection();
        $this->postsRediges = new ArrayCollection();
        $this->postsEnregistres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): static
    {
        $this->texte = $texte;

        return $this;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Comment $commentaire): static
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setPost($this);
        }

        return $this;
    }

    public function removeCommentaire(Comment $commentaire): static
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getPost() === $this) {
                $commentaire->setPost(null);
            }
        }

        return $this;
    }

    public function getSujet(): ?Sujet
    {
        return $this->sujet;
    }

    public function setSujet(?Sujet $sujet): static
    {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getPostsInvalides(): Collection
    {
        return $this->postsInvalides;
    }

    public function addPostsInvalide(Utilisateur $postsInvalide): static
    {
        if (!$this->postsInvalides->contains($postsInvalide)) {
            $this->postsInvalides->add($postsInvalide);
            $postsInvalide->addInvalidateur($this);
        }

        return $this;
    }

    public function removePostsInvalide(Utilisateur $postsInvalide): static
    {
        if ($this->postsInvalides->removeElement($postsInvalide)) {
            $postsInvalide->removeInvalidateur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getPostsValides(): Collection
    {
        return $this->postsValides;
    }

    public function addPostsValide(Utilisateur $postsValide): static
    {
        if (!$this->postsValides->contains($postsValide)) {
            $this->postsValides->add($postsValide);
            $postsValide->addValidateur($this);
        }

        return $this;
    }

    public function removePostsValide(Utilisateur $postsValide): static
    {
        if ($this->postsValides->removeElement($postsValide)) {
            $postsValide->removeValidateur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getPostsRediges(): Collection
    {
        return $this->postsRediges;
    }

    public function addPostsRedige(Utilisateur $postsRedige): static
    {
        if (!$this->postsRediges->contains($postsRedige)) {
            $this->postsRediges->add($postsRedige);
            $postsRedige->addRedacteur($this);
        }

        return $this;
    }

    public function removePostsRedige(Utilisateur $postsRedige): static
    {
        if ($this->postsRediges->removeElement($postsRedige)) {
            $postsRedige->removeRedacteur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getPostsEnregistres(): Collection
    {
        return $this->postsEnregistres;
    }

    public function addPostsEnregistre(Utilisateur $postsEnregistre): static
    {
        if (!$this->postsEnregistres->contains($postsEnregistre)) {
            $this->postsEnregistres->add($postsEnregistre);
            $postsEnregistre->addEnregistreur($this);
        }

        return $this;
    }

    public function removePostsEnregistre(Utilisateur $postsEnregistre): static
    {
        if ($this->postsEnregistres->removeElement($postsEnregistre)) {
            $postsEnregistre->removeEnregistreur($this);
        }

        return $this;
    }
}
