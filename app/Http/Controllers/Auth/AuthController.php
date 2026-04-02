<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        // Handle user registration logic here
        try {
            // Use Validator to validate request input
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:20',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'role' => 'nullable',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Error validating input',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Create user (hash the password!)
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'status' => true,
                'message' => 'Registered successfully',

                'data' => [
                    'user' => $user,
                    'token' => $token,
                    'role' => $user->role,
                ]
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
    public function login(Request $request)
{
    // 1️⃣ Validate input
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => $validator->errors()
        ], 422);
    }

    // 2️⃣ Attempt login
    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid credentials'
        ], 401);
    }

    // 3️⃣ Get authenticated user
    $user = Auth::user();

    // 4️⃣ Create token
    $token = $user->createToken('auth_token')->plainTextToken;

    // 5️⃣ Return response
    return response()->json([
        'status' => true,
        'message' => 'Login successful',
        'data' => [
            'user' => $user,
            'token' => $token,
            'role' => $user->role,
        ]
    ], 200);
}
}
