<x-layout>
<div class="flex min-h-screen bg-gray-100">

    <aside class="w-64 bg-gray-900 shadow-xl flex flex-col text-white relative inline-block">
        <div class="p-6 border-b border-gray-800">
            <h1 class="text-2xl font-bold tracking-tight text-blue-400">eProduct</h1>
        </div>
        <nav class="flex-1 p-4 flex flex-col gap-2">
            <p class="text-xs uppercase text-gray-500 font-semibold px-4 mb-2">Main Menu</p>
            <a href="{{ route('product.index') }}"
               class="flex btn btn-outline items-center gap-3 px-4 py-3 rounded-xl transition bg-danger hover:bg-gray-800 hover:text-white {{ request()->routeIs('product.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                <span>📦</span> Products
            </a>
            <a href="#" class="flex btn btn-outline items-center gap-3 px-4 py-3 rounded-xl transition  bg-danger hover:bg-gray-800 hover:text-white">
                 <span>📊</span> Analytics
                <span>🛒</span> Orders
            </a>
            <a href="#" class="flex btn btn-outline items-center gap-3 px-4 py-3 rounded-xl transition bg-danger hover:bg-gray-800 hover:text-white">
                <span>👥</span> Admins
            </a>
            <div class="mt-auto pt-4 border-t border-gray-800">
                <a href="#" class="flex btn btn-outline items-center gap-3 px-4 py-3 rounded-xl transition bg-danger">
                    <span>⚙️</span> Settings
                </a>
            </div>
        </nav>
    </aside>

    <div class="flex-1 p-8 overflow-y-auto">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Dashboard</h2>
                <p class="text-gray-500">Manage your product inventory and sales.</p>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-400">{{ now()->format('D, d M Y') }}</span>
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold border border-blue-200">
                    AD
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm font-medium">Total Products</p>
                <h4 class="text-2xl font-bold text-gray-800">{{ $products->total() }}</h4>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm font-medium">Stock Value</p>
                <h4 class="text-2xl font-bold text-green-600">${{ number_format($products->sum(fn($p) => $p->price * $p->qty), 2) }}</h4>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm font-medium">Low Stock Items</p>
                <h4 class="text-2xl font-bold text-red-500">{{ $products->where('qty', '<', 5)->count() }}</h4>
            </div>
        </div>

        <div class="bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden">

            <div class="p-6 border-b border-gray-50 flex flex-col md:flex-row justify-between items-center gap-4">
                <form action="{{ route('product.index') }}" method="GET" class="relative w-full md:w-96">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">🔍</span>
                    <input type="text" name="search" placeholder="Search by name..." value="{{ request('search') }}"
                           class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                </form>

                <div class="flex gap-3">
                    <button class="px-4 py-2 border border-gray-200 rounded-xl hover:bg-gray-50 transition text-gray-600">Export</button>
                    <a href="{{ route('product.create') }}" class=" btn btn-outline bg-info hover:bg-info-dark text-white px-6 py-2 rounded-xl shadow-md shadow-blue-200 transition">
                        + Add Product
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50/50 text-gray-500 uppercase text-xs font-bold tracking-wider">
                            <th class="px-6 py-4 text-left">Product</th>
                            <th class="px-6 py-4 text-left">Price</th>
                            <th class="px-6 py-4 text-left">Inventory</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($products as $product)
                        <tr class="hover:bg-gray-50/80 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                        @if($product->image && Storage::disk('public')->exists($product->image))
                                            <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-xs text-gray-400">N/A</div>
                                        @endif
                                    </div>
                                    <span class="font-semibold text-gray-800">{{ $product->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-700">
                                ${{ number_format($product->price, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $product->qty < 5 ? 'bg-red-100 text-red-600' : 'bg-blue-50 text-blue-600' }}">
                                    {{ $product->qty }} in stock
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2 underline-hidden">
                                    <a href="{{ route('product.show',$product->id) }}" class="p-2 text-gray-400 hover:text-blue-600 transition  no-underline " title="View">👁️</a>
                                    <a href="{{ route('product.edit',$product->id) }}" class="p-2 text-gray-400 hover:text-green-600 transition  no-underline " title="Edit">✏️</a>
                                    <form action="{{ route('product.destroy',$product->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Delete this product?')" class="p-2 text-gray-400 hover:text-red-600 transition" title="Delete">🗑️</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-12 text-gray-400">No products found matching your search.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-6 bg-gray-50 border-t border-gray-100">
                {{ $products->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</div>
</x-layout>
