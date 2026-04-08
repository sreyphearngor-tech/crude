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

            if ($validator->fails()) {// If validation fails, return a JSON response with errors
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
                'password' => Hash::make($request->password),//Hashមានន័យសម្រាប់បង្កើតពាក្យសម្ងាត់ដែលបានបំលែងទៅជាអក្សរដែលមិនអាចអានបាន
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
//បញ្ចូលការផ្ទៀងផ្ទាត់នៃការបញ្ចូលទិន្នន័យពីអ្នកប្រើប្រាស់
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
    if (!Auth::attempt($request->only('email', 'password'))) {//ពន្យល់បន្ទាត់នេះគឺសម្រាប់ពិនិត្យមើលថាតើការបញ្ចូលអ៊ីមែល និងពាក្យសម្ងាត់ត្រឹមត្រូវឬអត់។ ប្រសិនបើមិនត្រឹមត្រូវទេ វានឹងត្រឡប់ទៅនូវការឆ្លើយតប JSON ដែលមានស្ថានភាព false និងសារ "Invalid credentials" ជាមួយនឹងកូដ HTTP 401 (Unauthorized)។
        return response()->json([
            'status' => false,
            'message' => 'Invalid credentials'
        ], 401);
    }

    // 3️⃣ Get authenticated user
    $user = Auth::user();

    // 4️⃣ Create token
    $token = $user()->createToken('auth_token')->plainTextToken;

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
