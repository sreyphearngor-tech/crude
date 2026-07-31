@extends('layouts.app')

@section('content')
    <div
        class="max-w-md mx-auto bg-white min-h-screen shadow-md rounded-lg overflow-hidden flex flex-col justify-between p-6">
        <div>
            <!-- Back Button & Header -->
            <div class="flex items-center justify-between mb-8">
                <a href="{{ route('cart.index') }}" class="text-gray-800 hover:text-black">
                    <i class="fa-solid fa-arrow-left text-lg"></i>
                </a>
                <h2 class="text-lg font-bold text-gray-800">Checkout</h2>
                <div class="relative">
                    <i class="fa-solid fa-cart-shopping text-lg text-gray-800"></i>
                    <span
                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full text-xs w-4 h-4 flex items-center justify-center">
                        {{ count(session('cart', [])) }}
                    </span>
                </div>
            </div>

            <!-- Progress Tracker -->
            <div class="flex items-center justify-between px-4 mb-10">
                <div class="flex flex-col items-center">
                    <div
                        class="w-8 h-8 rounded-full bg-black text-white flex items-center justify-center text-sm font-bold">
                        <i class="fa-solid fa-box"></i>
                    </div>
                    <span class="text-xs mt-1 font-semibold">Shipping</span>
                </div>
                <div class="flex-1 h-0.5 bg-gray-200 mx-2 mb-4"></div>
                <div class="flex flex-col items-center">
                    <div
                        class="w-8 h-8 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center text-sm font-bold">
                        <i class="fa-solid fa-credit-card"></i>
                    </div>
                    <span class="text-xs mt-1 text-gray-400">Payment</span>
                </div>
                <div class="flex-1 h-0.5 bg-gray-200 mx-2 mb-4"></div>
                <div class="flex flex-col items-center">
                    <div
                        class="w-8 h-8 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center text-sm font-bold">
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>
                    <span class="text-xs mt-1 text-gray-400">Review</span>
                </div>
            </div>

            <h3 class="text-center font-bold text-gray-800 mb-6">Enter Shipping Details</h3>

            <!-- Form Details -->
            <form id="shipping-form" action="{{ route('checkout.shipping.save') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Full Name*</label>
                    <input type="text" name="full_name" placeholder="Enter Full Name" required
                        class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-black">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Phone Number*</label>
                    <input type="text" name="phone_number" placeholder="+92 | Enter number" required
                        class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-black">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Select Province</label>
                    <select name="province" required
                        class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-black">
                        <option value="">Choose Province</option>
                        <option value="Phnom Penh">Phnom Penh</option>
                        <option value="Siem Reap">Siem Reap</option>
                        <option value="Battambang">Battambang</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Select City</label>
                    <select name="city" required
                        class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-black">
                        <option value="">Choose City</option>
                        <option value="Daun Penh">Daun Penh</option>
                        <option value="Boeung Keng Kang">Boeung Keng Kang</option>
                        <option value="Tuol Kouk">Tuol Kouk</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Street Address*</label>
                    <input type="text" name="street_address" placeholder="Enter street address" required
                        class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-black">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Postal Code*</label>
                    <input type="text" name="postal_code" placeholder="Enter postal code" required
                        class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-black">
                </div>
            </form>
        </div>

        <div class="mt-8">
            <button type="submit" form="shipping-form"
                class="w-full bg-black text-white py-4 rounded-full font-bold uppercase text-sm hover:bg-gray-900 transition">
                Confirm
            </button>
        </div>
    </div>
@endsection
