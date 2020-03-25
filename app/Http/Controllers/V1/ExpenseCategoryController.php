<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\ExpenseCategory;

use App\Exports\ExpensesCategoryExport;
use Maatwebsite\Excel\Facades\Excel;


class ExpenseCategoryController extends Controller
{

    public function export() 
    {
        return Excel::download(new ExpensesCategoryExport, 'expense-category.csv');
    }
    
    public function export_pdf() 
    {
        return Excel::download(new ExpensesCategoryExport, 'expense-category.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $expense = ExpenseCategory::with(['expenses'])->orderBy('id', 'desc')
                    ->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('code', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%')
                    ->get();
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
            'name' => 'required',
        ]);

        $expense = new ExpenseCategory();
        // $expense->expense_id = auth()->user()->id;
        $expense->code = $request->code;
        $expense->name = $request->name;
        $expense->save();

        return response()->json(['created' => true]);
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
            'name' => 'required',
        ]);

        $expense = ExpenseCategory::findOrFail($id);
        $expense->code = $request->code;
        $expense->name = $request->name;
        $expense->save();

        return response()->json(['updated' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = ExpenseCategory::findOrFail($id);
        $expense->delete();

        return response()->json(['deleted' => true]);
    }
}
