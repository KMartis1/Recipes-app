@extends('components.RecipeMain.layout')

@section('content')
    <h3>Edit recipe</h3>

    <form action="{{ url('admin/recipes/edit', ['id' => $recipe->id]) }}" method="post" class="row g-3" enctype="multipart/form-data">
        @csrf
        <div class="col-12">
            <label class="form-label">Recipe name:</label>
            <input type="text" name="name" value="{{ old('name', $recipe->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Recipe name">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label class="form-label">Ingredient:</label>
            <select name="ingredient_id[]" class="form-control @error('ingredient_id') is-invalid @enderror" multiple>
                @foreach($ingredients as $ingredient)
                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                @endforeach
            </select>
            @error('ingredient_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-12">
            <label class="form-label">Category:</label>
            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                <option value="">-</option>
                @foreach($categories as $category)
                    <option @if(old('category_id', isset($recipe->category->id) ? $recipe->category->id : null) == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-12">
            <label class="form-label">Description:</label>
            <input type="text" name="description" value="{{ old('description', $recipe->description) }}" class="form-control @error('description') is-invalid @enderror" placeholder="Description">
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label class="form-label">Image:</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="form-group">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" @if ($recipe->is_active) checked @endif>
            <label class="form-label">Active</label>
        </div>

        <div class="col-12 mt-2">
            <button type="submit" class="btn btn-info">Save</button>
        </div>
    </form>
@endsection
