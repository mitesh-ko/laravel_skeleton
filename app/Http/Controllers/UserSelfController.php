<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\RecoveryCode;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use BaconQrCode\{Renderer\Color\Rgb,
    Renderer\Image\SvgImageBackEnd,
    Renderer\RendererStyle\Fill,
    Renderer\ImageRenderer,
    Renderer\RendererStyle\RendererStyle,
    Writer
};
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

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
        $validData = $request->validated();
        if ($request->profile) {
            if (Auth::user()->profile)
                $request->profile->storeAs('public', Auth::user()->getRawOriginal('profile'));
            else
                $validData['profile'] = Storage::disk('public')->put('user_profile', $request->profile);
        }

        $request->user()->fill($validData);

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

    public function _2fa(Request $request)
    {
        $request->validate([
            '2fa_password' => ['required_without:code', 'current-password'],
            'code'         => ['required_without:2fa_password', 'numeric'],
        ]);
        $provider = app(TwoFactorAuthentication::class);

        if (!$request->code) {
            $secret = $provider->generateSecretKey();
            Session::put('2fa_secret', $secret);
//            $recovery_codes = $provider->generateRecoveryCodes();
//            RecoveryCode::create([
//                'user_id' => Auth::id(),
//                'code'    => Crypt::encryptString(json_encode($recovery_codes))
//            ]);
            $strAuthUrl = $provider->qrCodeUrl(
                config('app.name'),
                Auth::user()->email,
                $secret
            );

            $svg = (new Writer(
                new ImageRenderer(
                    new RendererStyle(192, 0, null, null, Fill::uniformColor(new Rgb(255, 255, 255), new Rgb(45, 55, 72))),
                    new SvgImageBackEnd
                )
            ))->writeString($strAuthUrl);
            return trim(substr($svg, strpos($svg, "\n") + 1));
        }
        if ($provider->verify(Session::get('2fa_secret'), $request->code)) {
            Auth::user()->update([
                'twofa_key' => encrypt(Session::get('2fa_secret'))
            ]);
            Session::put("2fa_checked", true);
            Session::forget('2fa_secret');
            return response()->json([
                'success'  => true,
                'verified' => true,
                'data'     => [
                    'url' => route('profile')
                ]
            ]);
        }
    }

    public function verify2fa(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('auth.verify2fa');
        }
        $request->validate([
            'code' => ['required', 'numeric'],
        ]);
        $provider = app(TwoFactorAuthentication::class);
        if ($provider->verify(decrypt(Auth::user()->twofa_key), $request->code)) {
            Session::put("2fa_checked", true);
            return redirect('/');
        }
        return redirect()->back()->with('message', 'Entered code is not valid!');
    }
}
