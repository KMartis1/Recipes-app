<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use Faker\Factory as Faker;


class RecipesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 25; $i++) {
            $recipe = new Recipe();
            $recipe->name = $faker->randomElement([
                'Spaghetti Carbonara',
                'Pad Thai',
                'Chicken Tikka Masala',
                'Fish and Chips',
                'Taco Salad',
                'Beef Stroganoff',
                'Peking Duck',
                'Moussaka',
                'Ratatouille',
                'Gumbo',
                'Borscht',
                'Sushi Rolls',
                'Lasagna',
                'Butter Chicken',
                'Enchiladas',
                'Tandoori Chicken',
                'Chicken Katsu Curry',
                'Hamburgers',
                'Meatball Subs',
                'Chicken Alfredo',
                'Pesto Pasta',
                'Beef Bourguignon',
                'Beef and Broccoli',
                'Teriyaki Salmon',
                'Steak Fajitas'
            ]);
            $recipe->description = $faker->paragraphs($faker->numberBetween(3, 15), true);
            $recipe->is_active = $faker->boolean(90);
            $recipe->save();
        }
    }
}

