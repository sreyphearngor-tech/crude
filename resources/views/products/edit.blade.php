<x-layout>
    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('products.form')
        <button type="submit">Update</button>
    </form>
  </x-layout>