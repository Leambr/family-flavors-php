<?php

namespace App\Domain;

use App\Infrastructure\Doctrine\Repository\RecipeRepository;
use Doctrine\ORM\Mapping as ORM;

//#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
//    #[ORM\Id]
//    #[ORM\GeneratedValue]
//    #[ORM\Column]
    private ?int $id = null;
    public function __construct(
        private string   $title,
        private string   $diet_type,
        private int      $serving,
        private int      $prep_time,
        private int      $cook_time,
        private string   $instructions,
        private string   $image_url,
        private string   $season,
        private DishType $dishType
    ) {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getDishType(): ?DishType
    {
        return $this->dishType;
    }
    public function getDietType(): ?string
    {
        return $this->diet_type;
    }

    public function getServing(): ?int
    {
        return $this->serving;
    }

    public function getPrepTime(): ?int
    {
        return $this->prep_time;
    }

    public function getCookTime(): ?int
    {
        return $this->cook_time;
    }

    public function getInstructions(): ?string
    {
        return $this->instructions;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function getSeason(): ?string
    {
        return $this->season;
    }

}
