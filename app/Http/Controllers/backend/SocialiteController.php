<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Poll;
use App\Models\Question;
use App\Models\Socialite;


class SocialiteController extends Controller
{
    public $user;
    

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ////Role Base Authentication Permision create
        if (is_null($this->user) || !$this->user->can('app_setting.socialite')) {
            abort(403, 'Sorry !! You are Unauthorized to view socialite !');
        }

        $socialite = Socialite::firstOrCreate([]);

        return view('backend.pages.socialite.index', compact('socialite'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
           'app_secret_key' => 'required|min:10|alpha_num'
        ]);

        // get socialite
        $socialite = Socialite::find($id);
        // check if socialite doesn't exists
        if (empty($socialite)) {
            $notification = array(
                'message' => 'Socialite has not been Updated !!',
                'alert-type' => 'error'
            );
            // flash notification
            return redirect('admin/app-setting/socialite')->with($notification);
        }
        // update socialite
        $socialite = $socialite->update($request->all());
        // check if socialite updated
        if ($socialite) {
            $notification = array(
                'message' => 'Socialite has been Updated !!',
                'alert-type' => 'success'
            );
            return redirect('admin/app-setting/socialite')->with($notification);

        } else {
            $notification = array(
                'message' => 'Socialite has not been Updated !!',
                'alert-type' => 'error'
            );
            // flash notification
            return redirect('admin/app-setting/socialite')->with($notification);
        }
    }
}
