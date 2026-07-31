<?php $__env->startSection('content'); ?>
    <div
        class="max-w-md mx-auto bg-white min-h-screen shadow-md rounded-lg overflow-hidden flex flex-col justify-between p-6">
        <!-- Spacer top -->
        <div></div>

        <!-- Success Content -->
        <div class="text-center px-4">
            <div class="flex justify-center mb-8 relative">
                <!-- Icon/Illustration mimicking Screen-4 -->
                <div class="relative w-48 h-48 flex items-center justify-center">
                    <div class="absolute inset-0 bg-green-50 rounded-full scale-110 opacity-60 animate-pulse"></div>
                    <!-- success badge -->
                    <i class="fa-solid fa-circle-check text-green-500 text-8xl z-10"></i>
                </div>
            </div>

            <h2 class="text-2xl font-black text-gray-800 mb-3">Your order has been placed successfully</h2>
            <p class="text-gray-400 text-sm leading-relaxed">
                Thank you for choosing us! Feel free to continue shopping and explore our wide range of products. Happy
                Shopping!
            </p>
        </div>

        <!-- Action Button -->
        <div class="mt-8">
            <a href="<?php echo e(route('home')); ?>"
                class="block text-center w-full bg-black text-white py-4 rounded-full font-bold uppercase text-sm hover:bg-gray-900 transition">
                Continue Shopping
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\migrate\crude\resources\views/checkout/success.blade.php ENDPATH**/ ?>