{{-- resources/views/products/table.blade.php --}}
<div class="bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50/50">
            <tr class="text-gray-500 text-left text-xs uppercase font-bold tracking-wider">
                <th class="px-6 py-4 text-center">Thumbnail</th>
                <th class="px-6 py-4">Product Info</th>
                <th class="px-6 py-4 text-center">Category</th>
                <th class="px-6 py-4 text-center">Price</th>
                <th class="px-6 py-4 text-center">Stock Status</th>
                <th class="px-6 py-4 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 bg-white">
            @forelse($products as $product)
                <tr class="hover:bg-blue-50/30 transition-colors">
                    <td class="px-6 py-4 flex justify-center">
                        <img src="{{ asset('storage/products/' . $product->image) }}"
                            class="w-12 h-12 rounded-lg object-cover border shadow-sm">
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-semibold text-gray-900">{{ $product->name }}</div>
                        <div class="text-xs text-gray-400">Ref: SKU-{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-medium">
                            {{ $product->category->name ?? 'None' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center text-sm font-bold text-gray-900">
                        ${{ number_format($product->price, 2) }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center">
                            <span
                                class="w-2 h-2 rounded-full mr-2 {{ $product->qty > 10 ? 'bg-green-500 shadow-green-200' : 'bg-red-500 shadow-red-200' }} shadow-lg"></span>
                            <span
                                class="text-sm {{ $product->qty > 10 ? 'text-gray-600' : 'text-red-600 font-medium' }}">
                                {{ $product->qty }} in stock
                            </span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.product.edit', $product->id) }}"
                                class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                            </a>
                            <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST"
                                onsubmit="return confirm('Archive this product?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                        <p class="italic">No products found matching your criteria.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- CUSTOM PAGINATION CONTAINER --}}
<div class="mt-6 flex justify-center">
    <nav class="flex items-center gap-4">
        {{-- ប៊ូតុងថយក្រោយ --}}
        @if ($products->onFirstPage())
            <span class="px-4 py-2 text-gray-400 bg-gray-100 rounded-xl cursor-not-allowed text-sm font-bold">
                «
            </span>
        @else
            <a href="{{ $products->previousPageUrl() }}"
                class="pagination-link px-4 py-2 bg-white border border-gray-200 text-blue-600 rounded-xl hover:bg-blue-50 transition text-sm font-bold shadow-sm">
                «
            </a>
        @endif

        {{-- ប៊ូតុងទៅមុខ --}}
        @if ($products->hasMorePages())
            <a href="{{ $products->nextPageUrl() }}"
                class="pagination-link px-4 py-2 bg-white border border-gray-200 text-blue-600 rounded-xl hover:bg-blue-50 transition text-sm font-bold shadow-sm">
                ទៅមុខ »
            </a>
        @else
            <span class="px-4 py-2 text-gray-400 bg-gray-100 rounded-xl cursor-not-allowed text-sm font-bold">
                ទៅមុខ »
            </span>
        @endif
    </nav>
</div>
