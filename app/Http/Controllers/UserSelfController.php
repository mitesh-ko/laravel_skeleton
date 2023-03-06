<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserSelfController extends Controller
{
	public function profile(Request $request)
	{
		return view('user-self.profile');
	}

	public function account(Request $request)
	{
		return view('user-self.account', ['user' => $request->user()]);
	}

	/**
	 * Update the user's profile information.
	 * @param ProfileUpdateRequest $request
	 * @return RedirectResponse
	 */
	public function update(ProfileUpdateRequest $request): RedirectResponse
	{
		$request->user()->fill($request->validated());

		if ($request->user()->isDirty('email')) {
			$request->user()->email_verified_at = null;
		}

		$request->user()->save();

		return Redirect::route('profile')->with(['toastStatus' => 'success', 'message' => 'User updated successfully.']);
	}

	public function deactivate(Request $request): RedirectResponse
	{
		$request->validate([
			'password' => ['required', 'current-password'],
		]);

		$user = $request->user();

		Auth::logout();

		$user->delete();

		$request->session()->invalidate();
		$request->session()->regenerateToken();

		return Redirect::to('/');
	}

	/**
	 * @param Request $request
	 * @return RedirectResponse
	 */
	public function changePassword(Request $request)
	{
		$request->validate([
			'old_password' => ['required', 'current-password'],
			'password'     => ['required', 'confirmed'],
		]);
		Auth::user()->update([
				'password' => Hash::make($request->password)
			]
		);
		return Redirect::back()->with(['toastStatus' => 'success', 'message' => 'Password updated successfully.']);
	}
}
