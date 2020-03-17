<?php

namespace App\Http\Controllers\V1\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;

use App\User;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
    	$adminUser = auth()->user()->roles->pluck('name')->toArray();

    	if($adminUser[0] === 'administrator') {
    		return (new AdminDashboardController())->countAllUser();
    	}
    }
}
