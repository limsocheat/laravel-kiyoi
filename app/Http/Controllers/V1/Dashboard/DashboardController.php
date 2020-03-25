<?php

namespace App\Http\Controllers\V1\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;

use App\User;
use App\Sale;
use App\Expense;

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

	public function expenseReport(Request $request)
	{	

		if($request->startDate & $request->endDate || $request->category) {
			// Get Date Range
			$expense = Expense::whereBetween('date', array($request->startDate, $request->endDate))
					// Check if get request category
					->when($request->category, function($q) use ($request) {
						// then query Relationship
						$q->Where(function($q) use ($request) {
							$q->whereHas('expense_category', function($q) use ($request)  {
								$q->where('name', '=', $request->input('category'));
							});
						});
					})->get();
		}

		return response()->json(['expense' => $expense]);
	}
}
