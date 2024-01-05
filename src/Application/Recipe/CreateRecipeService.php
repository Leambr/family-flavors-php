<?php

namespace App\Application\Recipe;

use App\Domain\Recipe;
use App\Infrastructure\Doctrine\Repository\DishTypeRepository;
use App\Infrastructure\Doctrine\Repository\RecipeRepository;

class CreateRecipeService
{
    public function __construct(private readonly RecipeRepository $recipeRepository, private readonly DishTypeRepository $dishTypeRepository)
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
        $dishType = $this->dishTypeRepository->find($dishTypeId);

        $recipe = new Recipe($title, $dietType, $serving, $prepTime, $cookTime, $instructions, $image_url, $season, $dishType);

        $this->recipeRepository->save($recipe);
    }
}