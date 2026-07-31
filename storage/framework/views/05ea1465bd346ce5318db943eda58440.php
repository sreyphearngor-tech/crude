<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 md:px-12 lg:px-24 py-16 flex flex-col md:flex-row items-center gap-10">

    <!-- ផ្នែករូបភាពខាងឆ្វេង -->
    <div class="w-full md:w-1/2 bg-[#CBE4E8] rounded-r-md flex justify-center items-center p-10">
        <img src="<?php echo e(asset('images/watch3.jpg')); ?>" alt="Register" class="max-w-full h-auto object-contain">
    </div>

    <!-- ផ្នែក Form ចុះឈ្មោះខាងស្តាំ -->
    <!-- ផ្នែក Form ខាងស្តាំ -->
    <div class="w-full lg:w-5/12 px-6 sm:px-12 lg:px-24 mt-10 lg:mt-0 relative">

 <!-- Close Icon Button -->
        <a href="<?php echo e(url('/')); ?>" class="absolute top-0 right-6 lg:right-10 text-red-700 hover:text-black transition-colors" title="Close">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a>
        <h1 class="text-4xl font-bold mb-4 tracking-wider">Create an account</h1>

        <p class="text-gray-600 mb-10">Enter your details below</p>

      <form action="<?php echo e(route('register')); ?>" method="POST" class="space-y-8">
    <?php echo csrf_field(); ?>

    <!-- Input Name -->
    <div class="border-b border-gray-400">
        <input type="text" name="name" value="<?php echo e(old('name')); ?>" placeholder="Name" class="w-full py-2 focus:outline-none bg-transparent" required>
    </div>
    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <!-- Input Email -->
    <div class="border-b border-gray-400">
        <input type="text" name="email" value="<?php echo e(old('email')); ?>" placeholder="Email" class="w-full py-2 focus:outline-none bg-transparent" required>
    </div>
    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <!-- Input Password -->
    <div class="border-b border-gray-400">
        <input type="password" name="password" placeholder="Password" class="w-full py-2 focus:outline-none bg-transparent" required>
    </div>
    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <button type="submit" class="w-full bg-red-500 ...">Create Account</button>
</form>
        <!-- លីងទៅកាន់ទំព័រ Login -->
        <p class="text-center mt-8 text-gray-600">
            Already have account?
            <a href="<?php echo e(route('login')); ?>" class="text-black font-bold border-b border-gray-500 ml-2 hover:text-red-500 hover:border-red-500">Log in</a>
        </p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\migrate\crude\resources\views/auth/register.blade.php ENDPATH**/ ?>