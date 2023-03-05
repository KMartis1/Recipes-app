<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RecipesController extends Controller
{
    public function index(Request $request): View
    {
        $recipes = Recipe::where('is_active', '=', 1); //query builser
        if ($request->query('category_id')) {
            $recipes->where('category_id', '=', $request->query('category_id'));
        }

        if ($request->query('name')) {
            $recipes->where('name', 'like', '%' . $request->query('name') . '%');
        }

        $recipes = $recipes->paginate(10);

        $categories = Category::where('is_active', '=', 1)->get();

        $ingredients = Ingredient::where('is_active', '=', 1)
            ->whereNull('ingredient_id');

        return view('recipes/index', [
            'recipes' => $recipes,
            'categories' => $categories,
            'category_id' => $request->query('category_id'),
            'ingredients' => $ingredients,
            'name' => $request->query('name'),
            'admin' => $request->query('role'),
        ]);
    }

    public function show($id): View
    {
        $recipe = Recipe::find($id);

        if ($recipe === null) {
            abort(404);
        }

        return view('recipes/show', [
            'recipes' => $recipe
        ]);
    }
}
