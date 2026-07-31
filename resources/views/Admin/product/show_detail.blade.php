@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 md:px-12 lg:px-24 py-10 font-sans">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-400 mb-10">
        <a href="{{ route('home') }}" class="hover:text-black">Account</a> /
        <a href="#" class="hover:text-black">Gaming</a> /
        <span class="text-black font-medium">{{ $product->name }}</span>
    </nav>

    <div class="flex flex-col lg:flex-row gap-12">
        <!-- Left: Product Images -->
        <div class="flex flex-col-reverse md:flex-row gap-6 lg:w-2/3">
            <!-- Thumbnails -->
            <div class="flex md:flex-col gap-4">
                @for ($i = 0; $i < 4; $i++)
                <div class="w-32 h-28 bg-[#F5F5F5] p-4 rounded-sm cursor-pointer flex items-center justify-center border hover:border-black transition">
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-contain">
                </div>
                @endfor
            </div>
            <!-- Main Image -->
            <div class="flex-1 bg-[#F5F5F5] flex items-center justify-center p-12 rounded-sm min-h-[400px]">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="max-w-full h-auto object-contain">
            </div>
        </div>

        <!-- Right: Product Details -->
        <div class="lg:w-1/3">
            <h1 class="text-2xl font-bold mb-2 tracking-wide text-black">{{ $product->name }}</h1>

            <div class="flex items-center gap-4 mb-4">
                <div class="flex text-[#FFAD33] text-xs">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star text-gray-300"></i>
                </div>
                <span class="text-gray-400 text-sm border-r pr-4">(150 Reviews)</span>
                <span class="text-[#00FF66] text-sm font-medium">In Stock</span>
            </div>

            <div class="text-2xl font-medium mb-4 text-black">${{ number_format($product->price, 2) }}</div>

            <p class="text-sm text-black leading-relaxed mb-6 border-b border-gray-300 pb-6">
                {{ $product->description ?? 'PlayStation 5 Controller Skin High quality vinyl with air channel adhesive for easy bubble free install & mess free removal Pressure sensitive.' }}
            </p>

            <!-- Options: Colours -->
            <div class="flex items-center gap-4 mb-6">
                <span class="text-xl text-black">Colours:</span>
                <div class="flex gap-2 items-center">
                    <!-- Blue Color with Selection Ring -->
                    <div class="w-5 h-5 rounded-full border border-black p-[2px] flex items-center justify-center cursor-pointer">
                        <div class="w-full h-full rounded-full bg-[#A0BCE0]"></div>
                    </div>
                    <!-- Red Color -->
                    <div class="w-5 h-5 rounded-full bg-[#E07575] cursor-pointer"></div>
                </div>
            </div>

            <!-- Options: Size -->
            <div class="flex items-center gap-4 mb-6">
                <span class="text-xl text-black">Size:</span>
                <div class="flex gap-4">
                    @foreach(['XS', 'S', 'M', 'L', 'XL'] as $size)
                        <button class="w-8 h-8 border border-gray-400 rounded-md text-sm font-medium hover:bg-[#DB4444] hover:text-white hover:border-[#DB4444] transition {{ $size == 'M' ? 'bg-[#DB4444] text-white border-[#DB4444]' : 'text-black' }}">
                            {{ $size }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Quantity & Actions -->
            <div class="flex items-center gap-4 mb-10">
                <!-- Quantity Selector -->
                <div class="flex items-center border border-gray-400 rounded-md overflow-hidden h-11">
                    <button id="minus" class="w-10 h-full flex items-center justify-center hover:bg-[#DB4444] hover:text-white border-r border-gray-400 transition text-xl text-black">−</button>
                    <input type="text" id="qty" value="1" class="w-12 text-center focus:outline-none font-bold text-lg text-black">
                    <button id="plus" class="w-10 h-full flex items-center justify-center bg-[#DB4444] text-white hover:bg-[#c03939] transition text-xl">+</button>
                </div>

                <form action="{{ route('cart.store') }}" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="w-full bg-[#DB4444] text-white h-11 rounded-md font-medium hover:bg-[#c03939] transition">Buy Now</button>
                </form>

                <button class="border border-gray-400 w-11 h-11 flex items-center justify-center rounded-md hover:bg-[#DB4444] hover:text-white transition">
                    <i class="far fa-heart text-xl"></i>
                </button>
            </div>

            <!-- Delivery Info Box -->
            <div class="border border-gray-400 rounded-md overflow-hidden">
                <div class="flex items-center gap-4 p-4 border-b border-gray-400">
                    <i class="fas fa-truck text-2xl text-black"></i>
                    <div>
                        <p class="font-bold text-sm text-black">Free Delivery</p>
                        <p class="text-[10px] underline cursor-pointer font-medium mt-1 text-black">Enter your postal code for Delivery Availability</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 p-4">
                    <i class="fas fa-undo text-2xl text-black"></i>
                    <div>
                        <p class="font-bold text-sm text-black">Return Delivery</p>
                        <p class="text-[10px] font-medium mt-1 text-black">Free 30 Days Delivery Returns. <span class="underline cursor-pointer">Details</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Items Section -->
    <div class="mt-24">
        <div class="flex items-center gap-4 mb-8">
            <div class="w-5 h-10 bg-[#DB4444] rounded-sm"></div>
            <span class="text-[#DB4444] font-bold">Related Item</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($relatedProducts as $item)
            <div class="group relative bg-white">
                <!-- Image Container -->
                <div class="relative bg-[#F5F5F5] rounded-sm h-[250px] flex items-center justify-center overflow-hidden p-8">

                    <!-- Discount Badge -->
                    @if($item->old_price && $item->old_price > $item->price)
                        <div class="absolute top-3 left-3 bg-[#DB4444] text-white text-[10px] px-3 py-1 rounded-[4px]">
                            -{{ round((($item->old_price - $item->price) / $item->old_price) * 100) }}%
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="absolute top-3 right-3 flex flex-col gap-2">
                        <button class="bg-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-[#DB4444] hover:text-white transition shadow-sm text-black border-none">
                            <i class="fa-regular fa-heart"></i>
                        </button>
                        <a href="{{ route('product.show_detail', $item->id) }}" class="bg-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-[#DB4444] hover:text-white transition shadow-sm text-black border-none">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </div>

                    <!-- Product Image -->
                    <img src="{{ asset('storage/' . $item->image) }}" class="max-h-full object-contain group-hover:scale-110 transition duration-300">

                    <!-- Add To Cart Button (Show on Hover) -->
                    <form action="{{ route('cart.store') }}" method="POST" class="absolute bottom-0 left-0 w-full translate-y-full group-hover:translate-y-0 transition-all duration-300">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                        <button type="submit" class="w-full bg-black text-white py-2 text-sm font-medium hover:bg-gray-800 transition">
                            Add To Cart
                        </button>
                    </form>
                </div>

                <!-- Product Info -->
                <div class="mt-4 space-y-1">
                    <h3 class="font-bold text-black truncate">{{ $item->name }}</h3>
                    <div class="flex gap-3 items-center">
                        <span class="text-[#DB4444] font-medium">${{ number_format($item->price, 0) }}</span>
                        @if($item->old_price)
                            <span class="text-gray-400 line-through text-sm">${{ number_format($item->old_price, 0) }}</span>
                        @endif
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="flex text-[#FFAD33] text-[10px]">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star text-gray-300"></i>
                        </div>
                        <span class="text-gray-400 text-xs font-semibold">(88)</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- JavaScript for Quantity Counter -->
<script>
    const plus = document.getElementById('plus');
    const minus = document.getElementById('minus');
    const qtyInput = document.getElementById('qty');

    plus.addEventListener('click', () => {
        qtyInput.value = parseInt(qtyInput.value) + 1;
    });

    minus.addEventListener('click', () => {
        if (parseInt(qtyInput.value) > 1) {
            qtyInput.value = parseInt(qtyInput.value) - 1;
        }
    });
</script>
@endsection
