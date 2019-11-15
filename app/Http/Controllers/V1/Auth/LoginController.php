<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function passport(Request $request)
    {
        $cred = $request->only('email', 'password');

        if (auth()->attempt($cred)) {

            auth()->user()->tokens()->delete();
            $token = auth()->user()->createToken('SPA');

            return response()->json([
                'access_token' => $token->accessToken,
            ]);
        }

        return response()->json(['Unauthorized.'], \Illuminate\Http\Response::HTTP_UNAUTHORIZED);
    }
}
