@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 lg:px-10 py-10">

    <!-- 1. Breadcrumb -->
    <div class="text-sm text-gray-500 mb-16 flex gap-2">
        <a href="{{ route('home') }}" class="hover:text-black">Account</a> /
        <a href="#" class="hover:text-black">{{ $product->category->name ?? 'Gaming' }}</a> /
        <span class="text-black font-medium">{{ $product->name }}</span>
    </div>

    <!-- 2. Product Main Section -->
    <div class="flex flex-col lg:flex-row gap-12 mb-20">

        <!-- Left Side: Image Gallery -->
        <div class="w-full lg:w-3/5 flex flex-col-reverse md:flex-row gap-6">
            <!-- Thumbnails (រូបភាពតូចៗ) -->
            <div class="md:w-1/4 flex flex-row md:flex-col gap-4">
                @php
                    // ឧបមាថាអ្នកមាន field រូបភាពបន្ថែមក្នុង Database
                    $gallery = [$product->image, $product->image2, $product->image3, $product->image4];
                @endphp
                @foreach(array_filter($gallery) as $img)
                    <div class="bg-exclusive-gray p-4 flex items-center justify-center rounded cursor-pointer border border-gray-200 hover:border-exclusive-red transition">
                        <img src="{{ asset($img) }}" class="object-contain h-20">
                    </div>
                @endforeach
            </div>

            <!-- Main Image (រូបភាពធំ) -->
            <div class="bg-exclusive-gray w-full md:w-3/4 flex items-center justify-center rounded p-10 h-[500px]">
                <img src="{{ asset($product->image) }}" id="mainImage" class="max-h-full object-contain transition duration-500">
            </div>
        </div>

        <!-- Right Side: Product Info -->
        <div class="w-full lg:w-2/5 space-y-6">
            <h1 class="text-3xl font-semibold text-black">{{ $product->name }}</h1>

            <!-- Rating & Status -->
            <div class="flex items-center gap-4 text-sm">
                <div class="flex items-center gap-1 text-yellow-400">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star text-gray-300"></i>
                    <span class="text-gray-500 font-medium ml-2">(150 Reviews)</span>
                </div>
                <span class="text-gray-300">|</span>
                <span class="text-[#00FF66] font-medium">In Stock</span>
            </div>

            <!-- Price -->
            <p class="text-3xl font-medium">${{ number_format($product->price, 2) }}</p>

            <!-- Description -->
            <p class="text-sm leading-relaxed text-black pt-2 pb-6 border-b border-gray-300">
                {{ $product->description ?? 'PlayStation 5 Controller Skin High quality vinyl with air channel adhesive for easy bubble free install & mess free removal Pressure sensitive.' }}
            </p>

            <!-- Colour Picker -->
            <div class="flex items-center gap-6 pt-4">
                <span class="text-xl font-medium">Colours:</span>
                <div class="flex gap-3">
                    <button class="w-5 h-5 rounded-full bg-[#A0BCE0] border-2 border-black ring-1 ring-white"></button>
                    <button class="w-5 h-5 rounded-full bg-exclusive-red hover:ring-1 hover:ring-black transition"></button>
                </div>
            </div>


    <!-- Size Picker -->
         <div class="flex items-center gap-6 pt-4" x-data="{ selectedSize: 'M' }">
    <span class="text-xl font-semibold text-gray-800">Size:</span>
    <div class="flex gap-3">
        @foreach(['XS', 'S', 'M', 'L', 'XL'] as $size)
            <button
                @click="selectedSize = '{{ $size }}'"
                :class="selectedSize === '{{ $size }}' ? 'bg-red-500 text-white border-red-500 shadow-md' : 'bg-white text-gray-700 border-gray-300 hover:border-red-500 hover:text-red-500'"
                class="w-12 h-12 border-2 rounded-full flex items-center justify-center font-bold text-sm uppercase transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2"
            >
                {{ $size }}
            </button>
        @endforeach
    </div>
