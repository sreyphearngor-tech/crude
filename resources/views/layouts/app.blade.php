<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fashion Clothes - Online Shop</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        nav a {
            text-decoration: none !important;
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="bg-white flex flex-col min-h-screen">

    <!-- Top Header -->
    <div class="bg-black text-white py-3 px-4 text-sm flex items-center justify-center gap-3">
        <p>
            Summer Sale For All Swim Suits And Free Express Delivery - OFF 50%!
            <a href="#" class="font-bold underline ml-2 hover:text-gray-300">Shop Now</a>
        </p>
    </div>

    <!-- Main Navigation Bar -->
    <header class="border-b border-gray-200 sticky top-0 bg-white z-50 shadow-sm">
        <nav class="container mx-auto px-4 md:px-12 lg:px-24 flex items-center justify-between py-4">

            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center">
                <div class="w-[60px] h-[60px] md:w-[80px] md:h-[80px]">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="h-full w-auto object-contain"
                        onerror="this.onerror=null; this.src='https://placehold.co/200x80?text=Logo';">
                </div>
                <span class="text-2xl md:text-3xl font-extrabold ml-3 tracking-tighter uppercase">Fashion Clothes</span>
            </a>

            <!-- Navigation Menu -->
            <ul class="hidden md:flex items-center gap-8 font-medium">
                <li><a href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? 'border-b-2 border-red-500' : '' }} hover:text-red-500 pb-1">Home</a>
                </li>
                <li><a href="#"
                        class="hover:text-red-500 pb-1 border-gray-400 hover:border-b-2 border-red-500">Contact</a></li>
                <li><a href="#"
                        class="hover:text-red-500 pb-1 border-gray-400 hover:border-b-2 border-red-500">About</a></li>
            </ul>

            <!-- Search & Action Icons -->
            <div class="flex items-center gap-6">
                <!-- Search Box -->
                <div class="hidden lg:block">
                    <div class="relative w-full max-w-md">
                        <!-- Input សម្រាប់វាយស្វែងរក -->
                        <div class="relative w-full max-w-xs">
                            <input type="text" id="instant-search" placeholder="ស្វែងរកផលិតផល ឬប្រភេទ..."
                                class="w-full px-4 py-2 text-sm bg-gray-100 border border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                            <span class="absolute right-3 top-2.5 text-gray-400">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Cart Icon with Badge -->
                    <a href="{{ route('cart.index') }}" class="hover:text-red-500 relative inline-block transition">
                        <i class="fa-solid fa-cart-shopping text-2xl"></i>
                        @if (session('cart') && count(session('cart')) > 0)
                            <span
                                class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border-2 border-white">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>

                    <!-- User Auth Info -->
                    @auth
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-medium text-gray-700 hidden sm:inline">សួស្តី,
                                {{ auth()->user()->name }}</span>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                    class="bg-gray-800 text-white px-4 py-2 rounded text-sm hover:bg-black transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('loginForm') }}"
                            class="text-gray-700 hover:text-red-500 font-medium transition">Log In</a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <!-- Page Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer Section -->
    <footer class="bg-black text-white pt-16 pb-6 mt-auto">
        <div class="container mx-auto px-4 md:px-12 lg:px-24">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-8 mb-12">

                <!-- Column 1: Exclusive -->
                <div class="space-y-4">
                    <h2 class="text-xl font-bold tracking-wider">Fashion Clothes</h2>
                    <h3 class="text-lg font-medium">Subscribe</h3>
                    <p class="text-gray-400 text-sm">Get 10% off your first order</p>
                    <div class="relative max-w-[220px]">
                        <input type="email" placeholder="Enter your email"
                            class="bg-black border border-white rounded py-2 px-4 w-full text-sm focus:outline-none focus:border-gray-400">
                        <button class="absolute right-3 top-2.5 text-white">
                            <i class="fa-regular fa-paper-plane"></i>
                        </button>
                    </div>
                </div>

                <!-- Column 2: Support -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium">Support</h3>
                    <ul class="space-y-2 text-gray-400 text-sm leading-relaxed">
                        <li>Phnom Penh, Cambodia.</li>
                        <li>fashion@support.com</li>
                        <li>+855 12 345 678</li>
                    </ul>
                </div>

                <!-- Column 3: Account -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium">Account</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white transition">My Account</a></li>
                        <li><a href="{{ route('cart.index') }}" class="hover:text-white transition">Cart</a></li>
                        <li><a href="#" class="hover:text-white transition">Wishlist</a></li>
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Shop</a></li>
                    </ul>
                </div>

                <!-- Column 4: Quick Link -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium">Quick Link</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms Of Use</a></li>
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                    </ul>
                </div>

                <!-- Column 5: Download App -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium">Download App</h3>
                    <div class="flex gap-3 items-center">
                        <div class="bg-white p-1 rounded">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=FashionClothes"
                                alt="QR" class="w-16 h-16">
                        </div>
                        <div class="flex flex-col gap-2">
                            <a href="#"><img
                                    src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                                    class="w-20"></a>
                            <a href="#"><img
                                    src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                                    class="w-20"></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-800 pt-6 text-center">
                <p class="text-gray-500 text-xs">
                    <i class="fa-regular fa-copyright"></i> Copyright Fashion Clothes 2024. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Scripts Area -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // 1. បង្ហាញ Alert ពេល Checkout ជោគជ័យ
            @if (session('checkout_success'))
                Swal.fire({
                    title: 'ការកម្ម៉ង់ជោគជ័យ!',
                    text: "{{ session('checkout_success') }}",
                    icon: 'success',
                    confirmButtonColor: '#ef4444',
                    confirmButtonText: 'យល់ព្រម'
                });
            @endif

            // 2. បង្ហាញ Toast ពេល Success ទូទៅ (ដូចជា Add to cart)
            @if (session('success'))
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
                Toast.fire({
                    icon: 'success',
                    title: "{{ session('success') }}"
                });
            @endif

            // 3. បង្ហាញ Alert ពេលមាន Error
            @if (session('error'))
                Swal.fire({
                    title: 'សោកស្តាយ!',
                    text: "{{ session('error') }}",
                    icon: 'error',
                    confirmButtonColor: '#ef4444',
                    confirmButtonText: 'យល់ព្រម'
                });
            @endif
        });
    </script>

</body>

</html>
