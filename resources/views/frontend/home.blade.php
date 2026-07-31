@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 lg:px-10">

    <!-- 1. Hero & Sidebar Section -->
    <div class="flex flex-col lg:flex-row mb-20">
        <!-- Sidebar Categories -->
        <aside class="w-full lg:w-1/4 border-r border-gray-200 pt-10 pb-4 lg:pb-0">
            <ul class="space-y-4 text-black">
                <li class="flex justify-between items-center pr-10 cursor-pointer hover:text-exclusive-red">Woman’s Fashion <i class="fas fa-chevron-right text-xs"></i></li>
                <li class="flex justify-between items-center pr-10 cursor-pointer hover:text-exclusive-red">Men’s Fashion <i class="fas fa-chevron-right text-xs"></i></li>
                <li class="cursor-pointer hover:text-exclusive-red">Electronics</li>
                <li class="cursor-pointer hover:text-exclusive-red">Home & Lifestyle</li>
                <li class="cursor-pointer hover:text-exclusive-red">Medicine</li>
                <li class="cursor-pointer hover:text-exclusive-red">Sports & Outdoor</li>
                <li class="cursor-pointer hover:text-exclusive-red">Baby’s & Toys</li>
                <li class="cursor-pointer hover:text-exclusive-red">Groceries & Pets</li>
                <li class="cursor-pointer hover:text-exclusive-red">Health & Beauty</li>
            </ul>
        </aside>

        <!-- Main Banner (iPhone 14) -->
        <div class="w-full lg:w-3/4 lg:pt-10 lg:pl-10">
            <div class="bg-black text-white p-10 flex flex-col md:flex-row items-center justify-between rounded-sm relative overflow-hidden">
                <div class="space-y-6 z-10">
                    <div class="flex items-center gap-4">
                        <i class="fab fa-apple text-4xl"></i>
                        <span class="text-lg">iPhone 14 Series</span>
                    </div>
                    <h1 class="text-5xl font-bold leading-tight">Up to 10% <br> off Voucher</h1>
                    <a href="#" class="inline-block border-b-2 border-white pb-1 font-medium hover:text-gray-300">Shop Now <i class="fas fa-arrow-right ml-2"></i></a>
                </div>
                <img src="{{ asset('images/iphone-14.png') }}" class="w-full md:w-1/2 mt-8 md:mt-0 object-contain">
                <!-- Slider Dots -->
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                    <div class="w-3 h-3 rounded-full bg-gray-500"></div>
                    <div class="w-3 h-3 rounded-full bg-gray-500"></div>
                    <div class="w-3 h-3 rounded-full bg-exclusive-red border-2 border-white"></div>
                    <div class="w-3 h-3 rounded-full bg-gray-500"></div>
                    <div class="w-3 h-3 rounded-full bg-gray-500"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Flash Sales Section -->
    <section class="mb-20">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-5 h-10 bg-exclusive-red rounded-sm"></div>
            <span class="text-exclusive-red font-bold">Today's</span>
        </div>
        <div class="flex flex-col md:flex-row items-end gap-10 md:gap-20 mb-10">
            <h2 class="text-4xl font-bold tracking-wider">Flash Sales</h2>
            <!-- Countdown Timer -->
            <div class="flex gap-4 items-center">
                @foreach(['Days' => '03', 'Hours' => '23', 'Minutes' => '19', 'Seconds' => '56'] as $label => $time)
                    <div class="text-center">
                        <p class="text-[12px] font-bold">{{ $label }}</p>
                        <p class="text-3xl font-bold">{{ $time }}</p>
                    </div>
                    @if(!$loop->last) <span class="text-exclusive-red text-2xl font-bold mt-4">:</span> @endif
                @endforeach
            </div>
            <div class="ml-auto flex gap-2">
                <button class="bg-exclusive-gray p-3 rounded-full hover:bg-gray-200"><i class="fas fa-arrow-left"></i></button>
                <button class="bg-exclusive-gray p-3 rounded-full hover:bg-gray-200"><i class="fas fa-arrow-right"></i></button>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- ឧទាហរណ៍ផលិតផល ១: Gamepad -->
            <div class="group">
                <div class="relative bg-exclusive-gray p-4 h-[250px] flex items-center justify-center rounded-sm overflow-hidden">
                    <span class="absolute top-3 left-3 bg-exclusive-red text-white text-xs px-3 py-1 rounded-sm">-40%</span>
                    <div class="absolute top-3 right-3 flex flex-col gap-2">
                        <button class="bg-white p-2 rounded-full text-sm hover:bg-exclusive-red hover:text-white transition"><i class="far fa-heart"></i></button>
                        <button class="bg-white p-2 rounded-full text-sm hover:bg-exclusive-red hover:text-white transition"><i class="far fa-eye"></i></button>
                    </div>
                    <img src="{{ asset('images/gamepad.png') }}" class="max-h-full object-contain group-hover:scale-110 transition duration-300">
                    <button class="absolute bottom-0 left-0 w-full bg-black text-white py-2 opacity-0 group-hover:opacity-100 transition-opacity">Add To Cart</button>
                </div>
                <div class="mt-4 space-y-2">
                    <h3 class="font-semibold text-black">HAVIT HV-G92 Gamepad</h3>
                    <div class="flex gap-3 font-medium">
                        <span class="text-exclusive-red">$120</span>
                        <span class="text-gray-400 line-through">$160</span>
                    </div>
                    <div class="flex items-center gap-2 text-yellow-400 text-sm">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star text-gray-300"></i>
                        <span class="text-gray-500 font-semibold">(88)</span>
                    </div>
                </div>
            </div>
            <!-- ... បន្ថែម Product Card ផ្សេងទៀតតាមរូបភាព ... -->
        </div>
        <div class="text-center mt-16">
            <button class="bg-exclusive-red text-white px-12 py-4 rounded-sm font-medium hover:bg-red-600 transition">View All Products</button>
        </div>
    </section>

    <!-- 3. Browse By Category -->
    <section class="border-t border-gray-200 pt-20 mb-20">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-5 h-10 bg-exclusive-red rounded-sm"></div>
            <span class="text-exclusive-red font-bold">Categories</span>
        </div>
        <div class="flex justify-between items-end mb-10">
            <h2 class="text-4xl font-bold">Browse By Category</h2>
            <div class="flex gap-2">
                <button class="bg-exclusive-gray p-3 rounded-full hover:bg-gray-200"><i class="fas fa-arrow-left"></i></button>
                <button class="bg-exclusive-gray p-3 rounded-full hover:bg-gray-200"><i class="fas fa-arrow-right"></i></button>
            </div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-6 gap-6">
            @php
                $cats = [
                    ['icon' => 'mobile-screen-button', 'label' => 'Phones'],
                    ['icon' => 'desktop', 'label' => 'Computers'],
                    ['icon' => 'clock', 'label' => 'SmartWatch'],
                    ['icon' => 'camera', 'label' => 'Camera', 'active' => true],
                    ['icon' => 'headphones', 'label' => 'HeadPhones'],
                    ['icon' => 'gamepad', 'label' => 'Gaming']
                ];
            @endphp
            @foreach($cats as $cat)
                <div class="border border-gray-300 rounded-sm py-8 flex flex-col items-center gap-4 group hover:bg-exclusive-red hover:text-white transition cursor-pointer {{ isset($cat['active']) ? 'bg-exclusive-red text-white' : '' }}">
                    <i class="fa-solid fa-{{ $cat['icon'] }} text-4xl"></i>
                    <p class="text-sm font-medium">{{ $cat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- 4. Best Selling Products -->
    <section class="mb-20">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-5 h-10 bg-exclusive-red rounded-sm"></div>
            <span class="text-exclusive-red font-bold">This Month</span>
        </div>
        <div class="flex justify-between items-end mb-10">
            <h2 class="text-4xl font-bold">Best Selling Products</h2>
            <button class="bg-exclusive-red text-white px-10 py-3 rounded-sm hover:bg-red-600 transition">View All</button>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- ឧទាហរណ៍ផលិតផល: The north coat -->
            <div class="group">
                <div class="relative bg-exclusive-gray p-4 h-[250px] flex items-center justify-center rounded-sm overflow-hidden">
                    <div class="absolute top-3 right-3 flex flex-col gap-2">
                        <button class="bg-white p-2 rounded-full text-sm hover:bg-exclusive-red hover:text-white transition"><i class="far fa-heart"></i></button>
                        <button class="bg-white p-2 rounded-full text-sm hover:bg-exclusive-red hover:text-white transition"><i class="far fa-eye"></i></button>
                    </div>
                    <img src="{{ asset('images/watch.png') }}" class="max-h-full object-contain group-hover:scale-110 transition duration-300">
                </div>
                <div class="mt-4 space-y-2">
                    <h3 class="font-semibold text-black">The north coat</h3>
                    <div class="flex gap-3 font-medium">
                        <span class="text-exclusive-red">$260</span>
                        <span class="text-gray-400 line-through">$360</span>
                    </div>
                    <div class="flex items-center gap-2 text-yellow-400 text-sm">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <span class="text-gray-500 font-semibold">(65)</span>
                    </div>
                </div>
            </div>
            <!-- ... បន្ថែម Product Card ផ្សេងទៀត ... -->
        </div>
    </section>

</div>
@endsection
