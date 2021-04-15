<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        ////Role Base Authentication Permision create
        // if (is_null($this->user) || !$this->user->can('admin.view')) {
        //     abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        // }

        $users = User::all();
        return view('backend.pages.users.index', compact('users'));
    }

    public function edit($id)
    {
        ////Role Base Authentication Permision create
        //if (is_null($this->user) || !$this->user->can('admin.edit')) {
            //abort(403, 'Sorry !! You are Unauthorized to Edit any admin !');
        //}

        $users = User::find($id);
        return view('backend.pages.users.edit', compact('users'));
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
        ////Role Base Authentication Permision create
        // if (is_null($this->user) || !$this->user->can('admin.edit')) {
        //     abort(403, 'Sorry !! You are Unauthorized to Edit any admin !');
        // }

        // Create New Admin
        $users = User::find($id);

        // Validation Data
        $request->validate([
            'fname' => 'required|max:50',
            'lname' => 'required|max:50',
            'email' => 'required|max:100|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        //dd(request()->all());
        $users->fname = $request->fname;
        $users->lname = $request->lname;
        $users->email = $request->email;
        if ($request->password) {
            $users->password = Hash::make($request->password);
        }
        $users->save();

        $notification = array(
            'message' => 'User has been updated !!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ////Role Base Authentication Permision create
        // if (is_null($this->user) || !$this->user->can('admin.delete')) {
        //     abort(403, 'Sorry !! You are Unauthorized to Delete any admin !');
        // }

        $user = User::find($id);
        if (!is_null($user)) {
            $user->delete();
        }

        $notification = array(
            'message' => 'User has been deleted !!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
