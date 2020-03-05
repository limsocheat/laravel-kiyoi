<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;

use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|between:6, 25',
        ]);

        $referrer_by = App\User::where('referral_code', $request->referrer_by)->get();

        dd($referrer_by);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        // $user->referrer_by = ;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['registered' => true ]);
    }
    
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
