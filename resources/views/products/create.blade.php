<x-layout>
<div class="flex min-h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-blue-400 shadow-lg p-6 flex flex-col">
        <h1 class="text-2xl font-bold text-gray-800 mb-10">eProduct</h1>
        <nav class="flex-1 flex flex-col gap-4">
            <a href="{{ route('product.index') }}"
               class=" px-4 py-2 rounded-lg hover:bg-blue-100 no-underline {{ request()->routeIs('product.*') ? 'bg-blue-100 font-semibold text-blue-600' : 'text-gray-700' }}"
                  style="text-decoration: none;">
               Products
            </a>
            <a href="#" class="px-4 py-2 rounded-lg hover:bg-blue-100 text-gray-700 no-underline"
               style="text-decoration: none;">
              Orders</a>
            <a href="#" class="px-4 py-2 rounded-lg hover:bg-blue-100 text-gray-700 no-underline"
               style="text-decoration: none;">
              Settings</a>
        </nav>

    </aside>

    <!-- Main Content -->
    <div class="flex-1 p-6">

        <!-- Top Navbar -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Add Product</h2>

        </div>

        <!-- Form Card -->
        <div class="bg-white shadow-2xl rounded-2xl p-6 max-w-3xl">
          <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Include the form partial -->
                @include('products.form')
            </form>
        </div>

    </div>
</div>
</x-layout>
