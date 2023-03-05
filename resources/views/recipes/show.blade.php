@extends('components.RecipeMain.layout')

@section('title', $recipes->name)

@section('content')
    <a href="{{ route('recipes') }}" class="btn btn-dark"><- back to all</a>
    <h1>
        {{ $recipes->name }}
    </h1>
        @if($recipes->image)
            <img src="{{ asset($recipes->image) }}" style="width: 248px;">
        @else No image
        @endif
    <h2> {{ $recipes->category->name }}</h2>
    <h3>
        @if ($recipes->ingredients)
            {{ implode(', ', $recipes->ingredients->pluck('name')->toArray()) }}.
        @endif
    </h3>

    <p> {{ $recipes->description }}</p>

@endsection
