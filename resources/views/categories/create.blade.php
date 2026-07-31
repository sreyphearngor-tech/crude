@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <h2>Create Category</h2>

        @if ($errors->any())
            <div class="alert alert-danger" style="color: red; margin-bottom: 15px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.category.store') }}">
            @csrf

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="name">Category Name</label><br>
                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Category name"
                    class="form-control">
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="image">Category Image</label><br>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>

    </div>
@endsection
