<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RecipesController as AdminRecipesController;
use App\Http\Controllers\Front\RecipesController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Admin\IngredientsController as AdminIngredientsController;
use App\Http\Controllers\Front\IngredientsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/recipes');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('recipes', [RecipesController::class, 'index'])->name('recipes'); // visi receptai - perziura
Route::get('recipes/{id}', [RecipesController::class, 'show'])->whereNumber('id');  // vienas receptas - perziura
Route::middleware('auth')->group(function () {
    Route::get('admin/recipes/create', [AdminRecipesController::class, 'create']); // recepto sukurimas
    Route::any('admin/recipes/edit/{id}', [AdminRecipesController::class, 'edit'])->name('recipes.edit');  // recepto edit
    Route::post('admin/recipes/store', [AdminRecipesController::class, 'store'])->name('recipes.store');
    Route::delete('admin/recipes/delete/{id}', [AdminRecipesController::class, 'delete'])->name('recipes.delete'); // recepto istrinimas
});

Route::middleware('auth')->group(function () {
    Route::get('ingredients', [AdminIngredientsController::class, 'index']);
    Route::get('ingredients/{id}', [AdminIngredientsController::class, 'show'])->name('ingredient');
    Route::get('admin/ingredients/create', [AdminIngredientsController::class, 'create']);
    Route::post('admin/ingredients/create', [AdminIngredientsController::class, 'store']);
    Route::any('admin/ingredients/edit/{id}', [AdminIngredientsController::class, 'edit'])->name('ingredients.edit');
    Route::delete('admin/ingredients/delete/{id}', [AdminIngredientsController::class, 'delete'])->name('ingredients.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('categories', [AdminCategoryController::class, 'index']);
    Route::get('categories/{id}', [AdminCategoryController::class, 'show'])->name('category');
    Route::get('admin/categories/create', [AdminCategoryController::class, 'create']);
    Route::post('admin/categories/create', [AdminCategoryController::class, 'store']);
    Route::any('admin/categories/edit/{id}', [AdminCategoryController::class, 'edit'])->name('category.edit');
    Route::delete('admin/categories/delete/{id}', [AdminCategoryController::class, 'delete'])->name('category.delete');
});

require __DIR__.'/auth.php';
