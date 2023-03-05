@extends('components.RecipeMain.layout')
@section('title', 'Categories')

@section('content')
    <h1>Categories</h1>

    @include('components.alert.success_message')

    <div class="row">
        <div class="col">
            <a href="{{ url('admin/categories/create') }}" class="btn btn-primary">Create</a>
        </div>
    </div>

    <table class="table">
        <tr>
            <th scope="col" width="100">ID</th>
            <th scope="col">No.</th>
            <th scope="col">Name</th>
            <th scope="col" width="800">Is active?</th>
            <th scope="col" width="100">Edit</th>
            <th scope="col" width="100">Delete</th>
        </tr>
        @foreach($categories as $category)
            <tr>
                <th scope="row">{{ $category->id }}</th>
                <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</td>
                <td>
                    <a href="{{ url('categories', ['id' => $category->id]) }}">{{ $category->name }}</a>
                </td>

                <td>
                    @if ($category->is_active == 1)
                        <p class="text-success">active</p>
                    @else
                        <p class="text-danger">deactivated</p>
                    @endif
                </td>

                <td>
                    <a href="{{ route('category.edit', ['id' => $category->id]) }}" class="btn btn-info">Edit</a>
                </td>
                <td>
                    <form action="{{ route('category.delete', ['id' => $category->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="row">
        <div class="col">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
