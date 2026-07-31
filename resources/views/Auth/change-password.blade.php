@extends('layouts.app')

@section('content')
<div class="flex flex-col lg:flex-row items-center pt-10 lg:pt-20 pb-24 relative">

    <!-- ប៊ូតុងត្រឡប់ក្រោយ (Close Icon) -->
    <a href="{{ route('login') }}" class="absolute top-0 right-6 lg:right-10 text-gray-400 hover:text-black transition-colors" title="Back to Login">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </a>

    <!-- ផ្នែករូបភាពខាងឆ្វេង -->
    <div class="w-full lg:w-7/12 bg-[#CBE4E8] flex justify-center items-center py-10 lg:py-20">
        <img src="{{ asset('images/watch3.jpg') }}" alt="Reset Password Image" class="w-full max-w-[600px] h-auto object-contain">
    </div>

    <!-- ផ្នែក Form ខាងស្តាំ -->
    <div class="w-full lg:w-5/12 px-6 sm:px-12 lg:px-24 mt-10 lg:mt-0">
        <div class="max-w-[400px] mx-auto">
            <h2 class="text-4xl font-semibold mb-3 tracking-wide text-black">Reset Password</h2>
            <p class="text-black mb-12">Enter your new password below to regain access to your account.</p>

            <!-- ផ្ញើសារជោគជ័យ (Success Messages) -->
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <!-- ផ្ញើសារកំហុសទូទៅ (Reset Token Expired / Invalid Link Errors) -->
            @if (session('email'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-sm">
                    {{ session('email') }}
                </div>
            @endif

         <form action="{{ route('change-password.update') }}" method="POST" class="space-y-10">
    @csrf

    <!-- Crucial Hidden Data from the email URL link -->
    <input type="hidden" name="token" value="{{ request()->route('token') }}">
    <input type="hidden" name="email" value="{{ request()->query('email') }}">

    <!-- New Password Field -->
    <div class="relative">
        <input type="password" name="new_password" placeholder="New Password" required
            class="w-full border-b border-gray-400 py-2 focus:outline-none focus:border-black transition-colors text-black placeholder-gray-500 @error('new_password') border-red-500 @enderror">
        @error('new_password')
            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
        @enderror
    </div>

    <!-- Confirm New Password Field -->
    <div class="relative">
        <input type="password" name="new_password_confirmation" placeholder="Confirm New Password" required
            class="w-full border-b border-gray-400 py-2 focus:outline-none focus:border-black transition-colors text-black placeholder-gray-500">
    </div>

    <div class="pt-4">
        <button type="submit" class="w-full bg-red-500 text-white py-4 rounded-sm font-medium hover:bg-red-600 transition duration-300">
            Reset Password
        </button>
    </div>
</form>
        </div>
    </div>
</div>
@endsection
