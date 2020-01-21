<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ReturnPurchase;
use App\Branch;
use App\Account;
use App\Product;
use App\Supplier;

class ReturnPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemsPerPage = empty(request('itemsPerPage')) ? 5 : (int)request('itemsPerPage');
        $returnpurchase = ReturnPurchase::with(['branch', 'supplier','account'])
                        ->orderBy('id', 'desc')
                        ->paginate($itemsPerPage);

        return response()->json(['returnpurchase' => $returnpurchase]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

            'return_des' => 'nullable',
            'staff_des' => 'nullable',
            'items.*.unit_price' => 'required|numeric',
        ]);

        $count = ReturnPurchase::whereDay('created_at', date('d'))->count();
        
        $returnpurchase = new ReturnPurchase();
       
        $returnpurchase->product_id = auth()->user()->id;
        $returnpurchase->branch_id = auth()->user()->id;
        $returnpurchase->supplier_id = auth()->user()->id;
        $returnpurchase->account_id = auth()->user()->id;
        $returnpurchase->return_des = $request->return_des;
        $returnpurchase->staff_des  = $request->staff_des;
        $returnpurchase->reference_no =  'pr' . date('Ymd-') . date('His') . str_pad($count + 1, 4, '0', STR_PAD_LEFT);

        $new_returnpurchase = $returnpurchase->supplier()->associate($request->supplier['id']);
        $new_returnpurchase = $returnpurchase->account()->associate($request->account['id']);
        $new_returnpurchase = $returnpurchase->branch()->associate($request->location['id']);
        $new_returnpurchase->save();

        if(isset($request->items)) {
            foreach($request->items as $item) {
                $returnpurchase->products()->attach($item['id'], [
                    'unit_price'    => $item['unit_price'],
                    'quantity'      => $item['quantity'],
                    'discount'      => $item['discount'],
                ]);
            }
        }

        return response()->json([
            'create' => true,
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
        $returnpurchase = ReturnPurchase::findOrFail($id);

        return response()->json(['returnpurchase' => $returnpurchase]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $request->validate([
            'date'      => 'required',
            'total'     => 'required',
            'supplier'  => 'required',
            'branch'    => 'required',
            'account'   => 'required',
            'return_purchase'=>'required', 
        ]);


        $returnpurchase = ReturnPurchase::findOrFail($id);
        $returnpurchase->date = $request->date;
        $returnpurchase->account = $request->account;
        $returnpurchase->branch = $request->branch;
        $returnpurchase->supplier = $request->supplier;
        $returnpurchase->save();


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
        //
        $returnpurchase = ReturnPurchase::findOrFail($id);
        $returnpurchase->delete();

        return response()->json(['delete' => true]);
    }
}
