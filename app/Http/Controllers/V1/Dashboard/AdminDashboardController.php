<?php

namespace App\Http\Controllers\V1\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Sale;
use App\Expense;
use App\Purchase;


class AdminDashboardController extends Controller
{
    public function countAllUser()
    {
    	$cards = User::count();

    	return response()->json(['cards' => $cards]);
    }

    public function totalSales()
    {
        $totalSale = Sale::get()->sum('grand_total');
        
        return response()->json(['totalSale' => $totalSale]);
    }

    public function totalExpense()
    {
        $totalExpense = Expense::get()->sum('amount');
        
        return response()->json(['totalExpense' => $totalExpense]);
    }


    public function totalPurchase()
    {
        $totalPurchases = Purchase::whereHas('products')->get();
        
        foreach($totalPurchases as $purchase) {
            $totalPurchase = $purchase->products()->sum('price');
        }
        
        return response()->json(['totalPurchase' => $totalPurchase]);
    }
}
