@extends('components.RecipeMain.layout')

@section('content')
    <h3>Create new ingredient</h3>

    <form action="{{ url('admin/ingredients/create') }}" method="post">

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
        <input type="text" name="name" placeholder="first name"><br>

            <div class="form-group">
                <input type="checkbox" name="is_active" value="1" class="form-check-input" @if (old('is_active')) checked @endif>
                <label class="form-label">Active</label>
            </div>

        <button type="submit">Save</button>
    </form>
@endsection
