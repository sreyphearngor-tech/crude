@forelse($products as $product)
<div class="bg-orager rounded-xl shadow-lg overflow-hidden flex flex-col hover:scale-105 transition">

    <div class="w-full h-88 overflow-hidden">
        @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}"
          alt="{{ $product->name }}"
          class="w-full h-full object-cover rounded">
        @else
            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                No Image
            </div>
        @endif
    </div>

    <div class="p-4 flex-1 flex flex-col">
        <h2 class="font-bold text-lg mb-2">{{ $product->name }}</h2>
        <p class="text-green-600 font-semibold mb-2">${{ $product->price }}</p>
        <p class="text-gray-700 mb-4">Qty: {{ $product->qty }}</p>
    </div>

</div>
@empty
<p class="text-center text-gray-500 col-span-4">No products found.</p>
@endforelse
