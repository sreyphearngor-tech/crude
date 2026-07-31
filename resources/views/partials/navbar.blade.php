<nav class="flex items-center gap-8 text-black">
    <a href="{{ route('home') }}" class="hover:underline">Home</a>
    <a href="#" class="hover:underline">Contact</a>
    <a href="#" class="hover:underline">About</a>

    {{-- ១. ប្រសិនបើអ្នកប្រើប្រាស់មិនទាន់ Login (Guest) --}}
    @guest
        <a href="{{ route('register') }}" class="hover:underline">Sign Up</a>
        <a href="{{ route('login') }}" class="bg-exclusive-red text-white px-6 py-2 rounded-sm hover:bg-red-600 transition">Login</a>
    @endguest

    {{-- ២. ប្រសិនបើអ្នកប្រើប្រាស់បាន Login រួចរាល់ (Auth) --}}
    @auth
        <div class="relative group">
            <!-- បង្ហាញឈ្មោះអ្នកប្រើប្រាស់ និង Icon -->
            <button class="flex items-center gap-2 hover:text-exclusive-red focus:outline-none">
                <i class="far fa-user-circle text-xl"></i>
                <span class="font-medium">{{ Auth::user()->name }}</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </button>

            <!-- Dropdown Menu ពេលដាក់ Mouse ពីលើ (hover) -->
            <div class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity z-50">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-exclusive-red">
                    <i class="fas fa-user-cog mr-2"></i> My Account
                </a>

                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-exclusive-red">
                        <i class="fas fa-tachometer-alt mr-2"></i> Admin Dashboard
                    </a>
                @endif

                <hr class="border-gray-200">

                <!-- ហ្វមសម្រាប់ Logout (ត្រូវប្រើ POST method ដូចដែលបានកំណត់ក្នុង Route) -->
                <form action="{{ route('logout') }}" method="POST" class="block">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-exclusive-red hover:text-white transition">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    @endauth
</nav>
