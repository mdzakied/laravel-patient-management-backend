<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    // Register Admin
    public function registerAdmin(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Validation error
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',  // save role admin
        ]);

        // Generate token
        $token = JWTAuth::fromUser($user);

        // Return response
        return response()->json([
            'message' => 'User registered successfully.',
            'user' => $user,
        ], 201);
    }

    // Register Viewer
    public function registerViewer(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Validation error
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'viewer',  // save role admin
        ]);

        // Generate token
        $token = JWTAuth::fromUser($user);

        // Return response
        return response()->json([
            'message' => 'User registered successfully.',
            'user' => $user,
        ], 201);
    }

    // Logn
    public function login(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Validation error
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Login user
        if (!$token = JWTAuth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid credentials, please try again.',
            ], 401);
        }

        // Get user
        $user = JWTAuth::user();

        // Return response
        return response()->json([
            'message' => 'Login successful.',
            'token' => $token,
            'user' => $user,
        ], 200);
    }

    // Logout
    public function logout(Request $request)
    {
        // Get token
        try {
            $token = JWTAuth::getToken(); 
            if (!$token) {
                return response()->json(['message' => 'A token is required'], 401);
            }

            // Invalidate token
            JWTAuth::invalidate($token);

            return response()->json(['message' => 'User logged out successfully.']);
        } catch (JWTException $e) {
            return response()->json(['message' => 'Failed to logout, please try again later'], 500);
        }
    }
}
