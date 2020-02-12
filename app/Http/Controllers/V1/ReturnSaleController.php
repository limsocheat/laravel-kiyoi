<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\ReturnSale;
use App\Branch;
use App\Member;
use App\Account;
use App\Product;
use Illuminate\Http\Request;

use App\Exports\ReturnSaleExport;
use Maatwebsite\Excel\Facades\Excel;
class ReturnSaleController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function export()
    {
        return Excel::download(new ReturnSaleExport, 'purchase.xlsx');
    }

    public function index(Request $request)
    {
        $itemsPerPage = empty(request('itemsPerPage')) ? 5 : (int)request('itemsPerPage');
        $search = ReturnSale::with([ 'account','branch','products', 'member'])
                        ->orderBy('id', 'desc')
                        ->where('reference_no', 'like', "%".$request->search."%")
                        ->orWhereHas('branch', function ($query) use ($request){
                            $query->where('branches.address', 'like',"%".$request->search."%");
                        })
                        ->orWhereHas('member', function ($query) use ($request) {
                            $query->where('members.name', 'like', "%".$request->search."%");
                        })
                        ->orWhereHas('account', function($query) use ($request){
                            $query->where('accounts.name', 'like', "%".$request->search."%");
                        });
        $returnsale =  $search->paginate($itemsPerPage);

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
            'reference_no' => 'nullable|max:100',
        ]);

        $count = ReturnSale::whereDay('created_at', date('d'))->count();
        
        $returnsale = new ReturnSale();
       
        $returnsale->product_id = auth()->user()->id;
        $returnsale->branch_id = auth()->user()->id;
        $returnsale->member_id = auth()->user()->id;
        $returnsale->account_id = auth()->user()->id;
        $returnsale->return_des = $request->return_des;
        $returnsale->staff_des  = $request->staff_des;
        $returnsale->reference_no = $request->reference_no;


        $returnsale->member()->associate($request->member['id'])->save();
        $returnsale->account()->associate($request->account['id'])->save();
        $returnsale->branch()->associate($request->location['id'])->save();
        

        if(isset($request->items)) {
            foreach($request->items as $item) {
                $returnsale->products()->attach($item['id'], [
                    'unit_price'    => $item['price'],
                    'quantity'      => $item['quantity'],
                    'discount'      => $item['discount'],
                ]);
            }
        }

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
    $returnsale = ReturnSale::with(['branch' ,'account', 'member', 'products'])->findOrFail($id);

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
            'return_des'   => 'nullable',
            'staff_des'    => 'nullable',
            // 'returnsale'  => 'nullable', 
        ]);

        // dd($request->branch);
        
        $count = ReturnSale::whereDay('created_at', date('d'))->count();


        $returnsale = ReturnSale::findOrFail($id);

        $returnsale->branch_id = auth()->user()->id;
        $returnsale->account_id = auth()->user()->id;
        $returnsale->member_id = auth()->user()->id;
        $returnsale->reference_no = $request->reference_no;
        $returnsale->return_des = $request->return_des;
        $returnsale->staff_des = $request->staff_des;
        $returnsale->save();

        $returnsale->branch()->associate($request->branch['id'])->save();
        $returnsale->member()->associate($request->member['id'])->save();
        $returnsale->account()->associate($request->account['id'])->save();
        
        
        $removePivot = $returnsale->products()->detach();
        
        foreach($request->products as $product) {
            $returnsale->products()->attach($product['id'], [
                'unit_price' => $product['price'],
                'quantity' => $product['quantity'],
                'discount' => $product['discount'],
            ]);
        }

        dd($returnsale->branch);

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
        $returnsale = ReturnSale::findOrFail($id);
        $returnsale->delete();

        return response()->json(['delete' => true]);
    }
}
