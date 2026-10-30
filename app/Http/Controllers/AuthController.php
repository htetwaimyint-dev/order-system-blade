<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthService;

class AuthController extends Controller
{
    // Register a new user and log them in.
    public function register(
        RegisterRequest $request,
        AuthService $authService
    ) {
        $user = $authService->register($request->validated());

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('items.index');
    }

    // Authenticate the user and start a secure session.
    public function login(
        LoginRequest $request,
        AuthService $authService
    ) {
        $credentials = $request->validated();

        if ($authService->login($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('items.index'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Log out the user and invalidate the session.
    public function logout(
        Request $request,
        AuthService $authService
    ) {
        $authService->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
