@extends('components.RecipeMain.layout')

@section('title', 'Edit '. $category->name)

@section('content')
    <h1>Category {{ $category->name }} edit form</h1>

    <form action="{{ route('category.edit', ['id' => $category->id]) }}" method="post" class="row g-3">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @csrf
        <div class="col-12">
            <label class="form-label">Category name:</label>
            <input type="text" name="name" placeholder="Category name" value="{{ old("name", $category->name) }}" class="form-control @error('name') is-invalid @enderror">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" @if ($category->is_active) checked @endif>
            <label class="form-check-label">Active?</label>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-info">Save</button>
        </div>
    </form>
@endsection
