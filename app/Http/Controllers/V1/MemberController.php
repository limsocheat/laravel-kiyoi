<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Customer;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemsPerPage = empty(request('itemsPerPage')) ? 5 : (int)request('itemsPerPage');
        $members = Customer::with(['user'])->paginate($itemsPerPage);

        return response()->json(['members' => $members]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $members = new Customer();
        $members->user_id = auth()->user()->id;
        $members->name = $request->name;
        $members->company_name = $request->company_name;
        $members->description = $request->description;
        $members->email = $request->email;
        $members->phone = $request->phone;
        $members->balance = $request->balance;
        $members->post_code = $request->post_code;
        $members->tax = $request->tax;
        $members->address = $request->address;
        $members->city = $request->city;
        $members->country = $request->country;
        $members->save();

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
        $validateData = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $members = Customer::findOrFail($id);
        $members->name = $request->name;
        $members->company_name = $request->company_name;
        $members->description = $request->description;
        $members->email = $request->email;
        $members->phone = $request->phone;
        $members->balance = $request->balance;
        $members->address = $request->address;
        $members->post_code = $request->post_code;
        $members->tax = $request->tax;
        $members->city = $request->city;
        $members->country = $request->country;
        $members->save();

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
        $member = Customer::findOrFail($id);
        $member->delete();

        return response()->json(['deleted' => true]);
    }
}
