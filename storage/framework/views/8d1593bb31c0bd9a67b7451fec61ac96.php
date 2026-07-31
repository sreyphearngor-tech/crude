<?php $__env->startSection('content'); ?>
<div class="flex flex-col lg:flex-row items-center pt-10 lg:pt-20 pb-24 relative">

    <!-- ផ្នែករូបភាពខាងឆ្វេង (Side Image) -->
    <div class="w-full lg:w-7/12 bg-[#CBE4E8] flex justify-center items-center py-10 lg:py-20">
        <img src="<?php echo e(asset('images/watch3.jpg')); ?>" alt="Shopping Cart and Phone" class="w-full max-w-[600px] h-auto object-contain">
    </div>

    <!-- ផ្នែក Form ខាងស្តាំ -->
    <div class="w-full lg:w-5/12 px-6 sm:px-12 lg:px-24 mt-10 lg:mt-0 relative">

        <!-- Close Icon Button -->
        <a href="<?php echo e(url('/')); ?>" class="absolute top-0 right-6 lg:right-10 text-red-700 hover:text-black transition-colors" title="Close">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a>

        <div class="max-w-[400px] mx-auto">
            <h2 class="text-4xl font-semibold mb-3 tracking-wide text-black">Log in to Exclusive</h2>
            <p class="text-black mb-12">Enter your details below</p>

            <form action="<?php echo e(route('login')); ?>" method="POST" class="space-y-10">
                <?php echo csrf_field(); ?>

                <?php if($errors->any()): ?>
                    <div class="text-red-500 text-sm">
                        <?php echo e($errors->first()); ?>

                    </div>
                <?php endif; ?>

                <div class="relative">
                    <input type="email" name="email" placeholder="Email" value="<?php echo e(old('email')); ?>"
                        class="w-full border-b border-gray-400 py-2 focus:outline-none focus:border-black transition-colors text-black placeholder-gray-500 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                </div>

                <div class="relative">
                    <input type="password" name="password" placeholder="Password"
                        class="w-full border-b border-gray-400 py-2 focus:outline-none focus:border-black transition-colors text-black placeholder-gray-500 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                </div>

                <div class="pt-4 flex items-center justify-between gap-4">
                    <button type="submit" class="bg-red-500 text-white px-12 py-4 rounded-sm font-medium hover:bg-red-600 transition duration-300">
                        Log In
                    </button>
                 <a href="<?php echo e(route('change-password.form')); ?>" class="text-red-500 hover:text-red-700">
    Forgot Password?
</a>
                </div>
            </form>

            <p class="text-center mt-10 text-gray-600">
                Don't have an account?
                <a href="<?php echo e(route('register')); ?>" class="text-black font-bold border-b border-gray-500 ml-2 hover:text-red-500 hover:border-red-500">Sign Up</a>
            </p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\migrate\crude\resources\views/auth/login.blade.php ENDPATH**/ ?>