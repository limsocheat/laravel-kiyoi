<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Member;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemsPerPage = empty(request('itemsPerPage')) ? 5 : (int)request('itemsPerPage');

        $query = Member::with(['deposits', 'user'])
                    ->orderBy('id', 'desc');
        if($request->search) {
            $query->where(function($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            });
        }
        $members  = $query->paginate($itemsPerPage);

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
            'balance' => 'nullable',
        ]);

        $members = new Member();
        $members->user_id = auth()->user()->id;
        $members->name = $request->name;
        $members->company_name = $request->company_name;
        $members->description = $request->description;
        $members->email = $request->email;
        $members->phone = $request->phone;
        $members->post_code = $request->post_code;
        $members->tax = $request->tax;
        $members->address = $request->address;
        $members->balance = $request->balance;
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
        $members = Member::with(['deposits'])->findOrFail($id);

        return response()->json(['members' => $members]);
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
            'address' => 'nullable',
        ]);

        $members = Member::findOrFail($id);
        $members->user_id = auth()->user()->id;
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
        $member = Member::findOrFail($id);
        $member->delete();

        return response()->json(['deleted' => true]);
    }
}
