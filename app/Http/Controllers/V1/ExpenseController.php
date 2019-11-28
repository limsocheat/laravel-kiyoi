<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Expense;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expense = Expense::all();

        return $expense;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'warehouse' => 'required',
            'amount' => 'required',
        ]);

        $expense = new Expense();
        $expense->category = $request->category;
        $expense->warehouse = $request->warehouse;
        $expense->amount = $request->amount;
        $expense->save();

        return response()->json([
            'created' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required',
            'warehouse' => 'required',
            'amount' => 'required',
        ]);

        $expense = Expense::findOrFail($id);
        $expense->category = $request->category;
        $expense->warehouse = $request->warehouse;
        $expense->amount = $request->amount;
        $expense->save();

        return response()->json([
            'updated' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return response()->json([
            'deleted' => true,
        ]);
    }
}
