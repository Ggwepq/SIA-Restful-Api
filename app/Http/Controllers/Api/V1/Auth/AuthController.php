<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\LoginRequest;
use App\Http\Requests\V1\Auth\RegisterRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    /**
     * Register a new user.
     */
    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken('API Token of ' . $user->name, ['watchlist:create', 'watchlist:update', 'watchlist:delete', 'movie:create', 'movie:delete'])->plainTextToken;

            return $this->success(
                [
                    'user' => $user,
                    'token' => $token
                ],
                'User registered successfully.',
                201
            );
        } catch (\Exception $e) {
            return $this->error(
                null,
                'Failed to register user.',
                500
            );
        }
    }

    /**
     * Login an existing user.
     */
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->error(
                null,
                'Invalid credentials.',
                401
            );
        }

        try {
            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;

            return $this->success(
                [
                    'user' => $user,
                    'token' => $token
                ],
                'User logged in successfully.'
            );
        } catch (\Exception $e) {
            return $this->error(
                null,
                'Failed to log in user.',
                500
            );
        }
    }

    /**
     * Logout the authenticated user.
     */
    public function logout()
    {
        try {
            Auth::user()->tokens()->delete();

            return $this->success(
                null,
                'User logged out successfully.'
            );
        } catch (\Exception $e) {
            return $this->error(
                null,
                'Failed to log out user.',
                500
            );
        }
    }
}
