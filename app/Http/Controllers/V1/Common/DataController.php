<?php

namespace App\Http\Controllers\V1\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;

class DataController extends Controller
{
    public function roles()
    {
    	$roles = Role::select('*')->get();

    	return $roles;
    }
}
