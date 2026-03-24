<x-layout>
<div class="flex min-h-screen bg-black">

    <!-- Sidebar -->
    <aside class="w-64 bg-black-800 shadow-lg p-6 flex flex-col text-gray-500">
        <h1 class="text-2xl font-bold text-gray-800 mb-10">eProduct Admin</h1>
        <nav class="flex-1 flex flex-col gap-4">
            <a href="{{ route('admin.dashboard') }}"
               class="px-4 py-2 rounded-lg hover:bg-blue-100 text-gray-700 font-medium no-underline {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 font-semibold text-blue-600' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('product.index') }}"
               class="px-4 py-2 rounded-lg hover:bg-blue-100 text-gray-700 font-medium no-underline {{ request()->routeIs('product.*') ? 'bg-blue-100 font-semibold text-blue-600' : '' }}">
                Products
            </a>
            <a href="#" class="px-4 py-2 rounded-lg hover:bg-blue-100 text-gray-700 no-underline">Orders</a>
            <a href="#" class="px-4 py-2 rounded-lg hover:bg-blue-100 text-gray-700 no-underline">Settings</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Dashboard</h2>
        </div>

        <div class="bg-white shadow-2xl rounded-2xl p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Product List</h3>
                <a href="{{ route('product.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                   + Add Product
                </a>
            </div>

            <!-- Search -->
            <form action="{{ route('product.index') }}" method="GET" class="flex gap-2 mb-4">
                <input type="text" name="search" placeholder="Search product"
                       value="{{ request('search') }}"
                       class="form-control border rounded px-3 py-2 w-full">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                        Search
                </button>
            </form>

            <!-- Product Table -->
            <div class="overflow-x-auto" id="productGrid">
                @if($products->count() > 0)
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 uppercase text-sm">
                            <th class="p-3 text-left">ID</th>
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
                            <td class="p-3 font-medium text-gray-800">{{ $product->id }}</td>
                            <td class="p-3 font-medium text-gray-800">{{ $product->name }}</td>
                            <td class="p-3 text-green-600 font-semibold">${{ $product->price }}</td>
                            <td class="p-3"><span class="text-blue-700 px-3 py-1 text-sm">{{ $product->qty }}</span></td>
                            <td class="p-3">
                              @if($product->image)
    <img src="{{ asset('storage/'.$product->image) }}" class="w-24 h-24 object-cover rounded-lg shadow"  alt="{{ $product->name }}">
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
                                        onclick="return confirm('Are you sure you want to delete this product?')"
                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">Delete</button>
                                </form>
                                <a href="{{ route('product.show',$product->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-6 flex justify-center">
                    {{ $products->links('pagination::tailwind') }}
                </div>

                @else
                    <p class="text-gray-500 text-center py-10">No products found.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Optional AJAX search -->
<script>
    const searchInput = document.querySelector('input[name="search"]');
    const productGrid = document.getElementById('productGrid');
    let timer;
    searchInput.addEventListener('keyup', function() {
        clearTimeout(timer);
        timer = setTimeout(() => {
            const query = this.value;
            fetch(`{{ route('product.index') }}?search=${query}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.text())
            .then(html => { productGrid.innerHTML = html; });
        }, 300); // 0.3s delay
    });
</script>
</x-layout>
