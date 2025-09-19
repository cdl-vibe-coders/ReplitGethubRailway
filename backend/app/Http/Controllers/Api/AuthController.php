<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            // Get default user role
            $userRole = \App\Models\Role::where('name', 'USER')->first();
            
            $user = \App\Models\User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'role_id' => $userRole ? $userRole->id : null,
                'is_active' => true,
            ]);

            // Create user profile
            $user->profile()->create([
                'training_history' => [],
                'attendance_records' => [],
                'file_compliance' => [],
                'color_tags' => [],
                'custom_fields' => [],
                'communication_history' => [],
                'transaction_history' => [],
            ]);

            $token = JWTAuth::fromUser($user);

            return response()->json([
                'message' => 'Registration successful',
                'user' => $user->load(['role', 'profile']),
                'token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => config('jwt.ttl') * 60
            ], 201);

        } catch (\Exception $e) {
            \Log::error('Registration failed', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Registration failed. Please try again.'
            ], 500);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Invalid credentials'
                ], 401);
            }

            $user = auth()->user();
            
            // Check if user is active
            if (!$user->is_active) {
                return response()->json([
                    'message' => 'Your account has been deactivated'
                ], 403);
            }

            // Update last login  
            $user->update(['last_login_at' => now()]);

            return response()->json([
                'message' => 'Login successful',
                'user' => $user->load(['role', 'profile']),
                'token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => config('jwt.ttl') * 60
            ]);

        } catch (\Exception $e) {
            \Log::error('Login failed', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Login failed. Please try again.'
            ], 500);
        }
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            
            return response()->json([
                'message' => 'Logout successful'
            ]);
        } catch (\Exception $e) {
            \Log::error('Logout failed', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Logout failed. Please try again.'
            ], 500);
        }
    }

    public function user()
    {
        return response()->json([
            'user' => auth()->user()->load(['role', 'profile'])
        ]);
    }

    public function refresh()
    {
        try {
            $token = JWTAuth::refresh(JWTAuth::getToken());

            return response()->json([
                'token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => config('jwt.ttl') * 60,
                'user' => auth()->user()->load(['role', 'profile'])
            ]);
        } catch (\Exception $e) {
            \Log::error('Token refresh failed', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Token refresh failed. Please try again.'
            ], 500);
        }
    }
}
