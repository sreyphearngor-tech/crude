<x-layout>
    <div class="flex min-h-screen bg-gray-50">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white shadow-xl p-6 flex flex-col sticky top-0 h-screen">
            <div class="flex items-center gap-3 mb-10">
                <div class="bg-blue-600 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h1 class="text-xl font-black tracking-tight">eProduct <span class="text-blue-500">Admin</span></h1>
            </div>

            <nav class="flex-1 flex flex-col gap-2">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Main Menu</p>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-lg' : 'hover:bg-gray-800 text-gray-400' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.product.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.product.*') ? 'bg-blue-600 text-white shadow-lg' : 'hover:bg-gray-800 text-gray-400' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Products
                </a>
            </nav>

            <div class="mt-auto">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-400 hover:bg-red-500/10 transition mt-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 p-8 overflow-y-auto">
            <header class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Add New Product</h2>
                    <p class="text-gray-500">Fill in the details to add a new product to your store.</p>
                </div>
                <div
                    class="text-sm font-bold text-gray-400 bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-100">
                    {{ now()->format('d M, Y') }}
                </div>
            </header>

            <div class="max-w-5xl mx-auto pb-20">
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-xl">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                        <!-- Left Column: Primary Details -->
                        <div class="lg:col-span-2 space-y-6">
                            <!-- Basic Info Card -->
                            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    General Information
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Product
                                            Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            placeholder="Enter product name..." required
                                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition">
                                    </div>
                                    <div>
                                        <label
                                            class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                                        <span class="text-xs text-gray-400 mb-1 block">Describe the key features and
                                            details of the product.</span>
                                        <textarea name="description" rows="6" placeholder="Write something about this product..."
                                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Media Card -->
                            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Product Images
                                </h3>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    @for ($i = 1; $i <= 4; $i++)
                                        <div class="relative group">
                                            <label
                                                class="flex flex-col items-center justify-center h-32 w-full border-2 border-dashed border-gray-200 rounded-2xl cursor-pointer hover:bg-blue-50 hover:border-blue-300 transition">
                                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                    <svg class="w-6 h-6 text-gray-400 group-hover:text-blue-500 mb-2"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                    <p
                                                        class="text-[10px] text-gray-500 uppercase font-bold text-center px-2">
                                                        Image {{ $i }} {{ $i == 1 ? '(Main)' : '' }}</p>
                                                </div>
                                                <input type="file" name="image{{ $i == 1 ? '' : $i }}"
                                                    class="hidden" accept="image/*" />
                                            </label>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Sidebar Stats/Status -->
                        <div class="space-y-6">
                            <!-- Organization Card -->
                            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Organization
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Category</label>
                                            <button type="button" onclick="openCategoryModal()"
                                                class="text-blue-600 text-xs font-bold hover:underline">+ Add
                                                New</button>
                                        </div>
                                        <select name="category_id" id="category_id" required
                                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Pricing & Inventory Card -->
                            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Pricing &
                                    Stock</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Price ($)</label>
                                        <input type="number" step="0.01" name="price"
                                            value="{{ old('price') }}" placeholder="0.00" required
                                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Quantity in
                                            Stock</label>
                                        <input type="number" name="qty" value="{{ old('qty') }}"
                                            placeholder="0" required
                                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex flex-col gap-3">
                                <button type="submit"
                                    class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 transition transform hover:-translate-y-0.5">
                                    Save Product
                                </button>
                                <a href="{{ route('admin.product.index') }}"
                                    class="w-full bg-white text-gray-500 font-bold py-3 rounded-xl border border-gray-200 text-center hover:bg-gray-50 transition">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Category Modal -->
            <div id="categoryModal"
                class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
                <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-sm">
                    <div class="flex items-center justify-between mb-4 border-b pb-3">
                        <h3 class="text-lg font-bold text-gray-800">Add New Category</h3>
                        <button type="button" onclick="closeCategoryModal()"
                            class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
                    </div>

                    <form id="ajaxCategoryForm">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                            <input type="text" id="newCategoryName" name="name" placeholder="e.g. Smartphones"
                                required
                                class="w-full border border-gray-200 p-2.5 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none bg-gray-50">
                            <p id="categoryError" class="text-red-500 text-xs mt-1 hidden"></p>
                        </div>

                        <div class="flex justify-end gap-2 pt-2">
                            <button type="button" onclick="closeCategoryModal()"
                                class="bg-gray-100 text-gray-700 px-4 py-2 rounded-xl hover:bg-gray-200 font-semibold transition">Cancel</button>
                            <button type="submit" id="saveCategoryBtn"
                                class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 font-semibold transition">Save
                                Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        /**
         * Admin Dashboard - Category AJAX Management
         */

        // Open the Category Modal
        function openCategoryModal() {
            const modal = document.getElementById('categoryModal');
            if (modal) {
                modal.classList.remove('hidden');
                document.getElementById('newCategoryName').focus();
            }
        }

        // Close the Category Modal & Reset States
        function closeCategoryModal() {
            const modal = document.getElementById('categoryModal');
            const form = document.getElementById('ajaxCategoryForm');
            const errorEl = document.getElementById('categoryError');

            if (modal) {
                modal.classList.add('hidden');
            }
            if (form) {
                form.reset();
            }
            if (errorEl) {
                errorEl.innerText = '';
                errorEl.classList.add('hidden');
            }
        }

        // Handle Form Submission
        document.addEventListener('DOMContentLoaded', function() {
            const categoryForm = document.getElementById('ajaxCategoryForm');

            if (categoryForm) {
                categoryForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const form = this;
                    const submitBtn = document.getElementById('saveCategoryBtn');
                    const errorEl = document.getElementById('categoryError');
                    const formData = new FormData(form);

                    // 1. UI Loading State
                    submitBtn.disabled = true;
                    submitBtn.innerText = 'Saving...';
                    errorEl.classList.add('hidden');
                    errorEl.innerText = '';

                    // 2. Fetch API Request
                    fetch("{{ route('categories.store') }}", {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest', // Tells Laravel this is an AJAX call
                                'Accept': 'application/json' // Forces Laravel to return JSON errors instead of redirects
                            },
                            body: formData
                        })
                        .then(async (response) => {
                            const data = await response.json();

                            // If response status code is not 200-299
                            if (!response.ok) {
                                // Handle Laravel Validation Failures (HTTP 422)
                                if (response.status === 422 && data.errors) {
                                    if (data.errors.name) {
                                        throw new Error(data.errors.name[
                                            0
                                            ]); // Returns specific rule text (e.g. "The name has already been taken.")
                                    }
                                }
                                // Handle General System/Server Failures (HTTP 500, etc)
                                throw new Error(data.message ||
                                    'An unexpected error occurred. Please try again.');
                            }

                            return data;
                        })
                        .then((data) => {
                            // 3. Success Workflow
                            alert(data.message ||
                                'រក្សាទុកជោគជ័យ!'); // Flashes Khmer success message

                            // Dynamically update the category selection dropdown on your main product form if it exists
                            const selectDropdown = document.getElementById('category_id');
                            if (selectDropdown) {
                                // Syntax: new Option(text, value, defaultSelected, selected)
                                const newOption = new Option(data.category.name, data.category.id,
                                    true, true);
                                selectDropdown.add(newOption);

                                // Trigger a change event in case you use select2 or custom select frameworks
                                selectDropdown.dispatchEvent(new Event('change'));
                            }

                            // Close and clean form components
                            closeCategoryModal();
                        })
                        .catch((error) => {
                            // 4. Error Display Workflow
                            errorEl.innerText = error.message;
                            errorEl.classList.remove('hidden');
                        })
                        .finally(() => {
                            // 5. Reset UI Interactive State
                            submitBtn.disabled = false;
                            submitBtn.innerText = 'Save Category';
                        });
                });
            }

            // Optional Close Trigger: Click outside modal container to dismiss it
            const modalWrapper = document.getElementById('categoryModal');
            if (modalWrapper) {
                modalWrapper.addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeCategoryModal();
                    }
                });
            }
        }); <
        /x-layout>
