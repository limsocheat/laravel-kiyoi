<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{User};

use App\Profile;

use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $items      = User::with(['profile'])->OrderBy('id', 'desc');
        if($request->name) {
            $items->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        if($request->email) {
            $items->where(function($q) use ($request) {
                $q->where('email', 'like', '%' . $request->email . '%');
            });
        }

        $users = $items->paginate(20);

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
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|between:6,25'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->referral_code = strtoupper(substr(uniqid(), 0, 8));
        $user->password = bcrypt($request->password);
        $user->save();

        $user->syncRoles($request->role_ids);

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
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|between:6,25'
        ]);
        
        if($request->get('image')) {
            $image = $request->get('image');
            $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $img = \Image::make($image)->resize(null, 90, function($constraint) {
                $constraint->aspectRatio();
            });

            $img->save(public_path('/image/' . $name));
        }

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->image = $request->image ? $name : null; // $name is name of image
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
         
         // Save Profile Relationship
        $profile = new Profile();
        $profile->phone = $request->phone;   
        $profile->address = $request->address;   
        $profile->city = $request->city;   
        $profile->country = $request->country;   
        $user->profile()->save($profile);

        // Assign Role
        $user->syncRoles($request->role_ids);

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
