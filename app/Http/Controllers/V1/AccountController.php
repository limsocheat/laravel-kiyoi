<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Account;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $itemsPerPage = empty(request('itemsPerPage')) ? 5 : (int)request('itemsPerPage');
<<<<<<< HEAD
        $account = Account::with('payrolls')->orderBy('id', 'desc')->get();


        // return $account;
        return response()->json(['account' => $account]);
=======
        $account = Account::with('payrolls')->get();


        return $account;
        // return response()->json(['account' => $account]);
>>>>>>> af119676611ad7ae8a5874a995beec90899a8df8
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
            'code' => 'required',
<<<<<<< HEAD
=======
            'debit' => 'required',
>>>>>>> af119676611ad7ae8a5874a995beec90899a8df8
            'balance' => 'required',
        ]);

        $account = new Account();
        $account->user_id = auth()->user()->id;
        $account->code = $request->code;
        $account->name = $request->name;
<<<<<<< HEAD
        // $account->debit = $request->debit;
=======
        $account->debit = $request->debit;
>>>>>>> af119676611ad7ae8a5874a995beec90899a8df8
        $account->description = $request->description;
        $account->balance = $request->balance;
        $account->save();

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
            'code' => 'required',
<<<<<<< HEAD
=======
            'debit' => 'required',
>>>>>>> af119676611ad7ae8a5874a995beec90899a8df8
            'balance' => 'required',
        ]);

        $account = Account::findOrFail($id);
        $account->user_id = auth()->user()->id;
        $account->code = $request->code;
        $account->name = $request->name;
<<<<<<< HEAD
=======
        $account->debit = $request->debit;
>>>>>>> af119676611ad7ae8a5874a995beec90899a8df8
        $account->description = $request->description;
        $account->balance = $request->balance;
        $account->save();

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
        $account = Account::findOrFail($id);
        $account->delete();

        return response()->json(['deleted' => true]);
    }
}
