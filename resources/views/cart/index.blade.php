@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 md:px-12 lg:px-24 py-10">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-400 mb-10">
        <a href="{{ route('home') }}" class="hover:text-black">Home</a> / <span class="text-black">Cart</span>
    </nav>

    @if(session('cart') && count(session('cart')) > 0)
        <!-- Table Header -->
        <div class="grid grid-cols-4 bg-white shadow-sm rounded-sm p-6 mb-6 font-medium text-gray-800 hidden md:grid">
            <div>Product</div>
            <div class="text-center">Price</div>
            <div class="text-center">Quantity</div>
            <div class="text-right">Subtotal</div>
        </div>

        <!-- Cart Items -->
        <div class="space-y-6">
            @foreach(session('cart') as $id => $details)
                <div class="grid grid-cols-1 md:grid-cols-4 items-center bg-white shadow-sm rounded-sm p-6 relative group border border-transparent hover:border-gray-100 transition">

                    <!-- Product & Remove Button -->
                    <div class="flex items-center gap-4 relative">
                        <form action="{{ route('cart.remove') }}" method="POST" class="absolute -top-8 -left-8 opacity-0 group-hover:opacity-100 transition-all">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button type="submit" class="bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs shadow-md">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </form>

                        <div class="w-14 h-14 flex-shrink-0">
                            <img src="{{ asset('storage/' . $details['image']) }}" class="w-full h-full object-contain">
                        </div>
                        <span class="text-gray-800 font-normal">{{ $details['name'] }}</span>
                    </div>

                    <!-- Price -->
                    <div class="text-center text-gray-800 hidden md:block">
                        ${{ $details['price'] }}
                    </div>

                    <!-- Quantity Selector -->
                    <div class="flex justify-center mt-4 md:mt-0">
                        <div class="relative inline-block w-20">
                            <input type="number"
                                   value="{{ str_pad($details['quantity'], 2, '0', STR_PAD_LEFT) }}"
                                   min="1"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none update-cart"
                                   data-id="{{ $id }}">
                        </div>
                    </div>

                    <!-- Subtotal -->
                    <div class="text-right text-gray-800 font-medium mt-4 md:mt-0">
                        ${{ $details['price'] * $details['quantity'] }}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col md:flex-row justify-between mt-8 gap-4">
            <a href="{{ route('home') }}" class="border border-gray-400 px-10 py-4 rounded-sm font-medium hover:bg-gray-50 transition text-center">
                Return To Shop
            </a>
            <button onclick="window.location.reload()" class="border border-gray-400 px-10 py-4 rounded-sm font-medium hover:bg-gray-50 transition text-center">
                Update Cart
            </button>
        </div>

        <!-- Coupon & Cart Total Area -->
        <div class="flex flex-col lg:flex-row justify-between mt-20 gap-10 items-start">

            <!-- Coupon Code -->
            <div class="flex flex-col md:flex-row gap-4 w-full lg:w-1/2">
                <input type="text" placeholder="Coupon Code" class="border border-black rounded-sm px-6 py-4 w-full md:w-72 focus:outline-none">
                <button class="bg-red-500 text-white px-10 py-4 rounded-sm font-medium hover:bg-red-600 transition">
                    Apply Coupon
                </button>
            </div>

            <!-- Cart Total Card -->
            <div class="w-full lg:w-[400px] border-2 border-black rounded-md p-8">
                <h3 class="text-xl font-bold mb-8">Cart Total</h3>

                @php $total = 0 @endphp
                @foreach(session('cart') as $item) @php $total += $item['price'] * $item['quantity'] @endphp @endforeach

                <div class="space-y-4">
                    <div class="flex justify-between border-b border-gray-300 pb-4">
                        <span>Subtotal:</span>
                        <span>${{ $total }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-300 pb-4">
                        <span>Shipping:</span>
                        <span class="text-gray-500">Free</span>
                    </div>
                    <div class="flex justify-between font-bold text-lg pt-2">
                        <span>Total:</span>
                        <span>${{ max(0, $total - session('coupon.discount', 0)) }}</span>
                    </div>
                </div>

                <form action="{{ route('cart.checkout') }}" method="POST" class="mt-8 text-center">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-12 py-4 rounded-sm font-medium hover:bg-red-600 transition inline-block">
                        Process to checkout
                    </button>
                </form>
            </div>
        </div>

    @else
        <div class="text-center py-20 bg-white shadow-sm rounded-sm border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-400 mb-8 uppercase tracking-widest">Your Cart is Empty</h2>
            <a href="{{ route('home') }}" class="bg-red-500 text-white px-12 py-4 rounded-sm font-medium hover:bg-red-600 transition">
                Go Shopping
            </a>
        </div>
    @endif
</div>

<!-- AJAX Update Logic -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(".update-cart").on('change keyup', function (e) {
        let id = $(this).data("id");
        let qty = $(this).val();

        if(qty > 0) {
            $.ajax({
                url: '{{ route("cart.update") }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    quantity: qty
                },
                success: function (response) {
                    // Update Subtotal ភ្លាមៗ ឬ Reload
                    window.location.reload();
                }
            });
        }
    });
</script>
@endsection
