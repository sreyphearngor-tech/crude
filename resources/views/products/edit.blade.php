<x-layout>
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-3xl bg-white shadow-sm border border-gray-200 rounded-lg p-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-medium text-gray-800">{{ $product->exists ? 'កែប្រែផលិតផល' : 'បន្ថែមផលិតផល' }}</h2>
            <a href="{{ route('admin.product.index') }}" class="px-4 py-1 bg-red-500 text-white rounded-md no-underline text-sm">ត្រឡប់ក្រោយ</a>
        </div>

        <form action="{{ $product->exists ? route('admin.product.update', $product->id) : route('admin.product.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @if($product->exists) @method('PUT') @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label class="block text-xs font-black uppercase text-gray-400 mb-2">ឈ្មោះផលិតផល</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl outline-none" required>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-gray-400 mb-2">ប្រភេទ</label>
                    <select name="category_id" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl outline-none" required>
                        <option value="" disabled selected>ជ្រើសរើសប្រភេទ</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <input type="number" step="0.01" name="price" placeholder="តម្លៃ ($)" value="{{ old('price', $product->price) }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl" required>
                    <input type="number" name="qty" placeholder="ចំនួន" value="{{ old('qty', $product->qty) }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl" required>
                </div>

                <div class="col-span-2">
                    <label class="block text-xs font-black uppercase text-gray-400 mb-4">រូបភាពផលិតផល (បានដល់ ៤ សន្លឹក)</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach(['image', 'image2', 'image3', 'image4'] as $index => $field)
                        <div class="relative aspect-square bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl flex items-center justify-center overflow-hidden">
                            <input type="file" name="{{ $field }}" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(this, 'p-{{ $field }}')">
                            <img id="p-{{ $field }}" src="{{ $product->$field ? asset('storage/'.$product->$field) : '' }}" class="absolute inset-0 w-full h-full object-cover {{ $product->$field ? '' : 'hidden' }}">
                            <div class="text-center {{ $product->$field ? 'hidden' : '' }}">
                                <span class="text-[10px] text-gray-400 font-bold uppercase">{{ $index == 0 ? 'រូបមេ' : 'រូបបន្ទាប់' }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 transition">រក្សាទុកទិន្នន័យ</button>
        </form>
    </div>
</div>

<script>
    function previewImage(input, id) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = document.getElementById(id);
                img.src = e.target.result;
                img.classList.remove('hidden');
                input.nextElementSibling.classList.add('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</x-layout>
