<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        $stats = [
            'credentials' => $user->credentials()->count(),
            'verification_requests' => $user->verificationRequest()->count(),
            'verifications' => $user->verifications()->count(),
            'credential_histories' => $user->credentialHistories()->count(),
        ];

        return view('user.profile.edit', compact('user', 'stats'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', Password::min(8)->symbols()->mixedCase()->numbers()],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Password updated successfully.');
    }
}
