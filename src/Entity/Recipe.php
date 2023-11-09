<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $diet_type = null;

    #[ORM\Column]
    private ?int $serving = null;

    #[ORM\Column]
    private ?int $prep_time = null;

    #[ORM\Column]
    private ?int $cook_time = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $instructions = null;

    #[ORM\Column(length: 255)]
    private ?string $image_url = null;

    #[ORM\Column(length: 255)]
    private ?string $season = null;

    #[ORM\ManyToOne(inversedBy: 'recipes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DishType $dishType = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDishType(): ?string
    {
        return $this->dishType;
    }

    public function setDishType(string $dishType): static
    {
        $this->dishType = $dishType;

        return $this;
    }

    public function getDietType(): ?string
    {
        return $this->diet_type;
    }

    public function setDietType(string $diet_type): static
    {
        $this->diet_type = $diet_type;

        return $this;
    }

    public function getServing(): ?int
    {
        return $this->serving;
    }

    public function setServing(int $serving): static
    {
        $this->serving = $serving;

        return $this;
    }

    public function getPrepTime(): ?int
    {
        return $this->prep_time;
    }

    public function setPrepTime(int $prep_time): static
    {
        $this->prep_time = $prep_time;

        return $this;
    }

    public function getCookTime(): ?int
    {
        return $this->cook_time;
    }

    public function setCookTime(int $cook_time): static
    {
        $this->cook_time = $cook_time;

        return $this;
    }

    public function getInstructions(): ?string
    {
        return $this->instructions;
    }

    public function setInstructions(string $instructions): static
    {
        $this->instructions = $instructions;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(string $image_url): static
    {
        $this->image_url = $image_url;

        return $this;
    }

    public function getSeason(): ?string
    {
        return $this->season;
    }

    public function setSeason(string $season): static
    {
        $this->season = $season;

        return $this;
    }
}
