@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 lg:px-10 py-16">
    <!-- Breadcrumb -->
    <div class="text-sm text-gray-400 mb-12">
        Account / My Account / Product / View Cart / <span class="text-black font-medium">CheckOut</span>
    </div>

    <h2 class="text-4xl font-medium mb-12 tracking-wide">Billing Details</h2>

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="flex flex-col lg:flex-row gap-24">

            <!-- ផ្នែកខាងឆ្វេង: Billing Details Form -->
            <div class="w-full lg:w-1/2 space-y-8">
                <div>
                    <label class="block text-gray-400 mb-2">First Name<span class="text-exclusive-red">*</span></label>
                    <input type="text" name="first_name" required class="w-full bg-[#F5F5F5] border-none rounded py-3 px-4 focus:ring-1 focus:ring-gray-300">
                </div>

                <div>
                    <label class="block text-gray-400 mb-2">Company Name</label>
                    <input type="text" name="company_name" class="w-full bg-[#F5F5F5] border-none rounded py-3 px-4 focus:ring-1 focus:ring-gray-300">
                </div>

                <div>
                    <label class="block text-gray-400 mb-2">Street Address<span class="text-exclusive-red">*</span></label>
                    <input type="text" name="address" required class="w-full bg-[#F5F5F5] border-none rounded py-3 px-4 focus:ring-1 focus:ring-gray-300">
                </div>

                <div>
                    <label class="block text-gray-400 mb-2">Apartment, floor, etc. (optional)</label>
                    <input type="text" name="apartment" class="w-full bg-[#F5F5F5] border-none rounded py-3 px-4 focus:ring-1 focus:ring-gray-300">
                </div>

                <div>
                    <label class="block text-gray-400 mb-2">Town/City<span class="text-exclusive-red">*</span></label>
                    <input type="text" name="city" required class="w-full bg-[#F5F5F5] border-none rounded py-3 px-4 focus:ring-1 focus:ring-gray-300">
                </div>

                <div>
                    <label class="block text-gray-400 mb-2">Phone Number<span class="text-exclusive-red">*</span></label>
                    <input type="text" name="phone" required class="w-full bg-[#F5F5F5] border-none rounded py-3 px-4 focus:ring-1 focus:ring-gray-300">
                </div>

                <div>
                    <label class="block text-gray-400 mb-2">Email Address<span class="text-exclusive-red">*</span></label>
                    <input type="email" name="email" required class="w-full bg-[#F5F5F5] border-none rounded py-3 px-4 focus:ring-1 focus:ring-gray-300">
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" name="save_info" id="save_info" class="w-5 h-5 accent-exclusive-red">
                    <label for="save_info" class="text-sm cursor-pointer">Save this information for faster check-out next time</label>
                </div>
            </div>

            <!-- ផ្នែកខាងស្តាំ: Order Summary & Payment -->
            <div class="w-full lg:w-[450px] pt-4">
                <div class="space-y-8">

                    <!-- បញ្ជីទំនិញសង្ខេប -->
                    <div class="space-y-6">
                        @foreach($cartItems as $item)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-5">
                                <div class="w-14 h-14 flex items-center justify-center overflow-hidden">
                                    <img src="{{ asset($item->product->image) }}" class="max-h-full object-contain">
                                </div>
                                <span class="text-base">{{ $item->product->name }}</span>
                            </div>
                            <span class="font-medium">${{ number_format($item->product->price * $item->quantity) }}</span>
                        </div>
                        @endforeach
                    </div>

                    <!-- តារាងសរុបប្រាក់ -->
                    <div class="space-y-4 border-b border-gray-300 pb-4">
                        <div class="flex justify-between">
                            <span>Subtotal:</span>
                            <span>${{ number_format($total) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Shipping:</span>
                            <span>Free</span>
                        </div>
                        <div class="flex justify-between font-medium text-lg pt-2">
                            <span>Total:</span>
                            <span>${{ number_format($total) }}</span>
                        </div>
                    </div>

                    <!-- វិធីសាស្ត្របង់ប្រាក់ -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <input type="radio" name="payment_method" value="bank" id="payment_bank" class="w-5 h-5 accent-black">
                                <label for="payment_bank" class="cursor-pointer">Bank</label>
                            </div>
                            <div class="flex gap-2">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/d/d6/Visa_2021.svg" class="h-4">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" class="h-6">
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <input type="radio" name="payment_method" value="cod" id="payment_cod" checked class="w-5 h-5 accent-black">
                            <label for="payment_cod" class="cursor-pointer">Cash on delivery</label>
                        </div>
                    </div>

                    <!-- Coupon Code -->
                    <div class="flex gap-4">
                        <input type="text" placeholder="Coupon Code" class="flex-1 border border-black rounded py-3 px-6 focus:outline-none">
                        <button type="button" class="bg-exclusive-red text-white px-10 py-3 rounded hover:bg-red-600 transition">Apply Coupon</button>
                    </div>

                    <!-- ប៊ូតុងបញ្ជាទិញ -->
                    <button type="submit" class="bg-exclusive-red text-white px-12 py-4 rounded font-medium hover:bg-red-600 transition inline-block">
                        Place Order
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
