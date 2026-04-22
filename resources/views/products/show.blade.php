<x-layout>

<div class="min-h-screen bg-gray-100 flex items-center justify-center py-10">

    <div class="max-w-4xl w-full bg-white shadow-xl rounded-2xl overflow-hidden flex">

        <!-- Image -->
        <div class="w-1/2 bg-gray-200">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-500">
                    No Image
                </div>
            @endif
        </div>

        <!-- Details -->
        <div class="w-1/2 p-8 space-y-4">

            <h2 class="text-3xl font-bold text-gray-800">
                {{ $product->name }}
            </h2>

            <p class="text-gray-500">
                Product ID: #{{ $product->id }}
            </p>

            <h3 class="text-green-600 text-2xl font-semibold">
                ${{ number_format($product->price,2) }}
            </h3>

            <p class="text-gray-700">
                Quantity: {{ $product->qty }}
            </p>

            <!-- Buttons -->
            <div class="flex gap-3 pt-6">

                <a href="{{ route('product.home') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                    Back
                </a>


                <form action="{{ route('product.destroy',$product->id) }}" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')

                    <button onclick="return confirm('Delete this product?')"
                        class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg">
                        Delete
                    </button>
                </form>
            </div>

        </div>

    </div>

</div>

</x-layout>
