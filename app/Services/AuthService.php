<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    // Register a new user.
    public function register(array $data): User
    {
        return User::create($data);
    }

    // Authenticate user credentials.
    public function login(array $credentials): bool
    {
        return Auth::attempt($credentials);
    }

    // Log out the current user.
    public function logout(): void
    {
        Auth::logout();
    }
}
