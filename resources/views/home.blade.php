<x-layout>
		<!-- Navbar -->
<nav class="bg-gray-900/95 backdrop-blur-md sticky top-0 z-50 border-b border-gray-800 px-8 py-4 flex justify-between items-center shadow-lg">

    <div class="flex items-center gap-2">
        <div class="bg-red-600 p-2 rounded-lg shadow-lg shadow-red-900/20">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
        </div>
        <h1 class="text-2xl font-black tracking-tight text-white">
            e<span class="text-red-600">Product</span>
        </h1>
    </div>

    <ul class="hidden md:flex items-center gap-8 text-sm font-bold uppercase tracking-widest text-gray-300">
        <li>
            <a href="/" class="relative group !no-underline text-gray-300 hover:text-white transition">
                Home
                <span class="absolute -bottom-1 left-0 w-0 h-1 bg-red-600 transition-all duration-300 group-hover:w-full"></span>
            </a>
        </li>
        <li>
            <a href="#" class="relative group !no-underline text-gray-300 hover:text-white transition">
                About
                <span class="absolute -bottom-1 left-0 w-0 h-1 bg-red-600 transition-all duration-300 group-hover:w-full"></span>
            </a>
        </li>
        <li>
            <a href="#" class="relative group !no-underline text-gray-300 hover:text-white transition">
                Contact
                <span class="absolute -bottom-1 left-0 w-0 h-1 bg-red-600 transition-all duration-300 group-hover:w-full"></span>
            </a>
        </li>
    </ul>

    <div class="flex items-center gap-6">

        <form action="{{ route('products.home') }}" method="GET" class="relative hidden lg:block">
            <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                   placeholder="Search items..."
                   class="bg-gray-100 border-none rounded-full py-2 pl-10 pr-4 w-64 focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300 text-sm">
            <svg class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </form>

        <div class="flex items-center gap-3 border-l pl-6 border-gray-200">
            @guest
                <a href="{{ route('login') }}" class="!no-underline text-gray-300 hover:text-white text-sm font-bold transition">Login</a>
                <a href="{{ route('register') }}" class="!no-underline bg-red-600 hover:bg-red-700 text-white px-6 py-2.5 rounded-full text-sm font-bold transition">Register</a>
            @else
                <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-400 hover:text-red-500 transition group" title="View Cart">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>

                 <span class="absolute top-0 right-0 bg-red-600 text-white text-[10px] font-bold px-1.5 rounded-full border-2 border-gray-900">
    {{ Auth::user()->cart ? Auth::user()->cart->items->sum('quantity') : 0 }}
</span>
                </a>

                <form action="{{ route('logout') }}" method="POST" class="ml-2">
                    @csrf
                    <button type="submit" class="text-gray-400 hover:text-white text-sm font-bold transition p-2">
                        Logout
                    </button>
                </form>
            @endguest
        </div>
    </div>
</nav>

		<!-- Products Grid -->
		<section class="max-w-6xl mx-auto py-6 px-6 badge-danger">
			<h2 class="relative text-3xl font-black text-gray-900 inline-block pb-2">
    Our <span class="text-red-600">Products</span>
    <span class="absolute bottom-0 left-0 w-20 h-1.5 bg-red-600 rounded-full"></span>
</h2>

				<div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-10 py-5">
						@include('partials.products', ['products' => $products])
				</div>
		</section>

		<!-- Live Search Script -->

		<script>
				const searchInput = document.getElementById('searchInput');//ប្រើID ដើម្បីយក input element ដែលមាន ID "searchInput"
				const productGrid = document.getElementById('productGrid');//ប្រើID ដើម្បីយក div element ដែលមាន ID "productGrid" ដែលជាកន្លែងដែលបង្ហាញផលិតផល
				let timer;//ប្រើសម្រាប់រក្សាទុក timer ដែលនឹងត្រូវបានប្រើសម្រាប់ការពន្យារពេលការស្វែងរក

				searchInput.addEventListener('keyup', function() {//បន្ថែម event listener សម្រាប់ព្រឹត្តិការណ៍ "keyup" នៅលើ input element ដែលមាន ID "searchInput"
						clearTimeout(timer);//បញ្ចប់ timer មុននេះ ប្រសិនបើមាន timer មុននេះកំពុងដំណើរការ
						timer = setTimeout(() => {//កំណត់ timer ថ្មី ដែលនឹងត្រូវបានអនុវត្តបន្ទាប់ពី 10 milliseconds
								const query = this.value;//យកតម្លៃដែលបានបញ្ចូលក្នុង input element ហើយរក្សាទុកក្នុងអថេរ "query"
								fetch(`/?search=${query}`, {
												headers: {
														'X-Requested-With': 'XMLHttpRequest'
												}
										})
										.then(res => res.text())
										.then(html => {
												productGrid.innerHTML = html;
										});
						}, 10);
				});
		</script>
</x-layout>
