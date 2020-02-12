<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Quotation;
use App\Biller;
use App\Branch;
use App\Member;
use App\Supplier;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemsPerPage = empty(request('itemsPerPage')) ? 5 : (int)request('itemsPerPage');
        $search = Quotation::with([ 'supplier','biller','products', 'member', 'branch'])
                        ->orderBy('id', 'desc')
                        ->where('reference_no', 'like', "%".$request->search."%")
                        ->orWhereHas('branch', function ($query) use ($request){
                            $query->where('branches.address', 'like',"%".$request->search."%");
                        })
                        ->orWhereHas('member', function ($query) use ($request) {
                            $query->where('members.name', 'like', "%".$request->search."%");
                        })
                        ->orWhereHas('biller', function ($query) use ($request) {
                            $query->where('billers.name', 'like', "%".$request->search."%");
                        })
                        ->orWhereHas('supplier', function($query) use ($request){
                            $query->where('suppliers.name', 'like', "%".$request->search."%");
                        });
        $quotation =  $search->paginate($itemsPerPage);

        return response()->json(['quotation' => $quotation]);
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
            'description' => 'nullable',
            'file' => 'nullable',
            'file.*'=> 'mimes:doc,docx,pdf,zip,jpg,png,jpeg',
            'items.*.unit_price' => 'required|numeric',
            'reference_no' => 'nullable|max:100',
            'shipping_cost' => 'nullable|numeric',
            'status'    => 'required',
        ]);
        
        // if($request->hasfile('file')){
        //     foreach($request->file('file') as $file)
        //     {
        //         $name = time().'.'.$file->extension();
        //         $file->move('http://127.0.0.1:3000/product/add_adjustment', $name);
        //         $data() -> $name;
        //     }
        // }
        // $file= new File();
        // $file->file=json_encode($data);
        // $file->save();

        $count = Quotation::whereDay('created_at', date('d'))->count();
        
        $quotation = new Quotation();
       
        $quotation->product_id = auth()->user()->id;
        $quotation->branch_id = auth()->user()->id;
        $quotation->biller_id = auth()->user()->id;
        $quotation->member_id = auth()->user()->id;
        $quotation->supplier_id = auth()->user()->id;
        $quotation->description = $request->description;
        $quotation->file = $request ->file;
        $quotation->shipping_cost = $request->shipping_cost;
        $quotation->reference_no = 'PR'.date('Y'). str_pad($count + 1, 4, '0', STR_PAD_LEFT);
        $quotation->status =$request->status;


        $quotation->member()->associate($request->member['id'])->save();
        $quotation->supplier()->associate($request->supplier['id'])->save();
        $quotation->biller()->associate($request->biller['id'])->save();
        $quotation->branch()->associate($request->location['id'])->save();
        

        if(isset($request->items)) {
            foreach($request->items as $item) {
                $quotation->products()->attach($item['id'], [
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
        $quotation = Quotation::with(['branch' ,'supplier', 'member','biller', 'products'])->findOrFail($id);

        return response()->json(['quotation' => $quotation]);
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
           'description' => 'nullable',
           'file' => 'nullable',
           'status' => 'required',
           'shipping_cost'=> 'nullable|numeric',
           'reference_no'=> 'nullable|numeric',
        //    'biller_id'=>'nullable'
        ]);

        // dd($request->branch);
        
        $count = Quotation::whereDay('created_at', date('d'))->count();


        $quotation = Quotation::findOrFail($id);

        $quotation->branch_id = auth()->user()->id;
        $quotation->member_id = auth()->user()->id;
        $quotation->biller_id = auth()->user()->id;
        $quotation->supplier_id = auth()->user()->id;
        $quotation->reference_no = $quotation->reference_no;
        $quotation->description = $request->description;
        $quotation->shipping_cost = $quotation->shipping_cost;
        $quotation->file = $quotation->file;
        $quotation->status = $request->status;
        $quotation->save();

        $quotation->branch()->associate($request->branch['id'])->save();
        $quotation->member()->associate($request->member['id'])->save();
        $quotation->supplier()->associate($request->supplier['id'])->save();
        $quotation->biller()->associate($request->biller['id'])->save();
        
        
        $removePivot = $quotation->products()->detach();
        
        foreach($request->products as $product) {
            $quotation->products()->attach($product['id'], [
                'unit_price' => $product['unit_price'],
                'quantity' => $product['quantity'],
                'discount' => $product['discount'],
            ]);
        }

        // dd($returnsale->branch);

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
        $quotation = Quotation::findOrFail($id);
        $quotation->delete();

        return response()->json(['delete' => true]);
    }
}
