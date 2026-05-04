<x-layout>
    <div class="flex min-h-screen bg-gray-50">

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white shadow-xl flex flex-col sticky top-0 h-screen transition-all duration-300">
            <!-- Sidebar Header -->
            <div class="p-6 border-b border-gray-800">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-600 p-2 rounded-lg shadow-lg shadow-blue-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h1 class="text-xl font-black tracking-tight uppercase italic">E-Shop <span class="text-blue-500">Pro</span></h1>
                </div>
            </div>

            <!-- Sidebar Navigation -->
            <nav class="flex-1 p-4 flex flex-col gap-2 overflow-y-auto">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2 px-4">Menu</p>

                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-lg' : 'hover:bg-gray-800 text-gray-400 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('admin.product.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.product.*') ? 'bg-blue-600 text-white shadow-lg' : 'hover:bg-gray-800 text-gray-400 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    <span class="font-medium">Products</span>
                </a>

                <!-- Add more menu items here -->
            </nav>

            <!-- Sidebar Footer / Logout -->
            <div class="p-4 border-t border-gray-800">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-400 hover:bg-red-500/10 transition-all font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-x-hidden">
            <!-- Top Header (Optional) -->
            <header class="bg-white border-b border-gray-100 py-4 px-8 flex justify-between items-center sticky top-0 z-10 shadow-sm">
                <h2 class="text-sm font-bold text-gray-400 uppercase tracking-widest">Administrator Area</h2>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-semibold text-gray-700">{{ Auth::user()->name ?? 'Admin' }}</span>
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold border-2 border-white shadow-sm">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                </div>
            </header>

            <div class="p-8">
                <!-- Page Header -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                    <div>
                        <h2 class="text-4xl font-black text-gray-900 tracking-tight">Dashboard Overview</h2>
                        <p class="text-gray-500 mt-1">Manage your inventory and monitor performance.</p>
                    </div>
                    <a href="{{ route('admin.product.create') }}"
                       class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-2xl shadow-xl shadow-blue-500/20 hover:bg-blue-700 transition-all active:scale-95 font-bold">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add New Product
                    </a>
                </div>

                <!-- Toolbar: Search & Filters -->
                <div class="mb-8 bg-white p-5 rounded-3xl shadow-sm border border-gray-100 flex flex-wrap items-center gap-4">
                    <div class="relative w-full md:w-1/3">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                        <input type="text" id="searchProduct" placeholder="ស្វែងរកតាមឈ្មោះផលិតផល..."
                               class="block w-full pl-12 pr-4 py-3.5 bg-gray-50 border-transparent rounded-2xl focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all shadow-inner">
                    </div>

                    <div class="w-full md:w-1/4">
                        <select id="filterCategory" class="block w-full px-4 py-3.5 bg-gray-50 border-transparent rounded-2xl focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none transition-all shadow-inner">
                            <option value="">គ្រប់ប្រភេទទាំងអស់</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Product Table Section -->
                <div id="product-data-container" class="transition-opacity duration-300">
                    @include('products.table')
                </div>
            </div>
        </main>
    </div>

    <!-- AJAX Script (Keep your existing script here) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function fetchProducts(page, search, category) {
                $.ajax({
                    url: "{{ route('admin.dashboard') }}?page=" + page + "&search=" + search + "&category=" + category,
                    beforeSend: function() {
                        $('#product-data-container').addClass('opacity-50 pointer-events-none');
                    },
                    success: function(data) {
                        $('#product-data-container').html(data).removeClass('opacity-50 pointer-events-none');
                    },
                    error: function() {
                        alert('Failed to load products.');
                        $('#product-data-container').removeClass('opacity-50 pointer-events-none');
                    }
                });
            }

            let timer;
            $(document).on('keyup', '#searchProduct', function() {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    fetchProducts(1, $(this).val(), $('#filterCategory').val());
                }, 300);
            });

            $(document).on('change', '#filterCategory', function() {
                fetchProducts(1, $('#searchProduct').val(), $(this).val());
            });

            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                fetchProducts(page, $('#searchProduct').val(), $('#filterCategory').val());
            });
        });
    </script>
</x-layout>
