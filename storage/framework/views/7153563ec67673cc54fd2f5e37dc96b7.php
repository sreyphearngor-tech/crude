<?php $__env->startSection('content'); ?>
    <div class="container mx-auto px-4 md:px-12 lg:px-24">
        <!-- Hero Section -->
        <div class="flex flex-col md:flex-row gap-8 py-10">
            <!-- Sidebar Navigation -->
            <aside class="w-full md:w-1/4 border-r border-gray-200 pr-4 hidden md:block">
                <ul class="space-y-4 font-medium text-gray-700">
                    <?php if(isset($categories) && $categories->count() > 0): ?>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e(route('category.products', $cat->id)); ?>"
                                    class="flex justify-between items-center cursor-pointer hover:text-[#DB4444] transition">
                                    <?php echo e($cat->name); ?> <i class="fa-solid fa-chevron-right text-xs"></i>
                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <li class="text-gray-400 italic">No categories found</li>
                    <?php endif; ?>
                </ul>
            </aside>

            <!-- Main Banner -->
            <div
                class="w-full md:w-3/4 bg-black text-white p-8 md:p-12 flex items-center relative rounded-sm overflow-hidden">
                <div class="z-10 relative">
                    <div class="flex items-center gap-4 mb-4">
                        <img src="<?php echo e(asset('images/Apple.jpg')); ?>" alt="Apple" class="w-8">
                        <span class="text-lg">iPhone 14 Series</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">Up to 10%<br>off Voucher</h1>
                    <a href="#" class="border-b-2 border-white pb-1 font-semibold hover:text-gray-300 transition">Shop
                        Now →</a>
                </div>
                <img src="<?php echo e(asset('images/watch3.jpg')); ?>" alt="Promo"
                    class="absolute right-0 bottom-0 w-2/3 object-contain opacity-80 md:opacity-100">
            </div>
        </div>

        <!-- Search Result Title (បង្ហាញតែពេលមានការ Search) -->
        <?php if(request('query')): ?>
            <div class="mb-10">
                <h2 class="text-2xl font-bold">Search Results for: <span
                        class="text-red-500">"<?php echo e(request('query')); ?>"</span></h2>
                <p class="text-gray-500">Found <?php echo e($products->count()); ?> items</p>
            </div>
        <?php endif; ?>

        <!-- Flash Sales Section -->
        <section class="mt-20">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-5 h-10 bg-red-500 rounded-sm"></div>
                <span class="text-red-500 font-bold">Today's</span>
            </div>

            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
                <div class="flex flex-wrap items-end gap-10 md:gap-20">
                    <h2 class="text-3xl md:text-4xl font-bold tracking-wider">Flash Sales</h2>
                    <!-- Countdown Timer -->
                    <div class="flex gap-4 text-center">
                        <div>
                            <p class="text-[10px] font-bold">Days</p>
                            <span id="days" class="text-2xl md:text-3xl font-black">00</span>
                        </div>
                        <span class="text-2xl md:text-3xl text-red-400 mt-4">:</span>
                        <div>
                            <p class="text-[10px] font-bold">Hours</p>
                            <span id="hours" class="text-2xl md:text-3xl font-black">00</span>
                        </div>
                        <span class="text-2xl md:text-3xl text-red-400 mt-4">:</span>
                        <div>
                            <p class="text-[10px] font-bold">Mins</p>
                            <span id="mins" class="text-2xl md:text-3xl font-black">00</span>
                        </div>
                        <span class="text-2xl md:text-3xl text-red-400 mt-4">:</span>
                        <div>
                            <p class="text-[10px] font-bold">Secs</p>
                            <span id="secs" class="text-2xl md:text-3xl font-black">00</span>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button class="p-3 bg-gray-100 rounded-full hover:bg-gray-200 transition">←</button>
                    <button class="p-3 bg-gray-100 rounded-full hover:bg-gray-200 transition">→</button>
                </div>
            </div>

            <!-- Product Grid (Flash Sales) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php if(isset($products) && $products->count() > 0): ?>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="group">
                            <div
                                class="bg-gray-100 rounded-md p-8 relative flex justify-center items-center h-64 overflow-hidden">
                                <?php if(isset($product->discount)): ?>
                                    <span
                                        class="absolute top-3 left-3 bg-red-500 text-white text-xs px-3 py-1 rounded">-<?php echo e($product->discount); ?>%</span>
                                <?php endif; ?>

                                <div class="absolute top-3 right-3 flex flex-col gap-2 z-20">
                                    <button
                                        class="bg-white p-2 rounded-full shadow-sm hover:bg-red-500 hover:text-white transition">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <a href="<?php echo e(route('product.show_detail', $product->id)); ?>"
                                        class="bg-white p-2 rounded-full shadow-sm hover:bg-red-500 hover:text-white transition flex items-center justify-center">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </div>

                                <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>"
                                    class="max-h-full object-contain transition-transform group-hover:scale-110"
                                    onerror="this.src='https://placehold.co/300x300?text=No+Image'">

                                <!-- Form Add To Cart -->
                                <form action="<?php echo e(route('cart.store')); ?>" method="POST"
                                    class="absolute bottom-0 left-0 w-full translate-y-full group-hover:translate-y-0 transition-all">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo e($product->id); ?>">
                                    <button type="submit"
                                        class="w-full bg-black text-white py-2 hover:bg-gray-800 transition">
                                        Add To Cart
                                    </button>
                                </form>
                            </div>

                            <div class="mt-4 space-y-2">
                                <h3 class="font-bold truncate text-gray-800"><?php echo e($product->name); ?></h3>
                                <div class="flex gap-3 font-medium">
                                    <span class="text-red-500">$<?php echo e(number_format($product->price, 2)); ?></span>
                                    <?php if(isset($product->old_price)): ?>
                                        <span
                                            class="text-gray-400 line-through">$<?php echo e(number_format($product->old_price, 2)); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="flex text-yellow-400 text-sm">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                            class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </div>
                                    <span
                                        class="text-gray-400 text-sm font-bold">(<?php echo e($product->reviews_count ?? 0); ?>)</span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <p class="col-span-full text-center text-gray-400">No products available at the moment.</p>
                <?php endif; ?>
            </div>

            <div class="flex justify-center mt-12">
                <a href="#"
                    class="bg-red-500 text-white px-12 py-4 rounded-sm font-medium hover:bg-red-600 transition">View All
                    Products</a>
            </div>
        </section>

        <hr class="my-20 border-gray-100">

        <!-- Categories Section -->
        <section>
            <div class="flex items-center gap-4 mb-6">
                <div class="w-5 h-10 bg-red-500 rounded-sm"></div>
                <span class="text-red-500 font-bold">Categories</span>
            </div>
            <div class="flex justify-between items-end mb-10">
                <h2 class="text-3xl font-bold tracking-wider text-gray-900">Browse By Category</h2>
                <div class="flex gap-2">
                    <button
                        class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-gray-200">←</button>
                    <button
                        class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-gray-200">→</button>
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                <?php if(isset($categories)): ?>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('category.products', $category->id)); ?>"
                            class="group border border-gray-200 rounded-md p-6 flex flex-col items-center justify-center gap-4 hover:bg-red-500 hover:text-white hover:border-red-500 transition-all cursor-pointer shadow-sm">
                            <div class="w-14 h-14 flex items-center justify-center">
                                <?php if($category->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $category->image)); ?>"
                                        class="w-full h-full object-contain group-hover:brightness-0 group-hover:invert">
                                <?php else: ?>
                                    <i class="fa-solid fa-layer-group text-3xl"></i>
                                <?php endif; ?>
                            </div>
                            <span class="text-sm font-medium"><?php echo e($category->name); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </section>

        <!-- Best Selling Section -->
        <section class="my-20">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-5 h-10 bg-red-500 rounded-sm"></div>
                <span class="text-red-500 font-bold">This Month</span>
            </div>
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-3xl font-bold tracking-wider text-gray-900">Best Selling Products</h2>
                <a href="#" class="bg-red-500 text-white px-10 py-3 rounded-sm hover:bg-red-600 transition">View
                    All</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php if(isset($bestSellingProducts) && $bestSellingProducts->count() > 0): ?>
                    <?php $__currentLoopData = $bestSellingProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="group">
                            <div
                                class="bg-gray-100 rounded-md p-10 relative overflow-hidden flex items-center justify-center h-64">
                                <img src="<?php echo e(asset('storage/' . $product->image)); ?>"
                                    class="max-h-full object-contain group-hover:scale-105 transition"
                                    onerror="this.src='https://placehold.co/300x300?text=No+Image'">

                                <div class="absolute top-4 right-4 flex flex-col gap-2">
                                    <button
                                        class="w-8 h-8 bg-white rounded-full flex items-center justify-center hover:bg-red-500 hover:text-white shadow-sm transition"><i
                                            class="fa-regular fa-heart"></i></button>
                                    <a href="<?php echo e(route('product.show_detail', $product->id)); ?>"
                                        class="w-8 h-8 bg-white rounded-full flex items-center justify-center hover:bg-red-500 hover:text-white shadow-sm transition">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                </div>

                                <form action="<?php echo e(route('cart.store')); ?>" method="POST"
                                    class="absolute bottom-0 left-0 w-full translate-y-full group-hover:translate-y-0 transition-all">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo e($product->id); ?>">
                                    <input type="hidden" name="size" :value="selectedSize">
                                    <button type="submit"
                                        class="w-full bg-black text-white py-2 hover:bg-gray-800 transition">
                                        Add To Cart
                                    </button>
                                </form>
                            </div>

                            <div class="mt-4">
                                <h3 class="font-bold text-lg mb-1 truncate text-gray-800"><?php echo e($product->name); ?></h3>
                                <div class="flex gap-3 items-center">
                                    <span class="text-red-500 font-bold">$<?php echo e(number_format($product->price, 2)); ?></span>
                                    <?php if(isset($product->old_price)): ?>
                                        <span
                                            class="text-gray-400 line-through text-sm">$<?php echo e(number_format($product->old_price, 2)); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <p class="col-span-full text-center text-gray-400 italic">No best selling products to show.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Banner Section -->
        <section class="mb-20">
            <div class="w-full h-[500px] md:h-[400px] mt-10 overflow-hidden rounded-md relative bg-gray-200">
                <img src="<?php echo e(asset('images/banner1.jpg.png')); ?>" alt="Promo Banner"
                    class="w-full h-full object-cover shadow-lg"
                    onerror="this.onerror=null; this.src='https://placehold.co/1200x400?text=Banner+Not+Found';">
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<script>
    // កំណត់ថ្ងៃទី៩ ខែឧសភា ឆ្នាំ២០២៦ ម៉ោង ២:២៧ រសៀល (14:27)
    const targetDate = new Date("May 9, 2026 14:27:00").getTime();

    const timer = setInterval(function() {
        const now = new Date().getTime();
        const diff = targetDate - now;

        // គណនា ថ្ងៃ ម៉ោង នាទី វិនាទី
        const d = Math.floor(diff / (1000 * 60 * 60 * 24));
        const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const s = Math.floor((diff % (1000 * 60)) / 1000);

        // បង្ហាញទៅលើ HTML (ប្រើ padStart ដើម្បីថែមលេខ 0 នៅខាងមុខបើទាបជាង ១០)
        document.getElementById("days").innerText = d.toString().padStart(2, '0');
        document.getElementById("hours").innerText = h.toString().padStart(2, '0');
        document.getElementById("mins").innerText = m.toString().padStart(2, '0');
        document.getElementById("secs").innerText = s.toString().padStart(2, '0');

        // បើដល់ពេលកំណត់ ឱ្យវាឈប់ដើរ
        if (diff < 0) {
            clearInterval(timer);
            document.getElementById("days").innerText = "00";
            document.getElementById("hours").innerText = "00";
            document.getElementById("mins").innerText = "00";
            document.getElementById("secs").innerText = "00";
        }
    }, 1000);
</script>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\migrate\crude\resources\views/home.blade.php ENDPATH**/ ?>