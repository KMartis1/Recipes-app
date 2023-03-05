<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;

class RecipesController extends Controller
{
    public function create(): View
    {
        $ingredients = Ingredient::all();
        $categories = Category::all()->where('is_active', '=', 1);

        return view('recipes/create', [
            'ingredients' => $ingredients,
            'categories' => $categories
        ]);
    }

    public function store(Request $request): RedirectResponse|View
    {
        $request->validate(
            [
                'name' => 'required|min:3|max:50',
                'category_id' => 'required',
                'image' => [
                    File::types(['mp3', 'wav', 'png', 'jpg'])
                ]
            ]
        );

        $recipe = Recipe::create($request->all());
        $recipe->is_active = $request->post('is_active', 0);
        $file = $request->file('image'); //Objektas
        if ($file) {
            $path = $file->store('recipes_images');
            $recipe->image = $path;
        }
        $recipe->save();

        $recipe->ingredients()->attach($request->post('ingredient_id'));

        return redirect('recipes')
            ->with('success', 'Recipe created successfully!');
    }

    public function edit(Request $request, int $id): View|RedirectResponse
    {
        $recipe = Recipe::find($id);

        $ingredients = Ingredient::all();
        $categories = Category::all();

        if ($recipe === null) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $request->validate(
                [
                    'name' => 'required|min:3|max:50',
                    'category_id' => 'required'
                ]
            );

            if ($request->has('is_active')) {
                $recipe->is_active = 1;
            } else {
                $recipe->is_active = 0;
            }

            $file = $request->file('image');
            if ($file) {
                $path = $file->store('recipes_images');
                $recipe->image = $path;
            }
            $recipe->update($request->all());

            $recipe->ingredients()->detach();

            $recipe->ingredients()->attach($request->post('ingredient_id'));

            return redirect('recipes')->with('success', 'Recipe updated!');
        }

        return view('recipes/edit', [
            'recipe' => $recipe,
            'ingredients' => $ingredients,
            'categories' => $categories
        ]);
    }

        public function delete(int $id)
        {
            $recipe = Recipe::find($id);
            if ($recipe === null) {
                abort(404);
            }
            $recipe->delete();
            return redirect('recipes')
                ->with('success', 'Recipe was removed');
        }
}
