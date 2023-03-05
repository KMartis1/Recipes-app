<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngridientsRecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingridients_recipe = [
            [
                'recipe_id' => 1,
                'ingridients_id' => 1,
            ],
            [
                'recipe_id' => 1,
                'ingridients_id' => 2,
            ],
            [
                'recipe_id' => 2,
                'ingridients_id' => 2,
            ]
        ];

        foreach ($ingredients_recipe as $item) {
            IngredientRecipe::create([
                'recipe_id' => $item['recipe_id'],
                'ingredient_id' => $item['ingredient_id'],
            ]);
        }
    }
}
