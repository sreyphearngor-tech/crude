<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends AuthController
{
    // បង្ហាញទំព័រចុះឈ្មោះ
    public function registerForm()
    {
        return view('auth.register');
    }

public function register(Request $request)
{
    // 1. Validation
    $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);

    // 2. បង្កើត User ថ្មី
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'client', // កំណត់ role ជា client ដោយស្វ័យប្រវត្តិ
    ]);

    // 3. ឱ្យគាត់ Login ភ្លាមៗ
    Auth::login($user);

    // 4. Redirect ទៅទំព័រដើម
    return redirect()->route('home')->with('success', 'ចុះឈ្មោះបានជោគជ័យ!');
}
public function loginForm()
    {
        return view('auth.login'); // ប្រាកដថាអ្នកមាន file resources/views/auth/login.blade.php
    }
    // ដំណើរការ Login
   public function login(Request $request)
{
    // 1. Validation
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8',
    ]);

    // 2. ព្យាយាម Login
    if (Auth::attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();

        $user = Auth::user();

        // 3. បែងចែកផ្លូវតាម Role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard'); // ទៅកាន់ Dashboard របស់ Admin
        }

        // បើជា Client ទៅកាន់ទំព័រដើម ឬទំព័រដែលគាត់ចង់ទៅមុន Login (intended)
        return redirect()->intended(route('home'));
    }

    // បើ Login មិនចូល
    return back()->withErrors([
        'email' => 'អ៊ីមែល ឬលេខសម្ងាត់មិនត្រឹមត្រូវ។',
    ])->onlyInput('email');
}
    // ដំណើរការ Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
public function update(Request $request) {
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    /** @var \App\Models\User $user */
    $user = auth()->user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'The provided password does not match our records.']);
    }

    $user->update([
        'password' => Hash::make($request->new_password)
    ]);

    return back()->with('status', 'Password changed successfully!');
}
public function showChangePasswordForm()
{
    return view('auth.change-password');
}

}
