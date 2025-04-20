<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class VulnerableProfileController extends Controller
{
    /**
     * Display the edit profile form.
     */
    public function edit(Request $request): View
    {
        return view('vulnerable.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     * VULNERABLE: This method accepts a user_id from the request without verification
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'user_id' => ['required'], // This is the vulnerable part - we accept any user_id
        ]);

        // IDOR vulnerability: Using the user_id from the request without verification
        $user = User::find($validated['user_id']);
        
        if ($user) {
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            return Redirect::route('vulnerable.profile.edit')
                ->with('status', 'profile-updated')
                ->with('message', 'Profile updated successfully.');
        }

        return Redirect::route('vulnerable.profile.edit')
            ->with('error', 'User not found.');
    }
} 