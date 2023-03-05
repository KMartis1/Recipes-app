@extends('components.RecipeMain.layout')

@section('title', 'Books')


@section('content')
    <h3>Create new recipe</h3>

    <form action="{{ route('recipes.store') }}" method="post" class="row g-3" enctype="multipart/form-data">
        @csrf
        <div class="col-12">
            <label class="form-label">Recipe name:</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Recipe name">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label class="form-label">Ingredients:</label>
            <select name="ingredient_id[]" class="form-control" multiple>
                @foreach($ingredients as $ingredient)
                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12">
            <label class="form-label">Category:</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12">
            <label class="form-label">Description:</label>
            <input type="text" name="description" value="{{ old('description') }}" class="form-control @error('description') is-invalid @enderror" placeholder="Description">
            @error('page_count')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label class="form-label">Image:</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="form-group">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" @if (old('is_active')) checked @endif>
            <label class="form-label">Active</label>
        </div>

        <div class="col-12 mt-2">
            <button type="submit" class="btn btn-info">Save</button>
        </div>
    </form>
@endsection
