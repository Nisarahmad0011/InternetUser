<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid credentials',
            ], 401);
        }

        $token = $user->createToken('YourAppName')->plainTextToken;

        
        $user->load('role');

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role->name
            ],
            'message' => 'Login successful',
        ]);
    }

    public function profile()
    {
        $user = auth()->user();

        
        $user->load('role');

        return response()->json([
            'success' => true,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role ? [
                    'id' => $user->role->id,
                    'name' => $user->role->name,
                ] : null,
            ],
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => $user->id === $request->user_id
                ? 'required|email|unique:users,email,' . $user->id
                : 'required|email|unique:users,email',
            'password' => 'nullable|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        if ($user->role?->name !== 'Admin' && $user->id !== $request->user_id) {
            return response()->json([
                'success' => false,
                'error' => 'Unauthorized',
            ], 403);
        }

        $userToUpdate = ($user->role?->name === 'Admin' && $request->user_id != $user->id)
            ? User::find($request->user_id)
            : $user;

        if (!$userToUpdate) {
            return response()->json([
                'success' => false,
                'error' => 'User not found',
            ], 404);
        }

        $userToUpdate->name = $request->name;
        $userToUpdate->email = $request->email;

        if ($request->filled('password')) {
            $userToUpdate->password = Hash::make($request->password);
        }

        $userToUpdate->save();

        
        $userToUpdate->load('role');

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'user' => [
                'id' => $userToUpdate->id,
                'name' => $userToUpdate->name,
                'email' => $userToUpdate->email,
                'role' => $userToUpdate->role ? [
                    'id' => $userToUpdate->role->id,
                    'name' => $userToUpdate->role->name,
                ] : null,
            ],
        ]);
    }

    public function register(Request $request)
    {
        $user = auth()->user();
        if (!$user || $user->role?->name !== 'Admin') {
            return response()->json([
                'success' => false,
                'error' => 'Unauthorized',
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2, 
        ]);

        $token = $newUser->createToken('YourAppName')->plainTextToken;

        $newUser->load('role');

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => [
                'id' => $newUser->id,
                'name' => $newUser->name,
                'email' => $newUser->email,
                'role' => $newUser->role ? [
                    'id' => $newUser->role->id,
                    'name' => $newUser->role->name,
                ] : null,
            ],
            'message' => 'User created successfully',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully.'
        ]);
    }
}
