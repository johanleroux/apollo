<?php

namespace App\Http\Controllers\Api;

use Hash;
use JWTAuth;
use App\Models\User;

class UsersController extends ApiController
{
    public function update()
    {
        $user = auth()->user();

        $this->validate(request(), [
            'name'                  => 'required|string',
            'current_password'      => 'nullable|hash:' . $user->password,
            'new_password'          => 'nullable|required_with:current_password|min:6',
            'password_confirmation' => 'nullable|required_with:current_password|same:new_password',
        ]);

        $data = [
            'name' => request()->name
        ];

        if (request()->current_password) {
            $data['password'] = Hash::make(request()->new_password);
        }

        $user->update($data);

        foreach ($user->getAbilities() as $ability) {
            $abilities[] = $ability->name;
        }

        return response()->json([
            'data' => [
                'user' => [
                    'name'  => $user->name,
                    'email' => $user->email,
                ],
                'role'      => $user->role->name,
                'abilities' => $abilities
            ],
            'meta' => [
                'token' => JWTAuth::fromUser($user)
            ]
        ]);
    }
}
