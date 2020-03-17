<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{User};


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $user = auth()->user();

        if($user->roles[0]->name == 'administrator') {
            
            $items      = User::OrderBy('id', 'desc');

            if($request->name) {
                $items->where(function($q) use ($request) {
                    $q->where('first_name', 'like', '%' . $request->name . '%')
                    ->orWhere('last_name', 'like', '%' . $request->name . '%');
                });
            }

            if($request->email) {
                $items->where(function($q) use ($request) {
                    $q->where('email', 'like', '%' . $request->email . '%');
                });
            }

            $users = $items->paginate(20);
        }

        else {
            $items      = User::where('id', auth()->user()->id)->OrderBy('id', 'desc');

            if($request->name) {
                $items->where(function($q) use ($request) {
                    $q->where('first_name', 'like', '%' . $request->name . '%')
                    ->orWhere('last_name', 'like', '%' . $request->name . '%');
                });
            }

            if($request->email) {
                $items->where(function($q) use ($request) {
                    $q->where('email', 'like', '%' . $request->email . '%');
                });
            }

            $users = $items->paginate(20);
        }

        return response()->json(['users' => $users]);
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
            'first_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|between:6,25'
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->referral_code = strtoupper(substr(uniqid(), 0, 8));
        $user->password = bcrypt($request->password);

        $user->save();


        if($request->roles_ids) {
            $this->roles()->sync($request->roles_ids);
        }


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
        $user = User::findOrFail($id);

        return response()->json(['user' => $user]);
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|between:6,25',
        ]);

        if($request->get('image')) {
            $image = $request->get('image');
            $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $img = \Image::make($image)->resize(80, 90, function($constraint) {
                $constraint->aspectRatio();
            });

            $img->save(public_path('/image/' . $name));
        }

        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->image = $request->image ? $name : null; // $name is name of image
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;   
        $user->address = $request->address;   
        $user->city = $request->city;   
        $user->country = $request->country;   

        $user->save();
         
        // Assign Role
        $user->roles()->sync(
            $request->role_ids
        );

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
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'deleted' => true,
        ]);
    }
}
