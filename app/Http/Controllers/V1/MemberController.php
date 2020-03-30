<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Member;
use App\Profile;

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

        $query = Member::with(['profile', 'user'])
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
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required|between:6,25'
        ]);


        $member = new Member();
        $member->user_id = auth()->user()->id;
        $member->first_name = $request->first_name;
        $member->last_name = $request->last_name;
        $member->description = $request->description;
        $member->email = $request->email;
        $member->password = bcrypt($request->password);
        $member->save();

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = '/members/' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/members/'), $imageName);
        }

        $profile = new Profile();
        $profile->image = $request->file('image') ? $imageName : null;
        $profile->phone = $request->phone;
        $profile->address = $request->address;
        $profile->city = $request->city;
        $profile->address = $request->address;
        $profile->country = $request->country;
        $profile->save(); 

        $member->profile()->save($profile);

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
        $members = Member::with(['profile'])->findOrFail($id);

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
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'nullable',
        ]);
 
        $member = Member::find($id);
        $member->user_id = auth()->user()->id;
        $member->first_name = $request->first_name;
        $member->last_name = $request->last_name;
        $member->description = $request->description;
        $member->email = $request->email;
        $member->password = bcrypt($request->password);
        $member->save();

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = '/members/' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/members/'), $imageName);
        }

        $profile = Profile::where('member_id', $member->id)->first();
        $profile->image = $request->file('image') ? $imageName : null;
        $profile->phone = $request->phone;
        $profile->address = $request->address;
        $profile->city = $request->city;
        $profile->address = $request->address;
        $profile->country = $request->country;
        $profile->save(); 

        $member->profile()->save($profile);

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
