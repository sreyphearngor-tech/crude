<x-layout>
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4"
     x-data="{ activeImage: '{{ asset('storage/'.$product->image) }}' }">

    <div class="max-w-6xl w-full bg-white shadow-2xl rounded-3xl overflow-hidden flex flex-col md:flex-row border border-gray-100">

        {{-- Left: Image Section --}}
        <div class="w-full md:w-1/2 p-8 bg-gray-50">
            <div class="rounded-2xl overflow-hidden bg-white shadow-inner aspect-square flex items-center justify-center">
                <img :src="activeImage"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-contain transition-all duration-500">
            </div>

            <div class="grid grid-cols-4 gap-4 mt-6">
                {{-- Main Image Thumbnail --}}
                <div @click="activeImage = '{{ asset('storage/' . $product->image) }}'"
                     class="cursor-pointer rounded-lg overflow-hidden border-2 transition"
                     :class="activeImage === '{{ asset('storage/' . $product->image) }}' ? 'border-blue-600 shadow-md' : 'border-transparent hover:border-gray-300'">
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-20 object-cover">
                </div>

                {{-- Gallery Images Thumbnails --}}
                @foreach(['image2', 'image3', 'image4'] as $imgField)
                    @if($product->$imgField)
                        <div @click="activeImage = '{{ asset('storage/' . $product->$imgField) }}'"
                             class="cursor-pointer rounded-lg overflow-hidden border-2 transition"
                             :class="activeImage === '{{ asset('storage/' . $product->$imgField) }}' ? 'border-blue-600 shadow-md' : 'border-transparent hover:border-gray-300'">
                            <img src="{{ asset('storage/' . $product->$imgField) }}" class="w-full h-20 object-cover">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        {{-- Right: Content Section --}}
        <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center bg-white">
            <nav class="text-sm text-gray-400 mb-2 uppercase tracking-widest font-semibold">
                Product Details | {{ $product->category->name ?? 'General' }}
            </nav>
            <h2 class="text-4xl font-extrabold text-gray-900 leading-tight">
                {{ $product->name }}
            </h2>

            <div class="mt-4 flex items-baseline gap-4">
                <span class="text-4xl font-bold text-blue-600">
                    ${{ number_format($product->price, 2) }}
                </span>
            </div>

            {{-- Description Section --}}
            <div class="mt-6">
                <p class="text-gray-500 text-sm leading-relaxed">
                    {{ $product->description }}
                </p>
            </div>

            <div class="mt-6 space-y-3">
                <div class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 mr-2 {{ $product->qty > 0 ? 'text-green-500' : 'text-red-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span class="text-sm">Availability:
                        <span class="font-bold {{ $product->qty > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $product->qty > 0 ? $product->qty . ' units in stock' : 'Out of Stock' }}
                        </span>
                    </span>
                </div>
            </div>

            <div class="mt-8 border-t border-gray-100 pt-8 flex flex-col sm:flex-row gap-4">
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit"
                        {{ $product->qty <= 0 ? 'disabled' : '' }}
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl transition-all shadow-lg hover:shadow-blue-200 disabled:bg-gray-300 disabled:cursor-not-allowed">
                        {{ $product->qty > 0 ? 'Add to Shopping Bag' : 'Out of Stock' }}
                    </button>
                </form>

                <a href="{{ route('home') }}"
                   class="flex items-center justify-center bg-white border-2 border-gray-200 hover:border-gray-900 hover:text-gray-900 text-gray-500 px-8 py-4 rounded-xl font-bold transition-all">
                    Back
                </a>
            </div>
        </div>

    </div>
</div>
</x-layout>
