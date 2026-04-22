<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-3xl bg-white shadow-sm border border-gray-200 rounded-lg p-8">

        <div class="flex justify-between items-center mb-8 flex gap-5">
            <h2 class="text-3xl font-medium text-gray-800">
                {{ isset($product) ? 'Edit Product' : 'Create Product' }}
            </h2>
            <a href="{{ route('product.index') }}" class="px-4 py-1 bg-danger border text-white rounded-md hover:bg-red-600 transition text-sm">
                back
            </a>
        </div>


        <div class="flex justify-between items-center mb-8">

        </div>

        <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @if(isset($product)) @method('PUT') @endif

            <div>
                <label class="block mb-1 text-gray-700">Name</label>
                <input type="text" name="name" placeholder="Product Name"
                       value="{{ old('name', $product->name ?? '') }}"
                       class="w-full px-4 py-2 border border-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-400 placeholder-gray-300">
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block mb-1 text-gray-700">Product Price</label>
                <input type="number" name="price" placeholder="Price"
                       value="{{ old('price', $product->price ?? '') }}"
                       class="w-full px-4 py-2 border border-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-400 placeholder-gray-300">
                @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block mb-1 text-gray-700">Product Qty</label>
                <input type="number" name="qty" placeholder="Qty"
                       value="{{ old('qty', $product->qty ?? '') }}"
                       class="w-full px-4 py-2 border border-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-400 placeholder-gray-300">
                @error('qty') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block mb-1 text-gray-700">File upload</label>
                <div class="flex">
                    <input type="file" name="image" id="imageInput" accept="image/*"
                           class="flex-grow px-4 py-2 border border-gray-200 rounded-l focus:outline-none text-gray-400 border-r-0">
                    <button type="button" class="bg-indigo-500 text-white px-8 py-2 rounded-r hover:bg-indigo-600 transition">
                        Upload
                    </button>
                </div>
                <img id="previewImage" src="#" alt="Preview" class="mt-4 max-h-32 rounded border hidden">
                @if(isset($product) && $product->image)
                    <div class="mt-2 current-image">
                        <img src="{{ asset('storage/' . $product->image) }}" class="h-12 w-12 rounded border">
                    </div>
                @endif
   <img id="previewImage" src="#" alt="Image Preview" class="mt-4 max-h-48 rounded-lg shadow-md hidden">

        <!-- Current Image -->
        @if(isset($product) && $product->image)
            <div class="mt-4 current-image">
                <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" class="h-16 w-16 rounded-xl shadow-md">
            </div>
        @endif
            </div>

            <div>
                <label class="block mb-1 text-gray-700">Description</label>
                <textarea name="description" rows="4"
                          class="w-full px-4 py-2 border border-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-400"></textarea>
            </div>

            <div class="flex items-center space-x-5  pt-4 flex gap-5">
                <button type="submit" class="px-10 py-2 bg-emerald-400 text-white font-medium rounded hover:bg-emerald-500 transition">
                    Save
                </button>
                <button type="button " class="px-10 py-2  bg-gray-700 text-gray-700 font-medium rounded hover:bg-gray-400 transitionpx-10 py-2 bg-emerald-400 text-white font-medium rounded hover:bg-emerald-500 transition margin-right-14">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>






<script>
    const input = document.getElementById('imageInput');
    const preview = document.getElementById('previewImage');

    input.addEventListener('change', function(e) {
        const file = e.target.files;
        const currentImage = document.querySelector('.current-image');

        if(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
            if(currentImage) currentImage.style.display = 'none';
        }
    });
</script>
