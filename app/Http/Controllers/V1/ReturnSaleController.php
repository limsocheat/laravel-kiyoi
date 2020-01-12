<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\ReturnSale;
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
            'member'      => 'require',
            'branch'      => 'require',
            'biller'      => 'require',
            'supplier'    => 'require',
            'date'        => 'require',
            'total'       => 'require',
        ]);

        // dd($request->all());

        $returnsale = new ReturnSale();
       
        $returnsale->member_id = auth()->user()->id;
        $returnsale->biller_id  = auth()->user()->id;
        $returnsale->product_id = auth()->user()->id;
        $returnsale->branch_id  = auth()->user()->id;
        $returnsale->supplier_id = auh()->user()->id;

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
        // $request->validate([
        //     'member'      => 'require',
        //     'branch'      => 'require',
        //     'biller'      => 'require',
        //     'date'        => 'require',
        //     'total'       => 'require',
        // ]);


        // $returnsale = ReturnSale::findOrFail($id);
        // $returnsale->billers = auth()->id;
        // $returnsale->members = auth()->id;
        // $returnsale->products= auth()->id;
        // $returnsale->branches= auth()->id;
        // $returnsale->save();


        // return response()->json([
        //     'updated' => true,
        // ]);
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
