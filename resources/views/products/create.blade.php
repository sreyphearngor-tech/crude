<x-layout>
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('products.form')
        <button type="submit">Submit</button>
    </form>
</x-layout>