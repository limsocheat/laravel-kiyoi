<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of permissions from current logged user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        return auth()->user()->getAllPermissions()->pluck('name');
    }
}
