<x-layout>
    <div class="max-w-5xl mx-auto py-12 px-6">
        <h1 class="text-3xl font-black text-gray-900 mb-8 uppercase tracking-tight">
            Your <span class="text-red-600">Shopping Cart</span>
        </h1>

        @if($cart && $cart->items->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-4">
             @foreach($cart->items as $item)
    <div class="flex items-center gap-4 bg-white p-4 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
        <div class="w-20 h-20 bg-gray-50 rounded-xl overflow-hidden flex-shrink-0">
            <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover">
        </div>

        <div class="flex-grow">
            <h3 class="font-bold text-gray-900">{{ $item->product->name }}</h3>
            <p class="text-sm text-gray-500">${{ number_format($item->product->price, 2) }}</p>
        </div>

<div class="flex items-center gap-3 bg-gray-100 rounded-full px-2 py-1">
    <form action="{{ route('cart.update', $item->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="action" value="decrease">
        <button type="submit" class="w-8 h-8 flex items-center justify-center bg-white rounded-full shadow-sm hover:bg-red-50 text-gray-600 transition">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4"></path></svg>
        </button>
    </form>

    <span class="text-sm font-black text-gray-900 w-6 text-center">{{ $item->quantity }}</span>

    <form action="{{ route('cart.update', $item->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="action" value="increase">
        <button type="submit" class="w-8 h-8 flex items-center justify-center bg-white rounded-full shadow-sm hover:bg-blue-50 text-gray-600 transition">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
        </button>
    </form>
</div>

        <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="ml-4">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-gray-400 hover:text-red-500 transition p-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </form>
    </div>
@endforeach
                </div>

                <div class="bg-gray-900 text-white p-8 rounded-3xl h-fit sticky top-24 shadow-xl">
                    <h2 class="text-xl font-bold mb-6">Order Summary</h2>

                    <div class="space-y-4 border-b border-gray-800 pb-6 mb-6">
                        <div class="flex justify-between text-gray-400">
                            <span>Subtotal</span>
                            <span>${{ number_format($cart->items->sum(fn($i) => $i->quantity * $i->product->price), 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-400">
                            <span>Shipping</span>
                            <span class="text-green-500">Free</span>
                        </div>
                    </div>

                    <div class="flex justify-between text-xl font-black mb-8">
                        <span>Total</span>
                        <span class="text-red-500">${{ number_format($cart->items->sum(fn($i) => $i->quantity * $i->product->price), 2) }}</span>
                    </div>

                    <button class="w-full bg-red-600 hover:bg-red-700 text-white py-4 rounded-xl font-bold transition-all shadow-lg shadow-red-900/40">
                        Checkout Now
                    </button>
                </div>

            </div>
        @else
            <div class="text-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                <div class="text-gray-300 mb-4 flex justify-center">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <h2 class="text-xl font-bold text-gray-900">Your cart is empty</h2>
                <p class="text-gray-500 mb-6">Looks like you haven't added anything yet.</p>
                <a href="/" class="inline-block bg-gray-900 text-white px-8 py-3 rounded-full font-bold hover:bg-red-600 transition">Start Shopping</a>
            </div>
        @endif
    </div>
</x-layout>
