<x-layout>
    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('products.form')

        <!-- Submit -->
        <div class="mt-6">
            <button type="submit"
                class="w-full py-3 bg-blue-500 text-white font-semibold rounded-2xl shadow-md hover:bg-blue-600">
                Update Product
            </button>
        </div>
    </form>
</x-layout>
