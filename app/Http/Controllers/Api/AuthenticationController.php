<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;

class AuthenticationController extends ApiController
{
    public function authenticate()
    {
        $credentials = request()->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }
}
