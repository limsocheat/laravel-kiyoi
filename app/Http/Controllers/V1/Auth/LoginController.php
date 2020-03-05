<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;

use Spatie\Permission\Models\Role;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|between:6, 25',
        ]);

        $referred_by = User::where('referral_code', '=', $request->referred_by)->get();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->referral_code = strtoupper(substr(uniqid(), 0, 8));
        $user->referred_by = $referred_by[0]->name;
        $user->password = bcrypt($request->password);
        $user->save();

        $user->assignRole('member');

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('SPA')->accessToken,
        ]);
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
