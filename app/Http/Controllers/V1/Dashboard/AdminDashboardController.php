<?php

namespace App\Http\Controllers\V1\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Sale;


class AdminDashboardController extends Controller
{
    public function countAllUser()
    {
    	$cards = User::count();

    	return response()->json(['cards' => $cards]);
    }

    public function totalSales()
    {
    	return 'Hello';
    }
}
