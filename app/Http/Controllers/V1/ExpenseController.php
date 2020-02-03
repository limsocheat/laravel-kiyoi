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
    public function index(Request $request)
    {

        $itemsPerPage = empty(request('itemsPerPage')) ? 5 : (int)request('itemsPerPage');
        $query = Expense::with(['user'])
                        ->orderBy('id', 'desc')
                        ->where('amount', 'like', '%' . $request->search . '%')
                        ->orWhere('reference_no', 'like', '%' . $request->search . '%')
                        ->orWhereHas('expense_category', function($q) use ($request) {
                            $q->where('name', 'like', '%'. $request->search . '%');
                        })
                        ->orWhereHas('user', function($q) use ($request) {
                            $q->where('name', 'like', '%'. $request->search . '%');
                        })
                        ->orWhere('reference_no', 'like', '%' . $request->search . '%');

        $expense = $query->paginate($itemsPerPage);

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
            'amount' => 'required|numeric',
        ]);

       // dd($request->all());

        $count = Expense::whereDay('created_at', date('d'))->count();

        $expense = new Expense();
        $expense->user_id = auth()->user()->id;
        $expense->expense_category_id = $request->expense_category['id'];
        $expense->reference_no = 'EP' . now()->year . '/' . str_pad($count + 1 , 4, '0', STR_PAD_LEFT);
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        $expense->save();

        $expense->expense_category()->associate($request->expense_category['id'])->save();
        $expense->user()->associate($request->user['id'])->save();

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

        // dd($request->all());

        $count = Expense::whereDay('created_at', date('d'))->count();

        $expense = Expense::findOrFail($id);
        $expense->user_id = auth()->user()->id;
        $expense->expense_category_id = $request->expense_category['id'];
        $expense->reference_no = 'EP' . now()->year . '/' . str_pad($count + 1 , 4, '0', STR_PAD_LEFT);
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        $expense->save();

        $expense->expense_category()->associate($request->expense_category['id'])->save();
        $expense->user()->associate($request->user['id'])->save();


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
