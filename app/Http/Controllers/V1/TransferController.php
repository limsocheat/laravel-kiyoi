<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Transfer;

use App\Product;



class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemsPerPage = empty(request('itemsPerPage')) ? 5 : (int)request('itemsPerPage');

        $transfer = Transfer::with(['branch', 'products'])
                        ->orderBy('id', 'desc')
                        ->paginate($itemsPerPage);

        return response()->json(['transfer' => $transfer]);
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
            'from_location' => 'required',
            'to_location' => 'required',
            'status' => 'required',
            'description' => 'nullable',
            'shipping_charge' => 'nullable',
        ]);
        dd($request->all());
        $transfer = new Transfer();
        $transfer->branch_id = auth()->user()->id;
        // $transfer->reference_no = $id;
        $transfer->from_location = $request->input('from_location');
        $transfer->to_location = $request->input('to_location');
        $transfer->status = $request->input('status');
        $transfer->shipping_charge = $request->input('shipping_charge');
        $transfer->save();

        $product_id = $request->name['id'];
        
        $transfer->products()->attach($product_id, [
            'unit_price' => $request->name['price'],
            'quantity' => $request->name['unit'],
        ]);
   

        dd($transfer->products);

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
        $transfer = Transfer::findOrFail($id);
        $transfer->delete();

        return response()->json(['deleted' => true]);
    }
}
