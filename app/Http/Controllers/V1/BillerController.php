<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Biller;

class BillerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $itemsPerPage = empty(request('itemsPerPage')) ? 5 : (int)request('itemsPerPage');

        $query = Biller::orderBy('id', 'desc');

        // Implement Search funtionality
        if($request->search) {
            $query->where(function($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('company_name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
                ->orWhere('city', 'like', '%' . $request->search . '%');
            });
        }

        $billers = $query->paginate($itemsPerPage);

        return response()->json(['billers' => $billers]);
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
            'name' => 'required|min:3',
            'company_name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'nullable',
        ]);

        $biller = new Biller();
        $biller->name = $request->input('name');
        $biller->company_name = $request->input('company_name');
        $biller->email = $request->input('email');
        $biller->description = $request->input('description');
        $biller->phone = $request->input('phone');
        $biller->address = $request->input('address');
        $biller->vat_number = $request->input('vat_number');
        $biller->address = $request->input('address');
        $biller->city = $request->input('city');
        $biller->country = $request->input('country');
        $biller->save();

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
        $biller = Biller::findOrFail($id);

        return response()->json(['biller' => $biller]);
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
            'name' => 'required|min:3',
            'company_name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'nullable',
        ]);

        $biller = Biller::findOrFail($id);
        $biller->name = $request->input('name');
        $biller->company_name = $request->input('company_name');
        $biller->email = $request->input('email');
        $biller->description = $request->input('description');
        $biller->phone = $request->input('phone');
        $biller->address = $request->input('address');
        $biller->vat_number = $request->input('vat_number');
        $biller->address = $request->input('address');
        $biller->city = $request->input('city');
        $biller->country = $request->input('country');
        $biller->save();

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
        $biller = Biller::findOrFail($id);
        $biller->delete();

        return response()->json(['deleted' => true]);
    }
}
