<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Purchase;
use App\Product;
use App\Supplier;

use App\Http\Resources\PurchaseResource;

use App\Exports\PurchaseExport;
use Maatwebsite\Excel\Facades\Excel;

class PurchaseController extends Controller
{
    public function export()
    {
        return Excel::download(new PurchaseExport, 'purchase.xlsx');
    }

    public function index(Request $request)
    {
        $itemsPerPage = empty(request('itemsPerPage')) ? 5 : (int)request('itemsPerPage');
        $purchase = Purchase::with(['products', 'branch'])
                        ->orderBy('id', 'desc')
                        ->paginate($itemsPerPage);

        return PurchaseResource::collection($purchase);
        // return response()->json(['purchase' => $purchase]);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'purchase_status' => 'required',
            'description' => 'nullable',
            'items.*.unit_price' => 'required|numeric',
            'payment_status' => 'required',
        ]);

        // dd($request->items);

        $count = Purchase::whereDay('created_at', date('d'))->count();

        $purchase = new Purchase();
        $purchase->branch_id = auth()->id();
        $purchase->supplier_id = auth()->id();
        $purchase->reference_no =  'pr' . date('Ymd-') . date('His') . str_pad($count + 1, 4, '0', STR_PAD_LEFT);
        $purchase->purchase_status = $request->purchase_status;
        $purchase->description = $request->description;
        $purchase->payment_status = $request->payment_status;
        $purchase->save();

        // dd($request->location);

        // $supplier = Supplier::findOrFail($request->supplier['id']);
        $new_purchase = $purchase->supplier()->associate($request->supplier['id']);
        $new_purchase = $purchase->branch()->associate($request->location['id']);
        $new_purchase->save();

        dd($purchase->supplier);

        if(isset($request->items)) {
            foreach($request->items as $item) {
                $purchase->products()->attach($item['id'], [
                    'unit_price' => $item['unit_price'],
                    'quantity' => $item['quantity'],
                    'discount' => $item['discount'],
                ]);
            }
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
        $purchase = Purchase::with(['supplier'])
                            ->findOrFail($id);

        return response()->json(['purchase', $purchase]);
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
