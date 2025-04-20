<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SecureProfileController extends Controller
{
    /**
     * Display the edit profile form.
     */
    public function edit(Request $request): View
    {
        return view('secure.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     * SECURE: This method only updates the authenticated user's profile
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        // Secure approach: Only update the currently authenticated user
        $user = $request->user();
        
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        return Redirect::route('secure.profile.edit')
            ->with('status', 'profile-updated')
            ->with('message', 'Profile updated successfully.');
    }
} 