</div>
<!-- បន្ថែម Alpine.js តាមរយៈ CDN ប្រសិនបើគម្រោងរបស់អ្នកមិនទាន់មាន -->


            <!-- Quantity & Cart Form -->
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex items-center gap-4 pt-6">
                @csrf
                <!-- Quantity Control -->
                <div class="flex items-center border border-gray-400 rounded overflow-hidden h-12">
                    <button type="button" onclick="changeQty(-1)" class="px-4 py-2 hover:bg-gray-100 text-xl border-r border-gray-400">-</button>
                    <input type="number" name="quantity" id="product_qty" value="1" min="1" class="w-16 text-center font-bold focus:outline-none appearance-none">
                    <button type="button" onclick="changeQty(1)" class="px-4 py-2 bg-exclusive-red text-white text-xl hover:bg-red-600">+</button>
                </div>

                <!-- Action Buttons -->
                <button type="submit" class="flex-1 bg-exclusive-red text-white h-12 rounded-sm font-medium hover:bg-red-600 transition">
                    Buy Now
                </button>

                <button type="button" class="h-12 w-12 border border-gray-400 rounded-sm flex items-center justify-center hover:bg-exclusive-red hover:text-white transition">
                    <i class="far fa-heart text-xl"></i>
                </button>
            </form>

            <!-- Delivery Info Box -->
            <div class="mt-10 border border-gray-400 rounded divide-y divide-gray-400">
                <div class="flex items-center gap-4 p-5">
                    <i class="fas fa-truck text-3xl"></i>
                    <div>
                        <h4 class="font-medium text-black">Free Delivery</h4>
                        <p class="text-xs font-medium underline cursor-pointer">Enter your postal code for Delivery Availability</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 p-5">
                    <i class="fas fa-rotate text-3xl"></i>
                    <div>
                        <h4 class="font-medium text-black">Return Delivery</h4>
                        <p class="text-xs font-medium">Free 30 Days Delivery Returns. <span class="underline cursor-pointer">Details</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Related Items Section -->
    <section class="mt-20">
        <div class="flex items-center gap-4 mb-10">
            <div class="w-5 h-10 bg-exclusive-red rounded-sm"></div>
            <span class="text-exclusive-red font-bold">Related Item</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($relatedProducts as $related)
            <div class="group">
                <div class="relative bg-exclusive-gray p-4 h-[250px] flex items-center justify-center rounded-sm overflow-hidden border border-gray-100">
                    @if($related->discount)
                        <span class="absolute top-3 left-3 bg-exclusive-red text-white text-xs px-3 py-1 rounded-sm">-{{ $related->discount }}%</span>
                    @endif
                    <div class="absolute top-3 right-3 flex flex-col gap-2">
                        <button class="bg-white p-2 rounded-full text-sm shadow hover:bg-exclusive-red hover:text-white transition"><i class="far fa-heart"></i></button>
                        <a href="{{ route('product.show2', $related->id) }}" class="bg-white p-2 rounded-full text-sm shadow hover:bg-exclusive-red hover:text-white transition"><i class="far fa-eye"></i></a>
                    </div>
                    <img src="{{ asset($related->image) }}" class="max-h-full object-contain group-hover:scale-110 transition duration-300">

                    <form action="{{ route('cart.add', $related->id) }}" method="POST">
                        @csrf
                        <button class="absolute bottom-0 left-0 w-full bg-black text-white py-2 opacity-0 group-hover:opacity-100 transition-all duration-300">Add To Cart</button>
                    </form>
                </div>
                <div class="mt-4 space-y-2">
                    <h3 class="font-semibold text-black">{{ $related->name }}</h3>
                    <div class="flex gap-3 font-medium">
                        <span class="text-exclusive-red">${{ number_format($related->price, 2) }}</span>
                        @if($related->old_price)
                            <span class="text-gray-400 line-through">${{ number_format($related->old_price, 2) }}</span>
                        @endif
                    </div>
                    <div class="flex items-center gap-1 text-yellow-400 text-xs">
                        @for($i=0; $i<5; $i++) <i class="fas fa-star"></i> @endfor
                        <span class="text-gray-500 font-semibold ml-1">(88)</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.min.js"></script>
<!-- JavaScript សម្រាប់គ្រប់គ្រងចំនួនទំនិញ -->
<script>
    function changeQty(amount) {
        const qtyInput = document.getElementById('product_qty');
        let currentVal = parseInt(qtyInput.value);
        if (currentVal + amount >= 1) {
            qtyInput.value = currentVal + amount;
        }
    }
</script>
@endsection
