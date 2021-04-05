<?php

namespace App\Http\Controllers\frontend\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    public function login(Request $request)
    {
        
        // Validate Login Data
        $request->validate([
            'email' => 'required|max:50',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        //dd($user);
        // Attempt to login
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            //login Now
            $notification = array(
                'message' => 'Login Successfull !!',
                'alert-type' => 'success'
            );
            return redirect()->intended(route('index'))->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Login Successfull !!',
                'alert-type' => 'success'
            );
            return redirect()->route('login')->with($notification);
        }
    }

    /**
     * logout admin guard
     *
     * @return void
     */
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }
}
