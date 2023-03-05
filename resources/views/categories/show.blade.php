@extends('components.RecipeMain.layout')
@section('title', $category->name)

@section('content')
    <a href="{{ url('categories') }}" class="btn btn-dark"><- back to all</a>
    <br>
    <br>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $category->name }}</h3>
            <p class="card-text">
                <span class="font-weight-bold">Is active?</span>
                <span class="d-inline @if($category->is_active == 1) text-success @else text-danger @endif">
            {{ $category->is_active == 1 ? 'Yes' : 'No' }}
        </span>
            </p>
        </div>
    </div>
    <br>

    <h4>Recipes:</h4><br>

    @foreach($category->recipes as $recipe)
        <div>
            <p><strong>{{ $recipe->name }}</strong></p>
            @if ($recipe->ingredients->count() > 0)
                <p>Ingredients: {{ $recipe->ingredients->implode('name', ', ') }}.</p>
            @else
                <p>Ingredients: <span class="text-danger">No ingredients provided.</span></p>
            @endif
        </div>
    @endforeach
@endsection
