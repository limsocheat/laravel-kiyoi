<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;

class AuthController extends Controller
{
    public function me(Request $request)
    {
        $user       = auth()->user();

        return response()->json([
            'user'  => $user,
            'role'  => $user->getRoleNames(),
            'permission'  => $user->getAllPermissions(),
        ]);
    }
}
