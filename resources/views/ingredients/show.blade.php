@extends('components.RecipeMain.layout')

@section('title', $ingredient->name)

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $ingredient->name }}</h5>
        </div>
    </div>
@endsection
