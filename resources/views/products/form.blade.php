
  <div class="min-h-screen bg-gradient-to-br from-blue-50 to-gray-100 flex items-center justify-center py-12">
    <div class="w-full max-w-lg bg-white shadow-2xl rounded-3xl p-10">

      <!-- Success Message -->
      @if(session('success'))
        <div class="bg-green-100 text-green-800 font-medium p-4 rounded-lg mb-6 border border-green-200">
          {{ session('success') }}
        </div>
      @endif

      <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Add New Product</h2>
      <!-- Product Name -->
        <div>
          <label class="block mb-2 font-semibold text-gray-700">Product Name</label>
          <input type="text" name="name" value="{{ old('name') }}"
            class="w-full px-5 py-3 border border-gray-300 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200">
          @error('name')
          span class="text-red-500 text-sm mt-1">{{ $message }}</span>
         
          @enderror
        </div>

        <!-- Price -->
        <div>
          <label class="block mb-2 font-semibold text-gray-700">Price</label>
          <input type="number" name="price" value="{{ old('price') }}"
            class="w-full px-5 py-3 border border-gray-300 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-200">
          @error('price')
          span class="text-red-500 text-sm mt-1">{{ $message }}</span>
         
          @enderror
        </div>

        <!-- Quantity -->
        <div>
          <label class="block mb-2 font-semibold text-gray-700">Quantity</label>
          <input type="number" name="qty" value="{{ old('qty') }}"
            class="w-full px-5 py-3 border border-gray-300 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-400 transition duration-200">
           @error('qty')
          span class="text-red-500 text-sm mt-1">{{ $message }}</span>
         
          @enderror
        </div>

        <!-- Image -->
        <div>
          <label class="block mb-2 font-semibold text-gray-700">Product Image</label>
          <input type="file" name="image"
            class="w-full px-5 py-3 border border-gray-300 rounded-2xl bg-gray-50 hover:bg-gray-100 transition duration-200 cursor-pointer">
           @error('image')
          span class="text-red-500 text-sm mt-1">{{ $message }}</span>
         
          @enderror
        </div>

        <!-- Submit Button -->
        <div>
          <button type="submit"
            class="w-full py-3 bg-blue-500 text-white font-semibold rounded-2xl shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200">
            Add Product
          </button>
        </div>
    </div>
  </div>
