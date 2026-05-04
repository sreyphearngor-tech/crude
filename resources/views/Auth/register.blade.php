@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 md:px-12 lg:px-24 py-16 flex flex-col md:flex-row items-center gap-10">

    <!-- ផ្នែករូបភាពខាងឆ្វេង -->
    <div class="w-full md:w-1/2 bg-[#CBE4E8] rounded-r-md flex justify-center items-center p-10">
        <img src="{{ asset('images/watch3.jpg') }}" alt="Register" class="max-w-full h-auto object-contain">
    </div>

    <!-- ផ្នែក Form ចុះឈ្មោះខាងស្តាំ -->
    <div class="w-full md:w-1/2 max-w-md mx-auto">
        <h1 class="text-4xl font-bold mb-4 tracking-wider">Create an account</h1>
        <p class="text-gray-600 mb-10">Enter your details below</p>

      <form action="{{ route('register') }}" method="POST" class="space-y-8">
    @csrf

    <!-- Input Name -->
    <div class="border-b border-gray-400">
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" class="w-full py-2 focus:outline-none bg-transparent" required>
    </div>
    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

    <!-- Input Email -->
    <div class="border-b border-gray-400">
        <input type="text" name="email" value="{{ old('email') }}" placeholder="Email" class="w-full py-2 focus:outline-none bg-transparent" required>
    </div>
    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

    <!-- Input Password -->
    <div class="border-b border-gray-400">
        <input type="password" name="password" placeholder="Password" class="w-full py-2 focus:outline-none bg-transparent" required>
    </div>
    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

    <button type="submit" class="w-full bg-red-500 ...">Create Account</button>
</form>
        <!-- លីងទៅកាន់ទំព័រ Login -->
        <p class="text-center mt-8 text-gray-600">
            Already have account?
            <a href="{{ route('login') }}" class="text-black font-bold border-b border-gray-500 ml-2 hover:text-red-500 hover:border-red-500">Log in</a>
        </p>
    </div>
</div>
@endsection
