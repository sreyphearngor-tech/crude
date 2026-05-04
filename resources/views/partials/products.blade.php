@foreach($products as $product)
    <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col overflow-hidden">

        {{-- Product Image Section --}}
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

        {{-- Product Info Section --}}
        <div class="p-5 flex flex-col flex-grow">
            <span class="text-[10px] font-bold text-pink-500 uppercase tracking-widest mb-1">New Arrival</span>

            <a href="{{ route('product.show2', $product->id) }}" class="!no-underline text-gray-800 font-bold text-lg leading-tight hover:text-red-600 transition line-clamp-1 mb-2">
                {{ $product->name }}
            </a>

            <div class="flex items-end justify-between mb-4">
                <div class="flex flex-col">
                    <span class="text-2xl font-black text-gray-900">${{ number_format($product->price, 2) }}</span>
                </div>
                <span class="text-[11px] text-gray-400 font-medium">Stock: {{ $product->qty }}</span>
            </div>

            <div class="mt-auto space-y-2">
                @auth
                    {{-- User is Logged In: Show Add to Bag --}}
                    @if($product->qty > 0)
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-xl font-black uppercase tracking-widest text-xs hover:bg-red-700 transition shadow-lg shadow-red-900/20">
                                Add to Bag
                            </button>
                        </form>
                    @else
                        <button disabled class="w-full bg-gray-200 text-gray-400 py-3 rounded-xl font-black uppercase tracking-widest text-xs cursor-not-allowed">
                            Unavailable
                        </button>
                    @endif
                @else
                    {{-- User is Guest: Show Login Redirect --}}
                    <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full bg-gray-900 text-white py-3 rounded-xl font-black uppercase tracking-widest text-[10px] hover:bg-gray-800 transition !no-underline">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Login to Purchase
                    </a>
                @endauth

                <a href="{{ route('product.show2', $product->id) }}"
                   class="!no-underline block text-center text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-red-600 transition py-1">
                    View Detail
                </a>
            </div>
        </div>
    </div>
@endforeach
