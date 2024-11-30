<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\LoginRequest;
use App\Http\Requests\V1\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Create new token of user with default abilities
        $token = $user->createToken('all-access-token', ['create', 'update', 'delete'])->plainTextToken;

        return $this->success(
            [
                'user' => $user,
                'token' => $token
            ],
            'User registered successfully.',
        );
    }

    /**
     * Login an existing user.
     */
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return [
                'message' => 'Invalid Credentials. Please Login Again',
            ];
        }

        $user = Auth::user();
        $token = $user->createToken('all-access-token', ['create', 'update', 'delete'])->plainTextToken;

        return $this->success(
            [
                'user' => $user,
                'token' => $token
            ],
            'User logged in successfully.'
        );
    }

    /**
     * Logout the authenticated user.
     */
    public function logout()
    {
        Auth::user()->tokens()->delete();

        return $this->success(
            null,
            'User logged out successfully.'
        );
    }

    public function success($data = [], $message)
    {
        $response = [
            'message' => $message,
            'data' => $data,
        ];

        return $response;
    }
}
