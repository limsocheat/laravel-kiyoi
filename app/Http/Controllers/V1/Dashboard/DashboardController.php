<?php

namespace App\Http\Controllers\V1\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;

use App\User;

use App\Sale;

use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
    	$adminUser = auth()->user()->roles->pluck('name')->toArray();

    	if($adminUser[0] === 'administrator') {
			return response()->json([
				'countUsers' => (new AdminDashboardController())->countAllUser(),
				'totalSales' => (new AdminDashboardController())->totalSales(),
				'totalExpense' => (new AdminDashboardController())->totalExpense(),
				'totalPurchase' => (new AdminDashboardController())->totalPurchase(),
			]);
		}
	}
	
	public function saleReport()
	{
		$date = Carbon::now()->subDays(30)->startOfDay();

		$getSale = Sale::where('created_at', '>=', $date)->orderBy('id', 'desc')->get();

		return $getSale;
	}
}
