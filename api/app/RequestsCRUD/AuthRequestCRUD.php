<?php

namespace App\RequestsCRUD;

use App\Models\User;
use App\Requests\RegisterRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class AuthRequestCRUD
{
    /**
     * @param RegisterRequest $request
     * @return array
     */
    public function register(RegisterRequest $request): array
    {
        $user = new User();
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->save();

        $token = JWTAuth::fromUser($user);

        return compact('user', 'token');
    }


    public function login()
    {

    }
}