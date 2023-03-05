<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesAndIngredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryNames = [
            'Appetizers',
            'Breakfast',
            'Lunch',
            'Dinner',
            'Desserts',
            'Snacks',
            'Beverages',
            'Vegetarian',
            'Cocktails',
            'Vegan'
        ];

        // Create 10 categories with an 80% chance of is_active being true
        foreach ($categoryNames as $category) {
            Category::create([
                'name' => $category,
                'is_active' => rand(1, 100) <= 80 // 80% chance of is_active being true
            ]);
        }

        $ingredientNames = [
            'Spinach',
            'Kale',
            'Broccoli',
            'Cauliflower',
            'Carrots',
            'Celery',
            'Cucumber',
            'Tomatoes',
            'Avocado',
            'Banana',
            'Strawberries',
            'Blueberries',
            'Raspberries',
            'Grapes',
            'Oranges',
            'Lemons',
            'Limes',
            'Pineapple',
            'Coconut Milk',
            'Almond Milk',
            'Orange Juice',
            'Eggs',
            'Milk',
            'Butter',
            'Flour',
            'Sugar',
            'Salt',
            'Pepper',
        ];

        // Create 40 ingredients with an 80% chance of is_active being true
        foreach ($ingredientNames as $ingredientName) {
            Ingredient::create([
                'name' => $ingredientName,
                'is_active' => rand(1, 100) <= 80 // 80% chance of is_active being true
            ]);
        }
    }
}
