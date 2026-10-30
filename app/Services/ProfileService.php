<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    // Update the user's profile information.
    public function updateProfile(User $user, array $data): void
    {
        $user->update($data);
    }

    // Change the user's password.
    public function updatePassword(User $user, string $password): void
    {
        $user->update([
            'password' => Hash::make($password),
        ]);
    }
}
