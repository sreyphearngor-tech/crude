@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 md:px-12 lg:px-24 py-10">
        <!-- Breadcrumb -->
        <nav class="text-sm text-gray-400 mb-10">
            <a href="{{ route('home') }}" class="hover:text-black">Home</a> / <span class="text-black">Cart</span>
        </nav>

        @if (session('cart') && count(session('cart')) > 0)
            <!-- Table Header -->
            <div
                class="grid grid-cols-4 bg-white shadow-sm rounded-sm p-6 mb-6 font-medium text-gray-800 hidden md:grid border border-gray-100">
                <div>Product</div>
                <div class="text-center">Price</div>
                <div class="text-center">Quantity</div>
                <div class="text-right">Subtotal</div>
            </div>

            <div class="space-y-6" id="cart-items-container">
                @php $total = 0 @endphp
                @foreach (session('cart') as $key => $details)
                    @php
                        $rowSubtotal = $details['price'] * $details['quantity'];
                        $total += $rowSubtotal;
                    @endphp
                    <div
                        class="grid grid-cols-1 md:grid-cols-4 items-center bg-white shadow-sm rounded-sm p-6 relative group border border-transparent hover:border-gray-100 transition">

                        <!-- Product Info -->
                        <div class="flex items-center gap-4 relative">
                            <!-- Remove Button -->
                            <form action="{{ route('cart.remove') }}" method="POST"
                                class="absolute -top-8 -left-8 opacity-0 group-hover:opacity-100 transition-all z-10">
                                @csrf
                                <input type="hidden" name="id" value="{{ $key }}">
                                <!-- ប្រើ key (id-size) -->
                                <button type="button"
                                    class="btn-remove bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center shadow-md">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </form>

                            <div class="w-14 h-14 flex-shrink-0">
                                <img src="{{ asset('storage/' . $details['image']) }}" class="w-full h-full object-contain">
                            </div>
                            <div class="flex flex-col">
                                <span class="text-gray-800 font-medium">{{ $details['name'] }}</span>
                                @if (isset($details['size']))
                                    <span class="text-xs text-gray-500 italic">Size: {{ $details['size'] }}</span>
                                @endif
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="text-center text-gray-800 hidden md:block">
                            ${{ number_format($details['price'], 2) }}
                        </div>

                        <!-- Quantity -->
                        <div class="flex justify-center mt-4 md:mt-0">
                            <input type="number" value="{{ $details['quantity'] }}" min="1"
                                class="w-20 border border-gray-300 rounded-md px-2 py-2 update-cart text-center"
                                data-id="{{ $details['id'] }}" data-size="{{ $details['size'] ?? '' }}"
                                data-key="{{ $key }}">
                        </div>

                        <!-- Subtotal -->
                        <div class="text-right text-gray-800 font-bold mt-4 md:mt-0">
                            $<span class="row-subtotal"
                                data-key="{{ $key }}">{{ number_format($rowSubtotal, 2) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Summary Area -->
            <div class="flex flex-col lg:flex-row justify-between mt-12 gap-10">
                <div class="flex gap-4">
                    <input type="text" placeholder="Coupon Code"
                        class="border border-black px-6 py-3 w-64 focus:outline-none">
                    <button class="bg-red-500 text-white px-8 py-3 hover:bg-red-600 transition">Apply</button>
                </div>

                <div class="w-full lg:w-96 border-2 border-black p-6 rounded-md">
                    <h3 class="text-xl font-bold mb-4">Cart Total</h3>
                    <div class="flex justify-between border-b py-3 text-gray-600">
                        <span>Subtotal:</span>
                        <span>$<span id="cart-subtotal">{{ number_format($total, 2) }}</span></span>
                    </div>
                    <div class="flex justify-between py-4 text-xl font-bold">
                        <span>Total:</span>
                        <span class="text-red-600">$<span id="cart-total">{{ number_format($total, 2) }}</span></span>
                    </div>
                    <!-- ប្តូរវិធីសាស្ត្រទៅជា GET និងហៅទៅកាន់ Route ជំហានដំបូងនៃ Checkout -->
                    <form action="{{ route('checkout.shipping') }}" method="GET">
                        <button
                            class="w-full bg-red-500 text-white py-4 rounded-sm hover:bg-red-600 transition uppercase font-bold">
                            Process to Checkout
                        </button>
                    </form>
                </div>
            </div>
        @else
            <!-- Empty Cart State -->
            <div class="text-center py-20">
                <h2 class="text-2xl font-bold text-gray-300 mb-8 uppercase">Your Cart is Empty</h2>
                <a href="{{ route('home') }}"
                    class="bg-red-500 text-white px-12 py-4 rounded-sm font-medium hover:bg-red-600 transition">
                    Go Shopping
                </a>
            </div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Update Cart Logic
            $(document).on('change', '.update-cart', function() {
                let ele = $(this);
                let id = ele.data("id");
                let size = ele.data("size");
                let key = ele.data("key");
                let quantity = ele.val();

                if (quantity < 1) {
                    ele.val(1);
                    quantity = 1;
                }

                $.ajax({
                    url: '{{ route('cart.update') }}',
                    method: "patch",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        size: size,
                        quantity: quantity
                    },
                    success: function(response) {
                        if (response.success) {
                            $(`.row-subtotal[data-key="${key}"]`).text(response.rowSubtotal);
                            $("#cart-subtotal").text(response.newTotal);
                            $("#cart-total").text(response.newTotal);
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Error', xhr.responseJSON.error || 'Something went wrong',
                            'error');
                    }
                });
            });

            // Remove Item Logic
            $(document).on('click', '.btn-remove', function() {
                let form = $(this).closest('form');
                Swal.fire({
                    title: 'Remove this item?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    confirmButtonText: 'Yes, remove it!'
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });
        });
    </script>
@endsection
