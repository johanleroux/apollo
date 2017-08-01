<?php

namespace App\Http\Controllers;

use Hash;
use App\Models\User;

class UsersController extends Controller
{
    /**
    * Show the form for editing the specified resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function edit()
    {
        return view('auth.settings');
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update()
    {
        $this->validate(request(), [
            'name'                  => 'required|string',
            'current_password'      => 'nullable|hash:' . auth()->user()->password,
            'new_password'          => 'nullable|required_with:current_password|min:6',
            'password_confirmation' => 'nullable|required_with:current_password|same:new_password'
        ]);

        auth()->user()->update([
            'name' => request()->name,
        ]);

        if (request()->current_password) {
            auth()->user()->update([
                'password' => Hash::make(request()->new_password)
            ]);
        }

        notify()->flash('User has been updated!', 'success');
        return redirect()->action('UsersController@edit');
    }
}
