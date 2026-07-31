<footer class="bg-black text-white pt-20 pb-10">
    <div class="container mx-auto px-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
        <!-- Exclusive -->
        <div class="space-y-4">
            <h3 class="text-2xl font-bold italic">Exclusive</h3>
            <h4 class="text-xl font-medium">Subscribe</h4>
            <p class="text-sm">Get 10% off your first order</p>
            <div class="relative max-w-[200px]">
                <input type="email" placeholder="Enter your email" class="bg-black border border-white rounded py-2 pl-3 pr-10 text-sm w-full focus:outline-none">
                <button class="absolute right-3 top-2 text-white"><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>

        <!-- Support -->
        <div class="space-y-4">
            <h3 class="text-xl font-bold">Support</h3>
            <p class="text-sm leading-relaxed text-gray-300">111 Bijoy sarani, Dhaka, <br> DH 1515, Bangladesh.</p>
            <p class="text-sm text-gray-300">exclusive@gmail.com</p>
            <p class="text-sm text-gray-300">+88015-88888-9999</p>
        </div>

        <!-- Account -->
        <div class="space-y-4 text-gray-300">
            <h3 class="text-xl font-bold text-white">Account</h3>
            <p><a href="#" class="hover:text-white">My Account</a></p>
            <p><a href="#" class="hover:text-white">Login / Register</a></p>
            <p><a href="#" class="hover:text-white">Cart</a></p>
            <p><a href="#" class="hover:text-white">Wishlist</a></p>
            <p><a href="#" class="hover:text-white">Shop</a></p>
        </div>

        <!-- Quick Link -->
        <div class="space-y-4 text-gray-300">
            <h3 class="text-xl font-bold text-white">Quick Link</h3>
            <p><a href="#" class="hover:text-white">Privacy Policy</a></p>
            <p><a href="#" class="hover:text-white">Terms Of Use</a></p>
            <p><a href="#" class="hover:text-white">FAQ</a></p>
            <p><a href="#" class="hover:text-white">Contact</a></p>
        </div>

       <!-- Download App -->
<!-- Download App -->
<div class="space-y-4">
    <h3 class="text-xl font-bold">Download App</h3>
    <p class="text-[12px] text-gray-400 font-medium">Save $3 with App New User Only</p>

    <div class="flex gap-3">
        <!-- QR Code / Payments Section -->
        <div class="bg-white p-1 w-20 h-20 flex items-center justify-center">
            <!-- ប្តូរទៅជាឈ្មោះ file payments របស់អ្នកវិញ (ឧទាហរណ៍: payments.png) -->
            <!-- ត្រូវប្រាកដថា file នេះនៅក្នុង public/images/ -->
            <img src="{{ asset('images/payments.jpg') }}" alt="QR Code" class="w-full h-full object-contain">
        </div>
    </div>

        <!-- App Store Buttons -->
        <div class="flex flex-col justify-between py-0.5">
            <a href="#">
                <img src="{{ asset('images/google-play.png') }}" alt="Google Play" class="w-28 h-9 object-contain">
            </a>
            <a href="#">
                <img src="{{ asset('images/app-store.png') }}" alt="App Store" class="w-28 h-9 object-contain">
            </a>
        </div>
</div>

    </div>

    <!-- Social Icons -->
    <div class="flex gap-6 pt-4 text-xl">
        <a href="#" class="hover:text-red-500 transition"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="hover:text-red-500 transition"><i class="fab fa-twitter"></i></a>
        <a href="#" class="hover:text-red-500 transition"><i class="fab fa-instagram"></i></a>
        <a href="#" class="hover:text-red-500 transition"><i class="fab fa-linkedin-in"></i></a>
    </div>
</div>

    </div>

    <div class="border-t border-gray-800 mt-16 pt-6 text-center text-gray-500 text-sm">
        &copy; Copyright Rimel 2022. All rights reserved.
    </div>
</footer>
