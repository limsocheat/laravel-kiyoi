<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemsPerPage = empty(request('itemsPerPage')) ? 5 : (int)request('itemsPerPage');
        $suppliers = Supplier::with(['purchases'])
                            ->orderBy('id', 'desc')
                            ->paginate(5);

        return response()->json(['suppliers' => $suppliers]);
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
            'email' => 'required|email',
            'description' => 'nullable',
            'company_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'vat_number' => 'nullable',
            'post_code' => 'nullable',
            'city' => 'nullable',
            'country' => 'nullable',
        ]);

        $supplier = new Supplier(); 
        $supplier->purchase_id = auth()->user()->id;
        $supplier->name = $request->input('name');
        $supplier->email = $request->input('email');
        $supplier->description = $request->input('description');
        $supplier->company_name = $request->input('company_name');
        $supplier->phone = $request->input('phone');
        $supplier->address = $request->input('address');
        $supplier->vat_number = $request->input('vat_number');
        $supplier->post_code = $request->input('post_code');
        $supplier->city = $request->input('city');
        $supplier->country = $request->input('country');
        $supplier->save();

        return response()->json(['created' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response5
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);

        return response()->json(['supplier' => $supplier]);
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
            'email' => 'required|email',
            'description' => 'nullable',
            'company_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'vat_number' => 'nullable',
            'post_code' => 'nullable',
            'city' => 'nullable',
            'country' => 'nullable',
        ]);

        $supplier = Supplier::findOrFail($id); 
        $supplier->purchase_id = auth()->user()->id;
        $supplier->name = $request->input('name');
        $supplier->email = $request->input('email');
        $supplier->description = $request->input('description');
        $supplier->company_name = $request->input('company_name');
        $supplier->phone = $request->input('phone');
        $supplier->address = $request->input('address');
        $supplier->vat_number = $request->input('vat_number');
        $supplier->post_code = $request->input('post_code');
        $supplier->city = $request->input('city');
        $supplier->country = $request->input('country');
        $supplier->save();

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
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return response()->json(['deleted' => true]);
    }
}
