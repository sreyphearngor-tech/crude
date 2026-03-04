<x-layout>
<div class="min-h-screen bg-gray-100 py-10">
    <div class="max-w-6xl mx-auto bg-white shadow-2xl rounded-2xl p-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Product List</h2>
            <a href="{{ route('product.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow-md transition duration-300">
                + Add Product
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 uppercase text-sm">
                        <th class="p-3 text-left">Name</th>
                        <th class="p-3 text-left">Price</th>
                        <th class="p-3 text-left">Quantity</th>
                        <th class="p-3 text-left">Image</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach ($products as $product)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-3 font-medium text-gray-800">
                            {{ $product->name }}
                        </td>
                        <td class="p-3 text-green-600 font-semibold">
                            ${{ $product->price }}
                        </td>
                        <td class="p-3">
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                {{ $product->qty }}
                            </span>
                        </td>
                        <td class="p-3">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="w-20 h-20 object-cover rounded-lg shadow">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $products->links() }}
        </div>

    </div>
</div>
</x-layout>