<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        try {//អត់យល់ជួយពន្យល់បន្តិចបានទេកូដនេះគឺជា Controller សម្រាប់ Authentication នៅក្នុង Laravel API។ វាមានមុខងារ ៣ គឺ register, login និង logout។


            $validator = Validator::make($request->all(), [//វាប្រើ Validator ដើម្បី validate ទិន្នន័យដែលបានផ្ញើមកពី client មុនពេលបង្កើត user ថាតើមានការបញ្ចូលត្រឹមត្រូវឬអត់។ វាកំណត់ថា name ត្រូវតែមាន និងមានអក្សរតិចជាង 50, email ត្រូវតែមាន និងមានទ្រង់ទ្រាយ email, password ត្រូវតែមាន និងមានអក្សរតិចជាង 6 និងត្រូវតែបញ្ជាក់ password_confirmation, role ត្រូវតែមាន និងត្រូវតែជា user ឬ admin។
                'name' => 'required|string|max:50',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed', // password_confirmation required
                'role' => 'required|in:user,admin',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation errors',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Create user
            $user = User::create([//បង្កើត user ថ្មីដោយប្រើ Model User និង hash password មុនពេលរក្សាទុកទៅ database។
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),//hash​​ចេញទម្រង់បែបបំលែងទៅជា​string ដែលមានសុវត្ថិភាពសម្រាប់រក្សាទុកនៅក្នុង database។
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
        } catch (Exception $e) {//ប្រសិនបើមានកំហុសណាមួយកើតឡើងក្នុងដំណើរការនេះ វានឹងចាប់យក Exception ហើយផ្ញើត្រឡប់ទៅ client ជាមួយនឹងស្ថានភាព false និងសារ error ដែលបានចាប់យក។
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Login user and create token
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [//អត់យល់ជួយពន្យល់បន្តិចបានទេកូដនេះគឺជា function login ដែលទទួល Request ពី client ហើយវាប្រើ Validator ដើម្បី validate ទិន្នន័យដែលបានផ្ញើមកពី client មុនពេលព្យាយាម login។ វាកំណត់ថា email ត្រូវតែមាន និងមានទ្រង់ទ្រាយ email, password ត្រូវតែមាន និងមានអក្សរតិចជាង 6។
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = Auth::user();
        $token = $user()->createToken('auth_token')->plainTextToken;

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

    /**
     * Logout user (delete tokens)
     */
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully'
        ], 200);
    }
}
