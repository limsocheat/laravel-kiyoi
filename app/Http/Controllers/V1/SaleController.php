<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sale;
use App\Http\Resources\SaleResource;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemsPerPage = empty(request('itemsPerPage')) ? 5 : (int)request('itemsPerPage');
        $sales = Sale::with(['member'])
                        ->orderBy('id', 'desc')
                        ->paginate($itemsPerPage);

        // return SaleResource::collection($sales);
        return response()->json(['sales' => $sales]);
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
            'sale_status' => 'required',
            'payment_status' => 'required',
            'total' => 'required',
            'paid' => 'required',
            'due' => 'required',
            'reference_no' => 'nullable|max:100',
        ]);

        $count = Sale::whereDay('created_at', date('d'))->count();

        $sales = new Sale();
        $sales->user_id = auth()->user()->id;
        $sales->customer_id = auth()->user()->id;
        $sales->sale_status = $request->sale_status;
        $sales->reference_no = 'AS/' . now()->year() . str_pad($count + 1, 4, '0', STR_PAD_LEFT);
        $sales->payment_status = $request->payment_status;
        $sales->total = $request->total;
        $sales->paid = $request->paid;
        $sales->due = $request->due;
        $sales->save();

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
        $sales = Sale::with(['products.order', 'member'])->findOrFail($id);
        return response()->json(['sales' => $sales]);   
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
            'sale_status' => 'required',
            'payment_status' => 'required',
            'total' => 'required',
            'paid' => 'required',
            'due' => 'required',
        ]);

        $sales = Sale::findOrFail($id);
        $sales->user_id = auth()->user()->id;
        $sales->customer_id = auth()->user()->id;
        $sales->sale_status = $request->sale_status;
        $sales->payment_status = $request->payment_status;
        $sales->total = $request->total;
        $sales->paid = $request->paid;
        $sales->due = $request->due;
        $sales->save();

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
        $sales = Sale::findOrFail($id);
        $sales->delete();

        return response()->json(['deleted' => true]);
    }
}
