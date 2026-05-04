@extends('layouts.app')

@section('content')
<div class="flex flex-col lg:flex-row items-center pt-10 lg:pt-20 pb-24">

    <!-- ផ្នែករូបភាពខាងឆ្វេង (Side Image) -->
    <div class="w-full lg:w-7/12 bg-[#CBE4E8] flex justify-center items-center py-10 lg:py-20">
        <!-- រូបភាពរទេះរុញ និងទូរស័ព្ទពី image_1e0232.png -->
        <img src="{{ asset('images/watch3.jpg') }}" alt="Shopping Cart and Phone" class="w-full max-w-[600px] h-auto object-contain">
    </div>

    <!-- ផ្នែក Form ខាងស្តាំ -->
    <div class="w-full lg:w-5/12 px-6 sm:px-12 lg:px-24 mt-10 lg:mt-0">
        <div class="max-w-[400px] mx-auto">
            <h2 class="text-4xl font-semibold mb-3 tracking-wide text-black">Log in to Exclusive</h2>
            <p class="text-black mb-12">Enter your details below</p>

         <form action="{{ route('login') }}" method="POST" class="space-y-10">
    @csrf

    <!-- បង្ហាញ Error សរុប (បើមាន) -->
    @if ($errors->any())
        <div class="text-red-500 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <!-- Input Email -->
    <div class="relative">
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
            class="w-full border-b border-gray-400 py-2 focus:outline-none focus:border-black transition-colors text-black placeholder-gray-500 @error('email') border-red-500 @enderror">
    </div>

    <!-- Input Password -->
    <div class="relative">
        <input type="password" name="password" placeholder="Password"
            class="w-full border-b border-gray-400 py-2 focus:outline-none focus:border-black transition-colors text-black placeholder-gray-500 @error('password') border-red-500 @enderror">
    </div>

    <div class="pt-4 flex items-center justify-between gap-4">
        <button type="submit" class="bg-red-500 text-white px-12 py-4 rounded-sm font-medium hover:bg-red-600 transition duration-300">
            Log In
        </button>
        <a href="#" class="text-red-500 hover:text-red-700 transition-colors">
            Forgot Password?
        </a>
    </div>
</form>

            <!-- លីងទៅកាន់ទំព័រ Register -->
            <p class="text-center mt-10 text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-black font-bold border-b border-gray-500 ml-2 hover:text-red-500 hover:border-red-500">Sign Up</a>
            </p>
        </div>
    </div>
</div>
@endsection
