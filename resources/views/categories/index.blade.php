@extends('layouts.app')

@section('content')
    <div class="container">

        <h2>Categories</h2>

        <a href="{{ route('admin.categories.create') }}">+ Add</a>

        @if (session('success'))
            <p style="color:green">{{ session('success') }}</p>
        @endif

        <table border="1" width="100%">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Action</th>
            </tr>

            @foreach ($categories as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>
                        @if ($cat->image)
                            <img src="{{ asset('storage/' . $cat->image) }}" width="50">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $cat->id) }}">Edit</a>

                        <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST"
                            style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $categories->links() }}

    </div>
@endsection
