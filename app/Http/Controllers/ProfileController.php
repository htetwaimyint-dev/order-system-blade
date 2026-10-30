<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Services\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    // Show the profile page.
    public function edit(): View
    {
        return view('profile.edit', [
            'user' => request()->user(),
        ]);
    }

    // Update name and email.
    public function update(
        UpdateProfileRequest $request,
        ProfileService $profileService
    ): RedirectResponse {
        $profileService->updateProfile(
            $request->user(),
            $request->validated()
        );

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Profile updated successfully!');
    }

    // Change password.
    public function updatePassword(
        UpdateProfileRequest $request,
        ProfileService $profileService
    ): RedirectResponse {
        $profileService->updatePassword(
            $request->user(),
            $request->validated()['password']
        );

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Password changed successfully!');
    }
}
