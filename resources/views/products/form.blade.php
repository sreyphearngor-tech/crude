<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-3xl bg-white shadow-sm border border-gray-200 rounded-lg p-8">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8 gap-5">
            <h2 class="text-3xl font-medium text-gray-800">
                {{ $product->exists ? 'Edit Product' : 'Create Product' }}
            </h2>
            <a href="{{ route('admin.product.index') }}" class="px-4 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition text-sm no-underline">
                back
            </a>
        </div>

        {{-- Dynamic Form Action --}}
        <form action="{{ $product->exists ? route('admin.product.update', $product->id) : route('admin.product.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">

            @csrf
            @if($product->exists) @method('PUT') @endif

            <div class="space-y-6">
                {{-- Product Name --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Product Name --}}
    <div class="col-span-2">
        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Product Name</label>
        <input type="text" name="name" value="{{ old('name', $product->name) }}"
               class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition shadow-sm">
        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

 {{-- Category Selection --}}
<div class="col-span-2 md:col-span-1">
    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Category</label>
    <select name="category_id"
            class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition shadow-sm text-gray-600">
        <option value="" selected disabled>Select a category</option>

        @foreach($categories as $cat)
            <option value="{{ $cat->id }}"
                {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
    {{-- Price & Qty --}}
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Price ($)</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl">
        </div>
        <div>
            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Stock Qty</label>
            <input type="number" name="qty" value="{{ old('qty', $product->qty) }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl">
        </div>
    </div>

    {{-- Description --}}
    <div class="col-span-2">
        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Description</label>
        <textarea name="description" rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl">{{ old('description', $product->description) }}</textarea>
    </div>

    {{-- Image Upload Section --}}
    <div class="col-span-2">
        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-4">Product Images (Up to 4)</label>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach(['image', 'image2', 'image3', 'image4'] as $index => $field)
            <div class="relative group aspect-square bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center overflow-hidden">
                <input type="file" name="{{ $field }}" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(this, 'p-{{ $field }}')">

                @if($product->$field)
                    <img id="p-{{ $field }}" src="{{ asset('storage/'.$product->$field) }}" class="absolute inset-0 w-full h-full object-cover">
                @else
                    <img id="p-{{ $field }}" class="absolute inset-0 w-full h-full object-cover hidden">
                    <div class="text-center">
                        <svg class="w-6 h-6 text-gray-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"></path></svg>
                        <span class="text-[10px] text-gray-400 font-bold uppercase">{{ $index == 0 ? 'Main' : 'Gallery' }}</span>
                    </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    function previewImage(input, id) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById(id);
                img.src = e.target.result;
                img.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
