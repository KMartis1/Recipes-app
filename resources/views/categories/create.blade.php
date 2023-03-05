@extends('components.RecipeMain.layout')

@section('Title', 'Create category')
@section('content')
    <h3>Create new category</h3>

    @if ($message = Session::get('success'))
        <div>{{ $message }}</div>
    @endif

    <form action="{{ url('admin/categories/create') }}" method="post" class="row g-3">

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
            <div class="form-group">
                <label class="form-label">Category name:</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Category name">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <input type="checkbox" name="is_active" value="1" class="form-check-input" @if (old('is_active')) checked @endif>
                <label class="form-label">Active</label>
            </div>
            <div class="col-12">
                <button type="submit" >Save</button>
            </div>

    </form>
@endsection
