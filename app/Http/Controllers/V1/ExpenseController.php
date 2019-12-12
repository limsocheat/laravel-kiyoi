<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Expense;
use App\Http\Resources\ExpenseResource;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $itemsPerPage = empty(request('itemsPerPage')) ? 5 : (int)request('itemsPerPage');
        $expense = Expense::orderBy('id', 'desc')
                ->paginate($itemsPerPage);

        return ExpenseResource::collection($expense);
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
            'amount' => 'required',
        ]);

        $expense = new Expense();
        $expense->user_id = auth()->user()->id;
        $expense->expense_category_id = auth()->user()->id;
        $expense->category = $request->category;
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        $expense->expense_for = $request->expense_for;
        $expense->save();

        $expense_category = new \App\ExpenseCategory();
        $expense_category->name = $request->name;
        $expense->expense_category()->associate($expense_category);

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
            'amount' => 'required',
        ]);

        $expense = Expense::findOrFail($id);
        $expense->user_id = auth()->user()->id;
        $expense->category = $request->category;
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        $expense->expense_for = $request->expense_for;
        $expense->save();

        $expense_category = new \App\ExpenseCategory();
        $expense_category->name = $request->name;
        $expense->expense_category()->associate($expense_category);

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
