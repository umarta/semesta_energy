<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        $user->assignRole('User');

        return emptyResponse('Success do register');
    }

    public function login(LoginRequest $request)
    {
        $user = User::query()->where('username', $request->username)->first();

        if (!$user) {
            return warningResponse('User not found', 401);
        }

        if (!Hash::check($request->password, $user->password)) {
            return warningResponse('Password Not Match',401);
        }


        if ($user->getRoleNames()->first() != 'User') {
            return warningResponse('Only role user can login',401);
        }

        $user['token'] = $user->createToken('se')->accessToken;

        return writeResponse($user, 'login_success');
    }
}
