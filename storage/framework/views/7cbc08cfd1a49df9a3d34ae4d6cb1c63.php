<?php $__env->startSection('content'); ?>
    <div
        class="max-w-md mx-auto bg-white min-h-screen shadow-md rounded-lg overflow-hidden flex flex-col justify-between p-6">
        <div>
            <!-- Back Button & Header -->
            <div class="flex items-center justify-between mb-8">
                <a href="<?php echo e(route('checkout.shipping')); ?>" class="text-gray-800 hover:text-black">
                    <i class="fa-solid fa-arrow-left text-lg"></i>
                </a>
                <h2 class="text-lg font-bold text-gray-800">Checkout</h2>
                <div class="relative">
                    <i class="fa-solid fa-cart-shopping text-lg text-gray-800"></i>
                    <span
                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full text-xs w-4 h-4 flex items-center justify-center">
                        <?php echo e(count(session('cart', []))); ?>

                    </span>
                </div>
            </div>

            <!-- Progress Tracker -->
            <div class="flex items-center justify-between px-4 mb-10">
                <div class="flex flex-col items-center">
                    <div
                        class="w-8 h-8 rounded-full bg-black text-white flex items-center justify-center text-sm font-bold">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <span class="text-xs mt-1 text-gray-400">Shipping</span>
                </div>
                <div class="flex-1 h-0.5 bg-black mx-2 mb-4"></div>
                <div class="flex flex-col items-center">
                    <div
                        class="w-8 h-8 rounded-full bg-black text-white flex items-center justify-center text-sm font-bold">
                        <i class="fa-solid fa-credit-card"></i>
                    </div>
                    <span class="text-xs mt-1 font-semibold">Payment</span>
                </div>
                <div class="flex-1 h-0.5 bg-gray-200 mx-2 mb-4"></div>
                <div class="flex flex-col items-center">
                    <div
                        class="w-8 h-8 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center text-sm font-bold">
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>
                    <span class="text-xs mt-1 text-gray-400">Review</span>
                </div>
            </div>

            <h3 class="text-center font-bold text-gray-800 mb-6">Select a Payment Method</h3>

            <!-- Payment Form -->
            <form id="payment-form" action="<?php echo e(route('checkout.payment.save')); ?>" method="POST" class="space-y-6">
                <?php echo csrf_field(); ?>

                <!-- Payment Methods Radio Group -->
                <div class="space-y-3">
                    <label
                        class="flex items-center justify-between border border-gray-200 rounded-xl p-4 cursor-pointer hover:bg-gray-50 transition">
                        <div class="flex items-center gap-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg"
                                class="h-6 w-10 object-contain" alt="Mastercard">
                            <span class="font-bold text-sm text-gray-800 italic">Credit Card</span>
                        </div>
                        <input type="radio" name="payment_method" value="credit_card" checked
                            class="w-4 h-4 accent-black">
                    </label>

                    <label
                        class="flex items-center justify-between border border-gray-200 rounded-xl p-4 cursor-pointer hover:bg-gray-50 transition">
                        <div class="flex items-center gap-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal_Key_Logo.png"
                                class="h-6 w-10 object-contain" alt="PayPal">
                            <span class="font-bold text-sm text-gray-800 italic">PayPal</span>
                        </div>
                        <input type="radio" name="payment_method" value="paypal" class="w-4 h-4 accent-black">
                    </label>

                    <label
                        class="flex items-center justify-between border border-gray-200 rounded-xl p-4 cursor-pointer hover:bg-gray-50 transition">
                        <div class="flex items-center gap-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/f/f2/Google_Pay_Logo.svg"
                                class="h-6 w-10 object-contain" alt="Google Pay">
                            <span class="font-bold text-sm text-gray-800 italic">Google Pay</span>
                        </div>
                        <input type="radio" name="payment_method" value="google_pay" class="w-4 h-4 accent-black">
                    </label>
                </div>

                <!-- Credit Card Form Group (Will toggle visibility if needed, keep static as screen 2 layout) -->
                <div id="credit-card-inputs" class="space-y-4 mt-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Card Holder Name</label>
                        <input type="text" name="card_holder_name" placeholder="Enter card holder name"
                            class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-black">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Card Number</label>
                        <input type="text" name="card_number" placeholder="4111 1111 1111 1111"
                            class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-black">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Expiry Date</label>
                            <input type="text" name="expiry_date" placeholder="MM/YY"
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-black">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">CVV</label>
                            <input type="text" name="cvv" placeholder="123"
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-black">
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="mt-8">
            <button type="submit" form="payment-form"
                class="w-full bg-black text-white py-4 rounded-full font-bold uppercase text-sm hover:bg-gray-900 transition">
                Confirm
            </button>
        </div>
    </div>

    <script>
        // JS សម្រាប់បើកបិទ ផ្ទាំងបំពេញកាតបើជ្រើសរើសប្រភេទផ្សេង
        document.querySelectorAll('input[name="payment_method"]').forEach((radio) => {
            radio.addEventListener('change', function() {
                const cardInputs = document.getElementById('credit-card-inputs');
                if (this.value === 'credit_card') {
                    cardInputs.style.display = 'block';
                } else {
                    cardInputs.style.display = 'none';
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\migrate\crude\resources\views/checkout/payment.blade.php ENDPATH**/ ?>