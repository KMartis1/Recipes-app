<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::paginate(10);

        return view('categories/index', [
            'categories' => $categories
        ]);
    }

    public function show(int $id): View
    {
        $category = Category::find($id);

        if (null === $category) {
            abort(404);
        }

        return view('categories/show', [
            'category' => $category
        ]);
    }

    // --------------------------------------

    public function create(): View
    {
        return view('categories/create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
            'name' => 'required|max:50',
            ]
        );

        Category::create($request->all());

        return redirect('categories')
            ->with('success', 'Category created successfully!');
    }

    public function edit(int $id, Request $request)
    {
        $category = Category::find($id);

        if ($category === null) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $request->validate(
                [
                    'name' => 'required|max:20'
                ]
            );

            $category->fill($request->all());
            $category->is_active = $request->post('is_active', false);
            $category->save();

            return redirect('categories')
                ->with('success', 'Category updated!');
        }

        $categories = Category::all();

        return view('categories/edit', [
            'category' => $category,
            'categories' => $categories
        ]);
    }

    public function delete(int $id)
    {
        $category = Category::find($id);
        if ($category === null) {
            abort(404);
        }
        $category->delete();
        return redirect('categories')
            ->with('success', 'Category was removed');
    }
}
