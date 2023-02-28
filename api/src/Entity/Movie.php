<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MovieRepository::class)
 */
class Movie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $moveYear;
    
    /**
     * @ORM\ManyToMany(targetEntity=Actor::class, inversedBy="movies")
     */
    private $actors;

    /**
     * @ORM\ManyToMany(targetEntity=MovieCategory::class, inversedBy="movies", cascade={"persist"})
     */
    private $movieCategory;

    public function __construct()
    {
        $this->actors = new ArrayCollection();
        $this->movieCategory = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMoveYear(): ?int
    {
        return $this->moveYear;
    }

    public function setMoveYear(int $moveYear): self
    {
        $this->moveYear = $moveYear;

        return $this;
    }

    /**
     * @return Collection<int, Actor>
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Actor $actor): self
    {
        if (!$this->actors->contains($actor)) {
            $this->actors[] = $actor;
        }

        return $this;
    }

    public function removeActor(Actor $actor): self
    {
        $this->actors->removeElement($actor);

        return $this;
    }

    /**
     * @return Collection<int, MovieCategory>
     */
    public function getMovieCategory(): Collection
    {
        return $this->movieCategory;
    }

    public function addMovieCategory(MovieCategory $movieCategory): self
    {
        if (!$this->movieCategory->contains($movieCategory)) {
            $this->movieCategory[] = $movieCategory;
        }

        return $this;
    }

    public function removeMovieCategory(MovieCategory $movieCategory): self
    {
        $this->movieCategory->removeElement($movieCategory);

        return $this;
    }
}
