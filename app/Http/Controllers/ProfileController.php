<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // dd($request->all());
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Ambil data profile
        $profile = $user->profile;

        // Cek dan handle avatar baru
        $avatarPath = $profile->avatar ?? null;

        if ($request->hasFile('avatar')) {
            // Hapus avatar lama kalau ada
            if ($avatarPath && file_exists(public_path($avatarPath))) {
                unlink(public_path($avatarPath));
            }

            // Upload avatar baru
            $avatar = $request->file('avatar');
            $avatarName = time() . '_' . uniqid() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move('user', $avatarName);
            $avatarPath = 'user/' . $avatarName;
        }

        $user->save();

        // Update atau buat profile
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone' => $request->phone,
                'telepon' => $request->telepon,
                'status' => $request->status,
                'jenjang' => $request->education_level === 'lainnya' ? $request->custom_education_level : $request->education_level,
                'avatar' => $avatarPath,
            ],
        );

        if ($user->hasRole('user')) {
            return Redirect::route('home');
        } else {
            return Redirect::route('dashboard');
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
