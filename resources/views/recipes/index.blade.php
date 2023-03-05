@extends('components.RecipeMain.layout')

@section('title', 'All recipes')

@section('content')
    <h1>Recipes</h1>

    @include('components.alert.success_message')

    <div class="row">


        <form action="{{ url('recipes') }}" method="get">

            <div class="col-12">
                <label class="form-label">Recipe name:</label>
                <input type="text" name="name" class="form-control" placeholder="Recipe name">
            </div>

            <div class="col-12">
                <label class="form-label">Category:</label>
                <select name="category_id" class="form-control">
                    <option>All</option>
                    @foreach($categories as $category)
                        <option
                            @if($category->id == $category_id) selected @endif
                        value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="inlin">
                <div class="col-12 mt-2 mb-3">
                    <button type="submit" class="btn btn-info bold">Filter</button>
                    <a href="{{ url('recipes') }}" class="btn btn-secondary">clear</a>
                </div>
            </div>
        </form>

        @if(auth()->check() && auth()->user()->role === 'Admin')
        <div class="col">
            <a href="{{ url('admin/recipes/create') }}" class="btn btn-primary">Create</a>
        </div>
        @endif
    </div>

    <table class="table">
        <tr>
            <th scope="col" width="100">ID</th>
            <th scope="col">No.</th>
            <th scope="col">Name</th>
            <th scope="col">Image</th>
            <th scope="col">Ingredient</th>
            <th scope="col">Category</th>
            <th scope="col">Description</th>
            @if(auth()->check() && auth()->user()->role === 'Admin')
                <th scope="col" width="100">Edit</th>
                <th scope="col" width="100">Delete</th>
            @endif
        </tr>
            @foreach($recipes->items() as $recipe)
                <tr>
                    <th scope="row">{{ $recipe->id }}</th>
                    <td>{{ ($recipes->currentPage() - 1) * $recipes->perPage() + $loop->iteration }}</td>
                    <td>
                        <a href="{{ url('recipes', ['id' => $recipe->id]) }}">{{ $recipe->name }}</a>
                    </td>
                    <td>
                        @if($recipe->image)
                            <img src="{{ asset($recipe->image) }}" style="width: 248px;">
                        @else
                            No image
                        @endif
                    </td>
                    <td>
                        @if ($recipe->ingredients)
                            {{ implode(', ', $recipe->ingredients->pluck('name')->toArray()) }}
                        @endif
                    </td>
                    <td>
                        @if($recipe->category)
                            {{ $recipe->category->name }}
                        @endif
                    </td>
                    <td>{{ $recipe->description }}</td>
                    @if(auth()->check() && auth()->user()->role === 'Admin')
                    <td>
                        <a href="{{ route('recipes.edit', ['id' => $recipe->id]) }}" class="btn btn-info">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('recipes.delete', ['id' => $recipe->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
    </table>
    <div class="row">
        <div class="col">
            {{ $recipes->links() }}
        </div>
    </div>
@endsection
