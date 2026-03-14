<x-layout>
<div class="flex min-h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-blue-400 shadow-lg p-6 flex flex-col text-gray-500">
        <h1 class="text-2xl font-bold text-gray-800 mb-10">eProduct</h1>
        <nav class="flex-1 flex flex-col gap-4  ">
       <a href="{{ route('product.index') }}"
   class="px-4 py-2 rounded-lg hover:bg-blue-100 focus:outline-none focus:no-underline text-gray-700 font-medium no-underline"
   style="text-decoration: none;">
   Admins
</a>
<a href="{{ route('product.index') }}"
   class="px-4 py-2 rounded-lg hover:bg-blue-100 focus:outline-none focus:no-underline text-gray-700 font-medium no-underline {{ request()->routeIs('product.*') ? 'bg-blue-100 font-semibold text-blue-600' : 'text-gray-700' }}"
      style="text-decoration: none;">
    Products
</a>

<a href="#"
   class="px-4 py-2 rounded-lg hover:bg-blue-100 text-gray-700 no-underline"
      style="text-decoration: none;">
    Orders
</a>

<a href="#"
   class="px-4 py-2 rounded-lg hover:bg-blue-100 text-gray-700 no-underline"
      style="text-decoration: none;">
    Settings
</a>
        </nav>

    </aside>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        <!-- Top Navbar -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Dashboard</h2>

        </div>

        <!-- Table Card -->
        <div class="bg-white shadow-2xl rounded-2xl p-6">

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Product List</h3>
                <a href="{{ route('product.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                   + Add Product
                </a>
            </div>

            <!-- Search -->
            <form action="{{ route('product.index') }}" method="GET" class="flex gap-2 mb-4">
                <input type="text" name="search" placeholder="Search product"
                       value="{{ request('search') }}"
                       class="form-control">
                <button type="submit"
                        class="btn btn-success">
                        Search
                </button>
            </form>

            <!-- Table -->
            <div class="overflow-x-auto" id="tableDisplay">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 uppercase text-sm">
                            <th class="p-3 text-left">Name</th>
                            <th class="p-3 text-left">Price</th>
                            <th class="p-3 text-left">Quantity</th>
                            <th class="p-3 text-left">Image</th>
                            <th class="p-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($products as $product)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-3 font-medium text-gray-800">{{ $product->name }}</td>
                            <td class="p-3 text-green-600 font-semibold">${{ $product->price }}</td>
                            <td class="p-3"><span class="text-blue-700 px-3 py-1 text-sm">{{ $product->qty }}</span></td>
                            <td class="p-3">
                                @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" class="w-20 h-20 object-cover rounded-lg shadow">
                                @else
                                <span class="text-gray-400">No Image</span>
                                @endif
                            </td>
                            <td class="p-3 flex gap-2">
                                <a href="{{ route('product.edit',$product->id) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">Edit</a>
                                <form action="{{ route('product.destroy',$product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Are you sure delete this product?')"
                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">Delete</button>
                                </form>
                                <a href="{{ route('product.show',$product->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

            <!-- Pagination -->


        </div>
    </div>
                </table>
                      <div class="mt-6 flex justify-center">
                {{ $products->links('pagination::tailwind') }}
            </div>
            </div>
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
