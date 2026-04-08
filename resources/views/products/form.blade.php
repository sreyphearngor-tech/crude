<div class="min-h-screen bg-gradient-to-br from-blue-50 to-gray-100 flex items-center justify-center py-12">
  <div class="w-full max-w-lg bg-white shadow-2xl rounded-3xl p-10">

    <!-- Success Message -->
    @if(session('success'))
      <div class="bg-green-100 text-green-800 font-medium p-4 rounded-lg mb-6 border border-green-200">
        {{ session('success') }}
      </div>
    @endif

    <!-- Dynamic Title -->
    <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">
      {{ isset($product) ? 'Edit Product' : 'Add New Product' }}
    </h2>
<div class="space-y-4">

    <!-- Product Name -->
    <div>
        <label class="block mb-2 font-semibold text-gray-700">Product Name</label>
        <input type="text" name="name"
               value="{{ old('name', $product->name ?? '') }}"
               class="w-full px-5 py-3 border border-gray-300 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
        @error('name')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
        @enderror
    </div>

    <!-- Price -->
    <div>
        <label class="block mb-2 font-semibold text-gray-700">Price</label>
        <input type="number" name="price"
               value="{{ old('price', $product->price ?? '') }}"
               class="w-full px-5 py-3 border border-gray-300 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400">
        @error('price')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
        @enderror
    </div>

    <!-- Quantity -->
    <div>
        <label class="block mb-2 font-semibold text-gray-700">Quantity</label>
        <input type="number" name="qty"
               value="{{ old('qty', $product->qty ?? '') }}"
               class="w-full px-5 py-3 border border-gray-300 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
        @error('qty')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
        @enderror
    </div>

    <!-- Image Upload -->
    <div>
        <label class="block mb-2 font-semibold text-gray-700">Product Image</label>
        <input type="file" name="image" id="imageInput" accept="image/*"
               class="w-full px-5 py-3 border border-gray-300 rounded-2xl bg-gray-50">
        @error('image')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
        @enderror

        <!-- Selected Image Preview -->
        <img id="previewImage" src="#" alt="Image Preview" class="mt-4 max-h-48 rounded-lg shadow-md hidden">

        <!-- Current Image -->
        @if(isset($product) && $product->image)
            <div class="mt-4 current-image">
                <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" class="h-16 w-16 rounded-xl shadow-md">
            </div>
        @endif
    </div>

</div>

<!-- Live Preview JS -->
<script>
const input = document.getElementById('imageInput');
const preview = document.getElementById('previewImage');

input.addEventListener('change', function(e) {
    const file = e.target.files[0];
    const currentImage = document.querySelector('.current-image');

    if(file) {
        // Show image preview
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);

        // Hide current image
        if(currentImage) {
            currentImage.style.display = 'none';
        }
    } else {
        // If no file, hide preview and show current image
        preview.classList.add('hidden');
        if(currentImage) {
            currentImage.style.display = 'block';
        }
    }
});
</script>
