<?php

namespace App\Application\Recipe;

use App\Domain\DishType;
use App\Domain\Recipe;
use App\Infrastructure\Repository\DishTypeRepository;
use App\Infrastructure\Repository\RecipeRepository;

class CreateRecipeService
{
    public function __construct(private RecipeRepository $recipeRepository, private DishTypeRepository $dishTypeRepository)
    {

    }

    public function createRecipe(
        string $title,
        string $dietType,
        int $serving,
        int $prepTime,
        int $cookTime,
        string $instructions,
        string $image_url,
        string $season,
        int $dishTypeId
    ): void
    {
        $recipe = new Recipe();

        $recipe->setTitle($title);
        $recipe->setDietType($dietType);
        $recipe->setServing($serving);
        $recipe->setPrepTime($prepTime);
        $recipe->setCookTime($cookTime);
        $recipe->setInstructions($instructions);
        $recipe->setImageUrl($image_url);
        $recipe->setSeason($season);

        $dishType = $this->dishTypeRepository->find($dishTypeId);
        $recipe->setDishType($dishType);

        $this->recipeRepository->save($recipe);
    }
}