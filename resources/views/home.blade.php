<x-layout>
    <!-- Navbar -->
    <nav class="bg-white text-gray-800 px-6 py-4 flex justify-between items-center shadow-md text-lg"
style="text-decoration-line: none"
    >
        <h1 class="text-2xl font-bold">eProduct</h1>

        <!-- Nav Links -->
<ul class="flex gap-6 font- text-gray-900 "

>
    <li><a href="{{ route('home') }}" class="hover:text-blue-400"
style="text-decoration: none"
        >Home</a></li>
    <li><a href="#" class="hover:text-blue-400"
style="text-decoration: none"
        >About</a></li>
    <li><a href="#" class="hover:text-blue-400"
style="text-decoration: none"
        >Contact</a></li>
    <li><a href="#" class="hover:text-blue-400"
style="text-decoration: none"
        >Login</a></li>
</ul>
  <!-- Search -->
         <form action="{{ route('home') }}" method="GET" class="flex gap-2">
    <input type="text"
           id="searchInput"
           name="search"
           placeholder="Search product"
           value="{{ request('search') }}"
           class="px-3 py-2 rounded text-black">

    <button type="submit" class="bg-green-500 px-4 py-2 rounded">
        Search
    </button>
</form>

    </nav>


    <!-- Products Grid -->
    <section class="max-w-6xl mx-auto py-6 px-6 badge-danger">
        <h2 class="text-3xl font-bold text-gray-800 w-56  bg-pink-500 px-2 py-2 rounded">Our Products</h2>

        <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-10 py-5">
            @include('partials.products', ['products' => $products])
        </div>
    </section>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        {{ $products->links('pagination::tailwind') }}
    </div>

    <!-- Live Search Script -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const productGrid = document.getElementById('productGrid');
        let timer;

        searchInput.addEventListener('keyup', function() {
            clearTimeout(timer);
            timer = setTimeout(() => {
                const query = this.value;
                fetch(`/?search=${query}`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(res => res.text())
                .then(html => { productGrid.innerHTML = html; });
            }, 10);
        });
    </script>
</x-layout>
