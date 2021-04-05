<?php

namespace App\Http\Controllers\backend\Auth;

use App\Models\Admin;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    /**
     * Handle Social login request
     *
     * @param $social
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function socialLogin($social)
    {
        $socialite = \App\Models\Socialite::first();

        if (\request()->has('secret_key')) {
            $secret_key = \request()->get('secret_key');
            if ($secret_key == $socialite->app_secret_key) {
                return Socialite::driver($social)->redirect();
            }
        }

        abort(403, 'Sorry !! You are Unauthorized to login as survey admin!');
    }

    /**
     * Obtain the user information from Soci
     * @param $social
     */
    public function handleProviderCallback($social)
    {
        $adminSocial = Socialite::driver($social)->user();

        $admin = Admin::where('provider_id', $adminSocial->getId())
            ->orWhere('email', $adminSocial->getEmail())
            ->first();

        if (!empty($admin)) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard');
        }

        $admin = Admin::create([
            'email' => $adminSocial->getEmail(),
            'name' => $adminSocial->getName(),
            'provider_type' => 1,
            'provider_id' => $adminSocial->getId(),
            'password' => bcrypt(Str::random(5)),
            'email_verified_at' => Carbon::now()
        ]);

        $admin->assignRole('surveyadmin');

        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.dashboard');
    }
}
