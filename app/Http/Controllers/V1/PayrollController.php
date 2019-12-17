<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Payroll;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payrolls = Payroll::with(['employee', 'account'])->get();

        return response()->json(['payrolls' => $payrolls]);
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
            'method' => 'required',
            'employee_name' => 'required',
            'account_name' => 'required',
        ]);

        $payrolls = new Payroll();
        $payrolls->employee_id = auth()->user()->id;
        $payrolls->account_id = auth()->user()->id;
        $payrolls->employee_name = $request->employee_name;
        $payrolls->description = $request->description;
        $payrolls->account_name = $request->account_name;
        $payrolls->amount = $request->amount;
        $payrolls->method = $request->method;
        $payrolls->save();

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
            'amount' => 'required',
            'method' => 'required',
            'employee_name' => 'required',
            'account_name' => 'required',
        ]);

        $payrolls = Payroll::findOrFail($id);
        $payrolls->employee_id = auth()->user()->id;
        $payrolls->account_id = auth()->user()->id;
        $payrolls->employee_name = $request->employee_name;
        $payrolls->description = $request->description;
        $payrolls->account_name = $request->account_name;
        $payrolls->amount = $request->amount;
        $payrolls->method = $request->method;
        $payrolls->save();

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
        $payrolls = Payroll::findOrFail($id);
        $payrolls->delete();

        return response()->json(['deleted' => true]);
    }
}
