<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\ReturnSale;
use App\Branch;
use App\Member;
use App\Account;
use App\Biller;
use App\Product;
use App\Supplier;
use Illuminate\Http\Request;

class ReturnSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemsPerPage = empty(request('itemsPerPage')) ? 5 : (int)request('itemsPerPage');
        $returnsale = ReturnSale::with(['biller', 'member','branch'])
                        ->orderBy('id', 'desc')
                        ->paginate($itemsPerPage);

        return response()->json(['returnsale' => $returnsale]);
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

        $count = ReturnSale::whereDay('created_at', date('d'))->count();
        
        $returnsale = new ReturnSale();
       
        $returnsale->member_id = auth()->user()->id;
        $returnsale->biller_id = auth()->user()->id;
        $returnsale->product_id = auth()->user()->id;
        $returnsale->branch_id = auth()->user()->id;
        $returnsale->supplier_id = auth()->user()->id;
        $returnsale->account_id = auth()->user()->id;
        $returnsale->return_des = $request->return_des;
        $returnsale->staff_des  = $request->staff_des;
        $returnsale->reference_no =  'pr' . date('Ymd-') . date('His') . str_pad($count + 1, 4, '0', STR_PAD_LEFT);

        $new_returnsale = $returnsale->supplier()->associate($request->supplier['id']);
        $new_returnsale = $returnsale->account()->associate($request->account['id']);
        $new_returnsale = $returnsale->branch()->associate($request->location['id']);
        $new_returnsale->save();

        if(isset($request->items)) {
            foreach($request->items as $item) {
                $returnsale->products()->attach($item['id'], [
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
        $returnsale = ReturnSale::findOrFail($id);

        return response()->json(['returnsale' => $returnsale]);
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
        $request->validate([
            'date'      => 'required',
            'total'     => 'required',
            'supplier'  => 'required',
            'branch'    => 'required',
            'account'   => 'required',
            'member'    => 'required',
            'biller'    => 'required'    
        ]);


        $returnsale = ReturnSale::findOrFail($id);
        $returnsale->date = $request->date;
        $returnsale->biller = $request->biller;
        $returnsale->account = $request->account;
        $returnsale->branch = $request->supplier;
        $returnsale->member = $request->member;
        $returnsale->supplier = $request->supplier;
        $returnsale->save();


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
        $returnsale = ReturnSale::findOrFail($id);
        $returnsale->delete();

        return response()->json(['delete' => true]);
    }
}
