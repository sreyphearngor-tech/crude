@extends('layouts.app')

@section('content')
<div class="container">

<h2>Edit Category</h2>

<form method="POST" enctype="multipart/form-data" action="{{ route('categories.update', $category->id) }}">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $category->name }}">

    <input type="file" name="image">

    @if($category->image)
        <img src="{{ asset('storage/'.$category->image) }}" width="80">
    @endif

    <button type="submit">Update</button>
</form>

</div>
@endsection
