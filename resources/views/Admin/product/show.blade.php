@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 md:px-12 lg:px-24 py-10">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-400 mb-10">
        <a href="{{ route('home') }}" class="hover:text-black">Account</a> /
        <a href="#" class="hover:text-black">Gaming</a> /
        <span class="text-black font-medium">{{ $product->name }}</span>
    </nav>

    <div class="flex flex-col lg:flex-row gap-12">
        <!-- Left: Product Images -->
        <div class="flex flex-col-reverse md:flex-row gap-4 lg:w-2/3">
            <!-- Thumbnails -->
            <div class="flex md:flex-col gap-4">
                @for ($i = 0; $i < 4; $i++)
                <div class="w-24 h-24 bg-gray-100 p-2 rounded-sm cursor-pointer border hover:border-black transition">
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-contain">
                </div>
                @endfor
            </div>
            <!-- Main Image -->
            <div class="flex-1 bg-gray-100 flex items-center justify-center p-10 rounded-sm">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="max-w-full max-h-[500px] object-contain">
            </div>
        </div>

        <!-- Right: Product Details -->
        <div class="lg:w-1/3">
            <h1 class="text-2xl font-bold mb-2">{{ $product->name }}</h1>

            <div class="flex items-center gap-4 mb-4">
                <div class="flex text-yellow-400 text-sm">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                </div>
                <span class="text-gray-400 text-sm border-r pr-4">(150 Reviews)</span>
                <span class="text-green-400 text-sm font-medium">In Stock</span>
            </div>

            <div class="text-2xl font-bold mb-4">${{ number_format($product->price, 2) }}</div>

            <p class="text-sm text-gray-700 leading-relaxed mb-6 border-b pb-6">
                {{ $product->description ?? 'PlayStation 5 Controller Skin High quality vinyl with air channel adhesive for easy bubble free install & mess free removal Pressure sensitive.' }}
            </p>

            <!-- Options: Colours -->
            <div class="flex items-center gap-4 mb-6">
                <span class="text-lg">Colours:</span>
                <div class="flex gap-2">
                    <button class="w-4 h-4 rounded-full bg-blue-200 border border-black"></button>
                    <button class="w-4 h-4 rounded-full bg-red-400"></button>
                </div>
            </div>

            <!-- Options: Size -->
            <div class="flex items-center gap-4 mb-6">
                <span class="text-lg">Size:</span>
                <div class="flex gap-2">
                    @foreach(['XS', 'S', 'M', 'L', 'XL'] as $size)
                        <button class="w-8 h-8 border border-gray-400 rounded-md text-xs font-medium hover:bg-red-500 hover:text-white hover:border-red-500 transition {{ $size == 'M' ? 'bg-red-500 text-white border-red-500' : '' }}">
                            {{ $size }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Quantity & Actions -->
            <div class="flex items-center gap-4 mb-10">
                <div class="flex border border-gray-400 rounded-md overflow-hidden">
                    <button class="px-4 py-2 hover:bg-red-500 hover:text-white border-r border-gray-400 transition">−</button>
                    <input type="text" value="2" class="w-12 text-center focus:outline-none font-bold">
                    <button class="px-4 py-2 bg-red-500 text-white hover:bg-red-600 transition">+</button>
                </div>
                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="bg-red-500 text-white px-10 py-2 rounded-md font-medium hover:bg-red-600 transition">Buy Now</button>
                </form>
                <button class="border border-gray-400 p-2 rounded-md hover:bg-red-500 hover:text-white transition">
                    <i class="far fa-heart"></i>
                </button>
            </div>

            <!-- Delivery Info Box -->
            <div class="border border-gray-400 rounded-md">
                <div class="flex items-center gap-4 p-4 border-b border-gray-400">
                    <i class="fas fa-truck text-2xl"></i>
                    <div>
                        <p class="font-bold">Free Delivery</p>
                        <p class="text-xs underline cursor-pointer">Enter your postal code for Delivery Availability</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 p-4">
                    <i class="fas fa-undo text-2xl"></i>
                    <div>
                        <p class="font-bold">Return Delivery</p>
                        <p class="text-xs">Free 30 Days Delivery Returns. <span class="underline cursor-pointer">Details</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Items Section -->
    <div class="mt-20">
        <div class="flex items-center gap-4 mb-10">
            <div class="w-5 h-10 bg-red-500 rounded-sm"></div>
            <span class="text-red-500 font-bold">Related Item</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($relatedProducts as $item)
            <div class="group">
                <div class="bg-gray-100 rounded-md p-8 relative flex justify-center items-center h-64 overflow-hidden">
                    <img src="{{ asset('storage/' . $item->image) }}" class="max-h-full object-contain group-hover:scale-110 transition">
                    <div class="absolute top-3 right-3 flex flex-col gap-2">
                        <button class="bg-white p-2 rounded-full shadow-sm hover:bg-red-500 hover:text-white transition"><i class="far fa-heart"></i></button>
                        <button class="bg-white p-2 rounded-full shadow-sm hover:bg-red-500 hover:text-white transition"><i class="far fa-eye"></i></button>
                    </div>
                </div>
                <div class="mt-4">
                    <h3 class="font-bold">{{ $item->name }}</h3>
                    <div class="flex gap-3 mt-1">
                        <span class="text-red-500 font-bold">${{ $item->price }}</span>
                        @if($item->old_price)
                            <span class="text-gray-400 line-through">${{ $item->old_price }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
