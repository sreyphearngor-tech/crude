@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 md:px-12 lg:px-24 py-10">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-400 mb-10">
        <a href="{{ route('home') }}" class="hover:text-black">Home</a> / <span class="text-black">Cart</span>
    </nav>

    @if(session('cart') && count(session('cart')) > 0)
        <!-- Table Header (Desktop Only) -->
        <div class="grid grid-cols-4 bg-white shadow-sm rounded-sm p-6 mb-6 font-medium text-gray-800 hidden md:grid border border-gray-100">
            <div>Product</div>
            <div class="text-center">Price</div>
            <div class="text-center">Quantity</div>
            <div class="text-right">Subtotal</div>
        </div>

        <!-- Cart Items -->
        <div class="space-y-6" id="cart-items-container">
            @php $total = 0 @endphp
            @foreach(session('cart') as $id => $details)
                @php
                    $rowSubtotal = $details['price'] * $details['quantity'];
                    $total += $rowSubtotal;
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-4 items-center bg-white shadow-sm rounded-sm p-6 relative group border border-transparent hover:border-gray-100 transition">

                    <!-- Product & Remove Button -->
                    <div class="flex items-center gap-4 relative">
                        <form action="{{ route('cart.remove') }}" method="POST" class="absolute -top-4 -left-4 md:-top-8 md:-left-8 opacity-0 group-hover:opacity-100 transition-all z-10">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button type="button" class="btn-remove bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs shadow-md">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </form>

                        <div class="w-14 h-14 flex-shrink-0">
                            <img src="{{ asset('storage/' . $details['image']) }}" class="w-full h-full object-contain" alt="{{ $details['name'] }}">
                        </div>
                        <span class="text-gray-800 font-normal">{{ $details['name'] }}</span>
                    </div>

                    <!-- Unit Price -->
                    <div class="text-center text-gray-800 hidden md:block">
                        ${{ number_format($details['price'], 2) }}
                    </div>

                    <!-- Quantity Input -->
                    <div class="flex justify-center mt-4 md:mt-0">
                        <div class="relative inline-block w-24">
                            <input type="number"
                                   value="{{ $details['quantity'] }}"
                                   min="1"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none update-cart text-center"
                                   data-id="{{ $id }}">
                        </div>
                    </div>

                    <!-- Row Subtotal -->
                    <div class="text-right text-gray-800 font-medium mt-4 md:mt-0">
                        $<span class="row-subtotal" data-id="{{ $id }}">{{ number_format($rowSubtotal, 2) }}</span>
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

        <!-- Coupon & Totals Area -->
        <div class="flex flex-col lg:flex-row justify-between mt-20 gap-10 items-start">
            <div class="flex flex-col md:flex-row gap-4 w-full lg:w-1/2">
                <input type="text" placeholder="Coupon Code" class="border border-black rounded-sm px-6 py-4 w-full md:w-72 focus:outline-none">
                <button class="bg-red-500 text-white px-10 py-4 rounded-sm font-medium hover:bg-red-600 transition">
                    Apply Coupon
                </button>
            </div>

            <!-- Cart Total Summary Card -->
            <div class="w-full lg:w-[400px] border-2 border-black rounded-md p-8 bg-white">
                <h3 class="text-xl font-bold mb-8">Cart Total</h3>
                <div class="space-y-4">
                    <div class="flex justify-between border-b border-gray-300 pb-4">
                        <span>Subtotal:</span>
                        <span class="font-medium">$<span id="cart-subtotal">{{ number_format($total, 2) }}</span></span>
                    </div>
                    <div class="flex justify-between border-b border-gray-300 pb-4">
                        <span>Shipping:</span>
                        <span class="text-green-600">Free</span>
                    </div>
                    <div class="flex justify-between font-bold text-lg pt-2">
                        <span>Total:</span>
                        <span class="text-red-600">$<span id="cart-total">{{ number_format($total, 2) }}</span></span>
                    </div>
                </div>
                <form action="{{ route('cart.checkout') }}" method="POST" class="mt-8 text-center" id="checkout-form">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white w-full py-4 rounded-sm font-medium hover:bg-red-600 transition uppercase tracking-wider">
                        Process to checkout
                    </button>
                </form>
            </div>
        </div>
    @else
        <div class="text-center py-20">
            <h2 class="text-2xl font-bold text-gray-300 mb-8 uppercase">Your Cart is Empty</h2>
            <a href="{{ route('home') }}" class="bg-red-500 text-white px-12 py-4 rounded-sm font-medium hover:bg-red-600 transition">
                Go Shopping
            </a>
        </div>
    @endif
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // AJAX Update ភ្លាមៗពេលប្តូរចំនួនលេខ (Quantity)
        $(document).on('change keyup', '.update-cart', function () {
            let ele = $(this);
            let id = ele.data("id");
            let quantity = ele.val();

            // ការពារការបញ្ចូលលេខតិចជាង ១
            if (quantity < 1) {
                ele.val(1);
                quantity = 1;
            }

            $.ajax({
                url: '{{ route("cart.update") }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    quantity: quantity
                },
                success: function (response) {
                    if(response.success) {
                        // ១. Update តម្លៃ Subtotal តាមជួរ (Price * Qty)
                        // ប្រើ selector ដែលច្បាស់លាស់ដើម្បីរក span row-subtotal តាម data-id
                        $(`.row-subtotal[data-id="${id}"]`).text(response.rowSubtotal);

                        // ២. Update តម្លៃសរុបក្នុង Summary Card
                        $("#cart-subtotal").text(response.newTotal);
                        $("#cart-total").text(response.newTotal);
                    }
                },
                error: function(xhr) {
                    console.error("Error updating cart:", xhr.responseText);
                }
            });
        });

        // លុបទំនិញជាមួយ SweetAlert2
        $(document).on('click', '.btn-remove', function(e) {
            e.preventDefault();
            let form = $(this).closest('form');

            Swal.fire({
                title: 'Remove this item?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
