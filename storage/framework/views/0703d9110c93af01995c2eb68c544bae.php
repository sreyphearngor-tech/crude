<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-10 md:px-12 lg:px-24">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500 mb-8">
        <a href="<?php echo e(route('home')); ?>" class="hover:text-red-500">Home</a> /
        <a href="<?php echo e(route('category.products', $product->category_id)); ?>" class="hover:text-red-500"><?php echo e($product->category->name); ?></a> /
        <span class="text-gray-800 font-medium"><?php echo e($product->name); ?></span>
    </nav>

    <div class="flex flex-col lg:flex-row gap-12">
        <!-- Left: Product Images -->
        <div class="w-full lg:w-3/5 flex flex-col-reverse md:flex-row gap-4">
            <!-- Thumbnail Images -->
            <div class="flex md:flex-col gap-4 overflow-x-auto md:overflow-y-auto">
                <?php $__currentLoopData = ['image', 'image2', 'image3', 'image4']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imgField): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($product->$imgField): ?>
                        <div class="w-20 h-20 md:w-24 md:h-24 bg-gray-100 rounded-md p-2 cursor-pointer border hover:border-red-500 transition-all thumbnail-btn"
                             onclick="changeMainImage('<?php echo e(asset('storage/' . $product->$imgField)); ?>')">
                            <img src="<?php echo e(asset('storage/' . $product->$imgField)); ?>" class="w-full h-full object-contain">
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Main Image -->
            <div class="flex-1 bg-gray-100 rounded-lg p-10 flex items-center justify-center min-h-[400px]">
                <img id="mainImage" src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" class="max-w-full max-h-[500px] object-contain transition-all duration-300">
            </div>
        </div>

        <!-- Right: Product Info -->
        <div class="w-full lg:w-2/5 space-y-6">
            <h1 class="text-3xl font-bold text-gray-900"><?php echo e($product->name); ?></h1>

            <div class="flex items-center gap-4">
                <div class="flex text-yellow-400 text-sm">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <span class="text-gray-400 text-sm">(150 Reviews)</span>
                <span class="text-green-500 text-sm font-medium border-l pl-4">In Stock (<?php echo e($product->qty); ?>)</span>
            </div>

            <div class="text-2xl font-semibold text-gray-900">
                $<?php echo e(number_format($product->price, 2)); ?>

            </div>

            <p class="text-gray-600 leading-relaxed border-b pb-6">
                <?php echo e($product->description ?? 'No description available for this product.'); ?>

            </p>

            <!-- Product Options (Optional) -->
            <div class="space-y-4">
                <div class="flex items-center gap-4">
                    <span class="font-medium">Colours:</span>
                    <div class="flex gap-2">
                        <div class="w-5 h-5 rounded-full bg-blue-500 cursor-pointer border-2 border-white ring-1 ring-gray-300"></div>
                        <div class="w-5 h-5 rounded-full bg-red-500 cursor-pointer"></div>
                    </div>
                </div>
            </div>

            <!-- Quantity & Buy Action -->
            <form action="<?php echo e(route('cart.store')); ?>" method="POST" class="flex flex-col sm:flex-row gap-4 pt-4">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($product->id); ?>">

                <div class="flex border rounded-md overflow-hidden w-fit">
                    <button type="button" onclick="updateQty(-1)" class="px-4 py-2 hover:bg-red-500 hover:text-white transition-colors">-</button>
                    <input type="number" name="quantity" id="prod_qty" value="1" min="1" max="<?php echo e($product->qty); ?>" class="w-16 text-center border-x focus:outline-none appearance-none">
                    <button type="button" onclick="updateQty(1)" class="px-4 py-2 hover:bg-red-500 hover:text-white transition-colors">+</button>
                </div>

                <button type="submit" class="flex-1 bg-red-500 text-white py-3 rounded-md font-bold hover:bg-red-600 transition-all shadow-lg shadow-red-100">
                    Buy Now
                </button>

                <button type="button" class="p-3 border rounded-md hover:bg-gray-50">
                    <i class="far fa-heart text-xl"></i>
                </button>
            </form>

            <!-- Delivery Info Box -->
            <div class="border rounded-md divide-y mt-8">
                <div class="p-4 flex items-center gap-4">
                    <i class="fas fa-truck text-2xl"></i>
                    <div>
                        <p class="font-bold text-sm">Free Delivery</p>
                        <p class="text-xs text-gray-500 underline">Enter your postal code for Delivery Availability</p>
                    </div>
                </div>
                <div class="p-4 flex items-center gap-4">
                    <i class="fas fa-rotate text-2xl"></i>
                    <div>
                        <p class="font-bold text-sm">Return Delivery</p>
                        <p class="text-xs text-gray-500">Free 30 Days Delivery Returns. <a href="#" class="underline">Details</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // មុខងារប្តូររូបភាពធំ
    function changeMainImage(src) {
        const mainImg = document.getElementById('mainImage');
        mainImg.style.opacity = '0';
        setTimeout(() => {
            mainImg.src = src;
            mainImg.style.opacity = '1';
        }, 200);
    }

    // មុខងារបូកដកចំនួនទំនិញ
    function updateQty(val) {
        const input = document.getElementById('prod_qty');
        let current = parseInt(input.value);
        let max = parseInt(input.getAttribute('max'));

        if (current + val >= 1 && current + val <= max) {
            input.value = current + val;
        }
    }
</script>

<style>
    /* លាក់ប៊ូតុងព្រួញរបស់ input number */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\migrate\crude\resources\views/product_detail.blade.php ENDPATH**/ ?>