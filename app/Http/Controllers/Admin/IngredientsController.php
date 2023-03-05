<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class IngredientsController extends Controller
{
    public function index(): View
    {
        $ingredients = Ingredient::paginate(20);

        return view('ingredients/index', [
            'ingredients' => $ingredients
        ]);
    }

    public function show(Ingredient $ingredient): View
    {
        return view('ingredients/show', compact('ingredient'));
    }

    public function create(): View
    {
        return view('ingredients/create');
    }

    public function store(Request $request) {

        $request->validate(
            [
                'name' => 'required|max:25',
            ]
        );

        Ingredient::create($request->all());

        return redirect('ingredients')
            ->with('success', 'Ingredient created successfully!');
    }

    public function edit(Request $request, int $id): View|RedirectResponse
    {
        $ingredient = Ingredient::find($id);

        if ($ingredient === null) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $request->validate(
                [
                    'name' => 'required|max:25',
                ]
            );

            $ingredient->fill($request->all());
            $ingredient->is_active = $request->post('is_active', false);
            $ingredient->save();

            return redirect('ingredients')
                ->with('success', 'Ingredient updated!');

        }
        $ingredients = Ingredient::all();
        return view('ingredients/edit', [
            'ingredient' => $ingredient,
            'ingredients' => $ingredients
        ]);
    }

    public function delete(int $id)
    {
        $ingredient = Ingredient::find($id);

        if ($ingredient === null) {
            abort(404);
        }

        $ingredient->delete();

        return redirect('ingredients')->with('success', 'Ingredient was removed!');
    }
}
