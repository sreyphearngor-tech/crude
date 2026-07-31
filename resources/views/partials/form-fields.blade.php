<div>
    <label class="block mb-1 font-bold text-gray-700 uppercase text-xs tracking-wider">Category</label>
    <select name="category_id" class="w-full px-4 py-2 border border-gray-200 rounded-lg">
        <option value="" disabled {{ !$product->category_id ? 'selected' : '' }}>Choose Category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>
