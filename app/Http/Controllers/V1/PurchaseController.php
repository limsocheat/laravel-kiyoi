<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Purchase;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemsPerPage = empty(request('itemsPerPage')) ? 5 : (int)request('itemsPerPage');
        $purchase = Purchase::with(['product', 'order'])
                        ->whereHas('product', function($q) use ($request){
                            $q->where('name', 'like', '%' . $request->search . '%')
                            ->orwhere('code', 'like', '%' . $request->search . '%');
                        })
                        ->orderBy('id', 'desc')
                        ->paginate($itemsPerPage);

        return $purchase;   
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
            'date' => 'required',
            'name' => 'required',
            'supplier' => 'required',
            'total' => 'required',
            'paid' => 'required',
            'purchase_status' => 'required',
            'payment_status' => 'required',
        ]);

        $purchase = new Purchase();
        $purchase->date = $request->date;
        $purchase->name = $request->name;
        $purchase->description = $request->description;
        $purchase->supplier = $request->supplier;
        $purchase->total = $request->total;
        $purchase->paid = $request->paid;
        $purchase->purchase_status = $request->purchase_status;
        $purchase->payment_status = $request->payment_status;
        $purchase->save();

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
            'date' => 'required',
            'name' => 'required',
            'supplier' => 'required',
            'total' => 'required',
            'paid' => 'required',
            'purchase_status' => 'required',
            'payment_status' => 'required',
        ]);

        $purchase = Purchase::findOrFail($id);
        $purchase->date = $request->date;
        $purchase->name = $request->name;
        $purchase->description = $request->description;
        $purchase->supplier = $request->supplier;
        $purchase->total = $request->total;
        $purchase->paid = $request->paid;
        $purchase->purchase_status = $request->purchase_status;
        $purchase->payment_status = $request->payment_status;
        $purchase->save();

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
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();

        return response()->json([
            'deleted' => true,
        ]);
    }
}
