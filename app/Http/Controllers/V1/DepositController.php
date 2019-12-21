<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DepositAccount;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deposits = DepositAccount::with(['member'])
                    ->get();

        return response()->json(['deposits' => $deposits]);
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
            'description' => 'nullable'
        ]);

        $deposit = new DepositAccount();
        $deposit->member_id = auth()->user()->id;
        $deposit->amount = $request->amount;
        $deposit->description = $request->description;
        $deposit->save();

        $member =  new \App\Member();
        $member->balance = $request->amount;
        $deposit->member()->associate($member);
        
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
        $deposit = DepositAccount::findOrFail($id);

        return response()->json(['deposit' => $deposit]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deposit = DepositAccount::findOrFail($id);
        $deposit->delete();

        return response()->json(['deleted' => true]);
    }
}
