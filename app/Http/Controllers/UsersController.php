<?php

namespace App\Http\Controllers;

use Hash;
use App\Models\User;
use Silber\Bouncer\Database\Role;
use App\DataTables\UsersDataTable;

class UsersController extends Controller
{
    public function index(UsersDataTable $dt)
    {
        return $dt->render('user.index');
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name');

        return view('user.create', compact('roles'));
    }

    public function store()
    {
        $this->validate(request(), [
            'name'                  => 'required|string',
            'email'                 => 'required|unique:users,email',
            'password'              => 'required|string|min:8',
            'password_confirmation' => 'same:password',
            'role'                  => 'required|exists:roles,name'
        ]);

        $user = User::create([
            'name'     => request()->name,
            'email'    => request()->email,
            'password' => Hash::make(request()->password)
        ]);

        $user->assign(request()->role);

        notify()->flash('User has been created!', 'success');
        return redirect()->action('UsersController@index');
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $user  = User::findOrFail($id);
        $roles = Role::pluck('name', 'name');

        return view('user.edit', compact('user', 'roles'));
    }

    public function settings()
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
    public function update($id)
    {
        $user = User::findOrFail($id) ?? auth()->user();

        $this->validate(request(), [
            'name'                  => 'required|string',
            'current_password'      => 'nullable|hash:' . $user->password,
            'new_password'          => 'nullable|required_with:current_password|min:6',
            'password_confirmation' => 'nullable|required_with:current_password|same:new_password',
            'role'                  => 'nullable|exists:roles,name'
        ]);

        $data = [
            'name' => request()->name
        ];

        if (request()->current_password) {
            $data['password'] = Hash::make(request()->new_password);
        }

        $user->update($data);

        if (request()->role) {
            if (count($user->role) > 0) {
                if ($user->role->name != request()->role) {
                    $user->retract($user->role->name);
                    $user->assign(request()->role);
                }
            }
        }

        notify()->flash('User has been updated!', 'success');
        return redirect()->back();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(User $user)
    {
        $user->delete();

        notify()->flash('User has been deactivated!', 'success');
        return redirect()->action('UsersController@index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        notify()->flash('User has been activated!', 'success');
        return redirect()->action('UsersController@index');
    }
}
