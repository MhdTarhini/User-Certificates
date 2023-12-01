<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
        
        $user = Auth::user();
        if($user->is_approved){
            $user->last_login = Carbon::now();
            $user->save();
            return response()->json([
                    'status' => 'success',
                    'user' => $user,
                    'authorisation' => [
                        'token' => $token,
                        'type' => 'bearer',
                    ]
                ]);
        }else{
            return response()->json([
                    'status' => 'Not Approved',
                ]);
        }
    }

    public function register(Request $request, $mode)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'string|min:6',
        'bloodType' => 'required|string|max:255',
        'gender' => 'required|string|max:255',
    ]);

    if ($mode === 'Register') {
        $request->validate([
            'email' => 'unique:users,email',
            'password' => 'required'
        ]);
        $user = new User;
    } elseif ($mode === 'Update') {
        $user = User::find(Auth::user()->id);
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
        }
    }

    $user->name = $request->name;
    $user->email = $request->email;
    if ($request->password) {
        $user->password = Hash::make($request->password);
    }
    $user->blood_type = $request->bloodType;
    $user->gender = $request->gender;

    if ($mode === 'Register') {
        $user->is_approved = 0;
        $user->last_login = null;
        $user->user_type_id = 2;
    }

    $user->save();

    return response()->json([
        'status' => 'success',
        'data' => $user
    ]);
}


    public function logout(){
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }
}
