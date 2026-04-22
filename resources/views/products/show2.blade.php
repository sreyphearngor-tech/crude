<x-layout>
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4">

    <div class="max-w-5xl w-full bg-white shadow-2xl rounded-3xl overflow-hidden flex flex-col md:flex-row border border-gray-100">

        <div class="w-full md:w-1/2 bg-gray-100 relative group overflow-hidden">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-80 md:h-full object-cover transition-transform duration-500 group-hover:scale-105">
            @else
                <div class="w-full h-80 md:h-full flex flex-col items-center justify-center text-gray-400 bg-gray-200">
                    <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="font-medium">No Image Available</span>
                </div>
            @endif

            @if($product->qty > 0)
                <span class="absolute top-4 left-4 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">In Stock</span>
            @else
                <span class="absolute top-4 left-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Out of Stock</span>
            @endif
        </div>

        <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">

            <nav class="text-sm text-gray-400 mb-4 uppercase tracking-widest font-semibold">
                Product Details
            </nav>

            <h2 class="text-4xl font-extrabold text-gray-900 leading-tight">
                {{ $product->name }}
            </h2>

            <p class="text-sm text-gray-400 mt-1">
                Reference ID: <span class="font-mono text-gray-600">#{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</span>
            </p>

            <div class="mt-6 flex items-baseline gap-4">
                <span class="text-4xl font-bold text-blue-600">
                    ${{ number_format($product->price, 2) }}
                </span>
                @if($product->old_price) <span class="text-xl text-gray-400 line-through">${{ number_format($product->old_price, 2) }}</span>
                @endif
            </div>

            <div class="mt-6 space-y-3">
                <div class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    <span>Availability: <span class="font-bold {{ $product->qty > 0 ? 'text-green-600' : 'text-red-600' }}">{{ $product->qty }} units</span></span>
                </div>
            </div>

            <div class="mt-8 border-t border-gray-100 pt-8 flex flex-col sm:flex-row gap-4">
                <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" @disabled($product->qty <= 0) class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl transition-all shadow-lg hover:shadow-blue-200 disabled:bg-gray-300 disabled:shadow-none">
                        {{ $product->qty > 0 ? 'Add to Shopping Bag' : 'Out of Stock' }}
                    </button>
                </form>

                <a href="{{ route('products.home') }}"
                   class="flex items-center justify-center bg-white border-2 border-gray-200 hover:border-gray-900 hover:text-gray-900 text-gray-500 px-6 py-4 rounded-xl font-bold transition-all">
                    Back
                </a>
            </div>

        </div>

    </div>

</div>
</x-layout>
