<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ReturnPurchase;
use App\Branch;
use App\Account;
use App\Product;
use App\Supplier;

use App\Exports\ReturnPurchaseExport;
use Maatwebsite\Excel\Facades\Excel;

class ReturnPurchaseController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function export()
    {
        return Excel::download(new ReturnPurchaseExport, 'purchase.xlsx');
    }

    public function index(Request $request)
    {
        $itemsPerPage = empty(request('itemsPerPage')) ? 5 : (int)request('itemsPerPage');
        $search = ReturnPurchase::with(['branch', 'supplier','account', 'products'])
                        ->orderBy('id', 'desc')
                        ->where('reference_no', 'like', "%".$request->search."%")
                        ->orWhereHas('branch', function ($query) use ($request){
                            $query->where('branches.address', 'like',"%".$request->search."%");
                        })
                        ->orWhereHas('supplier', function ($query) use ($request) {
                            $query->where('suppliers.name', 'like', "%".$request->search."%");
                        })
                        ->orWhereHas('account', function($query) use ($request){
                            $query->where('accounts.name', 'like', "%".$request->search."%");
                        });
        $returnpurchase =  $search->paginate($itemsPerPage);

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
        $returnpurchase->reference_no = $request->reference_no;

        $returnpurchase->supplier()->associate($request->supplier['id'])->save();
        $returnpurchase->account()->associate($request->account['id'])->save();
        $returnpurchase->branch()->associate($request->location['id'])->save();

        if(isset($request->items)) {
            foreach($request->items as $item) {
                $returnpurchase->products()->attach($item['id'], [
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
        
        $returnpurchase = ReturnPurchase::with(['supplier', 'branch', 'products', 'account'])
                                        ->findOrFail($id);

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
            // 'return_purchase'=>'required',
            'return_des' => 'nullable',
            'staff_des' => 'nullable' 
        ]);

        $count = ReturnPurchase::whereDay('created_at', date('d'))->count();

        $returnpurchase = ReturnPurchase::findOrFail($id);

        $returnpurchase->account_id = auth()->user()->id;
        $returnpurchase->branch_id = auth()->user()->id;
        $returnpurchase->supplier_id = auth()->user()->id;
        $returnpurchase->reference_no = $request->reference_no;
        $returnpurchase->return_des = $request->return_des;
        $returnpurchase->staff_des = $request->staff_des;
        $returnpurchase->save();

         // Save Associate Relationship
        $returnpurchase->branch()->associate($request->branch['id'])->save();
        $returnpurchase->supplier()->associate($request->supplier['id'])->save();
        $returnpurchase->account()->associate($request->account['id'])->save();

        $removePivot = $returnpurchase->products()->detach();

        foreach($request->products as $product) {
            $returnpurchase->products()->attach($product['id'], [
                'unit_price' => $product['price'],
                'quantity' => $product['quantity'],
                'discount' => $product['discount'],
            ]);
        }
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
        //
        $returnpurchase = ReturnPurchase::findOrFail($id);
        $returnpurchase->delete();

        return response()->json(['delete' => true]);
    }
}
