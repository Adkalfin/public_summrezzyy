<!-- <?php

// namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
// use App\Models\User;
// use Illuminate\Support\Facades\Log;

// class AuthController extends Controller
// {
//     public function login(Request $request)
//     {
//         $loginData = $request->validate([
//             'email' => 'email|required',
//             'password' => 'required',
//         ]);

//         $user = User::where('email', $loginData['email'])->first();

//         if (!$user) {
//             Log::warning('User not found', ['email' => $loginData['email']]);
//             return response(['message' => 'User not found'], 404);
//         }

//         if (!Hash::check($loginData['password'], $user->password)) {
//             Log ::warning('Invalid password', ['email' => $loginData['email']]);
//             return response(['message' => 'Invalid Password'], 401);
//         }

//         $token = $user->createToken('auth_token')->plainTextToken;

//         Log::info('User logged in successfully', ['user_id' => $user->id, 'email' => $user->email, 'token' => $token]);

//         return response(['user' => $user, 'token' => $token], 200);
//     }

//     public function logout(Request $request)
//     {
//         $request->user()->currentAccessToken()->delete();

//         return response(['message' => 'Logged out'], 200);
//     }
// } 