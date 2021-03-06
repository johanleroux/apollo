<?php

namespace App\Http\Controllers;

use Bouncer;
use Illuminate\Validation\Rule;
use Silber\Bouncer\Database\Role;
use Silber\Bouncer\Database\Ability;

class RolesController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $this->authorize('update', Role::class);

        $roles = Role::where('name', '!=', 'admin')->get();
        return view('role.index', compact('roles'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $this->authorize('update', Role::class);

        $abilities = partition(Ability::orderBy('name', 'asc')->get()->toArray(), 4);

        return view('role.create', compact('abilities'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store()
    {
        $this->authorize('update', Role::class);

        $this->validate(request(), [
            'name'    => 'required|string|unique:roles',
            'ability' => 'required'
        ]);

        $role = Role::create([
            'name' => request()->name
        ]);

        foreach (request()->ability as $ability => $val) {
            Bouncer::allow($role->name)->to($ability);
        }

        notify()->flash('Role has been created!', 'success');
        return redirect()->action('RolesController@index');
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $this->authorize('update', Role::class);

        $role = Role::findOrFail($id);
        $roleAbilities = $role->getAbilities();
        $abilities = partition(Ability::orderBy('name', 'asc')->get()->toArray(), 4);

        return view('role.edit', compact('role', 'roleAbilities', 'abilities'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Role $role)
    {
        $this->authorize('update', Role::class);

        $abilities = Ability::select('name')->get();

        if (request()->ability) {
            foreach ($abilities as $ability) {
                if (array_key_exists($ability->name, request()->ability)) {
                    Bouncer::allow($role)->to($ability->name);
                } else {
                    Bouncer::disallow($role)->to($ability->name);
                }
            }
        } else {
            foreach ($abilities as $ability) {
                Bouncer::disallow($role)->to($ability->name);
            }
        }

        notify()->flash('Role has been updated!', 'success');
        return redirect()->back();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Role $role)
    {
        $this->authorize('update', Role::class);

        // Reset Users Roles User DEFAULT
        $role->delete();

        notify()->flash('Role has been deleted!', 'success');
        return redirect()->action('RolesController@index');
    }
}
