@extends('layouts.app')

@section('content')
    <div
        class="max-w-md mx-auto bg-white min-h-screen shadow-md rounded-lg overflow-hidden flex flex-col justify-between p-6">
        <div>
            <!-- Back Button & Header -->
            <div class="flex items-center justify-between mb-8">
                <a href="{{ route('checkout.payment') }}" class="text-gray-800 hover:text-black">
                    <i class="fa-solid fa-arrow-left text-lg"></i>
                </a>
                <h2 class="text-lg font-bold text-gray-800">Checkout</h2>
                <div class="relative">
                    <i class="fa-solid fa-cart-shopping text-lg text-gray-800"></i>
                    <span
                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full text-xs w-4 h-4 flex items-center justify-center">
                        {{ count($cart) }}
                    </span>
                </div>
            </div>

            <!-- Progress Tracker -->
            <div class="flex items-center justify-between px-4 mb-8">
                <div class="flex flex-col items-center">
                    <div
                        class="w-8 h-8 rounded-full bg-black text-white flex items-center justify-center text-sm font-bold">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <span class="text-xs mt-1 text-gray-400">Shipping</span>
                </div>
                <div class="flex-1 h-0.5 bg-black mx-2 mb-4"></div>
                <div class="flex flex-col items-center">
                    <div
                        class="w-8 h-8 rounded-full bg-black text-white flex items-center justify-center text-sm font-bold">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <span class="text-xs mt-1 text-gray-400">Payment</span>
                </div>
                <div class="flex-1 h-0.5 bg-black mx-2 mb-4"></div>
                <div class="flex flex-col items-center">
                    <div
                        class="w-8 h-8 rounded-full bg-black text-white flex items-center justify-center text-sm font-bold">
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>
                    <span class="text-xs mt-1 font-semibold">Review</span>
                </div>
            </div>

            <!-- Product List inside Cart -->
            <div class="space-y-4 mb-8 max-h-[320px] overflow-y-auto pr-1">
                @foreach ($cart as $item)
                    <div class="flex items-center gap-4 border border-gray-100 rounded-2xl p-4 shadow-sm bg-white relative">
                        <img src="{{ asset('storage/' . $item['image']) }}" class="w-16 h-16 object-contain rounded-lg"
                            alt="{{ $item['name'] }}">
                        <div class="flex-1">
                            <h4 class="font-bold text-sm text-gray-800">{{ $item['name'] }}</h4>
                            <p class="text-xs text-gray-400">Limited Stock</p>
                            <p class="text-sm font-bold mt-1">${{ number_format($item['price'], 2) }}</p>
                        </div>
                        <div
                            class="flex items-center gap-3 bg-gray-150 px-3 py-1.5 rounded-full border border-gray-250 text-sm">
                            <span class="font-bold text-gray-800">{{ $item['quantity'] }} x</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Pricing Area & Form Submission -->
        <div class="border-t border-gray-100 pt-6">
            <div class="space-y-3 mb-6">
                <div class="flex justify-between text-sm text-gray-500">
                    <span>Total</span>
                    <span class="font-bold text-gray-800">${{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="flex justify-between text-sm text-gray-500">
                    <span>Shipping Fee</span>
                    <span class="font-bold text-gray-800">${{ number_format($shippingFee, 2) }}</span>
                </div>
                <div class="border-b border-gray-100 my-2"></div>
                <div class="flex justify-between items-center">
                    <span class="text-lg font-bold text-gray-800">Subtotal</span>
                    <span class="text-xl font-black text-gray-800">${{ number_format($total, 2) }}</span>
                </div>
            </div>

            <!-- Confirm Action -->
            <form action="{{ route('checkout.confirm') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full bg-black text-white py-4 rounded-full font-bold uppercase text-sm hover:bg-gray-900 transition">
                    Confirm Order
                </button>
            </form>
        </div>
    </div>
@endsection
