@foreach($products as $product)
    <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col overflow-hidden">

        <div class="relative aspect-[4/5] overflow-hidden bg-gray-50">
            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x500' }}"
                 alt="{{ $product->name }}"
                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

            @if($product->qty <= 0)
                <div class="absolute inset-0 bg-black/20 flex items-center justify-center">
                    <span class="bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-red-600 uppercase">Out of Stock</span>
                </div>
            @endif

            <button class="absolute top-3 right-3 p-2 bg-white/80 backdrop-blur rounded-full text-gray-400 hover:text-red-500 transition shadow-sm">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"></path></svg>
            </button>
        </div>

        <div class="p-5 flex flex-col flex-grow">
            <span class="text-[10px] font-bold text-pink-500 uppercase tracking-widest mb-1">New Arrival</span>

            <a href="{{ route('product.show2', $product->id) }}" class=" !no-underline  text-gray-800 font-bold text-lg leading-tight hover:text-blue-600 transition line-clamp-1 mb-2">
                {{ $product->name }}
            </a>

            <div class="flex items-end justify-between mb-4">
                <div class="flex flex-col">
                    <span class="text-2xl font-black text-gray-900">${{ number_format($product->price, 2) }}</span>
                </div>
                <span class="text-[11px] text-gray-400 font-medium">Stock: {{ $product->qty }}</span>
            </div>

            <div class="mt-auto space-y-2">
               <form action="{{ route('cart.add') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <button type="submit"
            class="flex items-center justify-center gap-2 w-full bg-gray-900 text-white py-3 rounded-xl text-sm font-bold hover:bg-pink-500 transition-all duration-300 shadow-md">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Add to Cart
    </button>
</form>

                <a href="{{ route('product.show2', $product->id) }}"
                   class=" !no-underline  block text-center text-xs font-bold text-gray-400 hover:text-gray-600 transition py-1">
                    View Detail
                </a>
            </div>
        </div>
    </div>
@endforeach
