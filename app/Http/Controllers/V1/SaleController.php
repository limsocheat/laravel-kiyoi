<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sale;
use App\Branch;
use App\Http\Resources\SaleResource;


use App\User;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   

        $user = auth()->user();

        // dd($user->roles[0]->name);

        $itemsPerPage = empty(request('itemsPerPage')) ? 5 : (int)request('itemsPerPage');

        if($user->roles[0]->name == 'administrator' || $user->roles[0]->name == 'accountant') {
            $query = Sale::with(['member', 'user'])->orderBy('id', 'desc');
            
            if($request->search) {
                $query->where(function($q) use ($request) {
                    $q->where('reference_no', 'like', '%' . $request->search . '%')
                    ->orWhereHas('member', function($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->search . '%');
                    });
                });
            }
            
            $sales = $query->paginate($itemsPerPage);
        }


        else {
            $query = Sale::where('user_id', auth()->user()->id)
                        ->with(['member', 'user'])->orderBy('id', 'desc');
            
            if($request->search) {
                $query->where(function($q) use ($request) {
                    $q->where('reference_no', 'like', '%' . $request->search . '%')
                    ->orWhereHas('member', function($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->search . '%');
                    });
                });
            }
            
            $sales = $query->paginate($itemsPerPage);
        }
    
        
        
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
            // 'payment_status' => 'required',
            'payment_method' => 'required',
            'shipping_cost' => 'nullable|numeric',
            'reference_no' => 'nullable|max:100',
            'paid' => 'required|numeric',
            'items.*.unit_price' => 'required|numeric'
        ]);

        $count = Sale::whereDay('created_at', date('d'))->count();

        $sale = new Sale();
        $sale->user_id = auth()->id();
        $sale->member_id = $request->member['id'];
        $sale->branch_id = $request->location['id'];
        $sale->reference_no = 'AS/'  . str_pad($count + 1, 5, '0', STR_PAD_LEFT);
        // $sale->payment_status = $request->payment_status;
        $sale->payment_method = $request->payment_method;
        $sale->discount = $request->discount;
        $sale->description = $request->description;
        $sale->shipping_cost = $request->shipping_cost;
        $sale->paid = $request->paid;
        $sale->save();

        // For Branch
        if($request->location) {
            $location = $request->location['id'];
            $sale->branch()->associate($location)->save();
        }

        // For Customer(Member)
        if($request->member) {
            $member = $request->member['id'];
            $sale->member()->associate($member)->save();
        }

        if(isset($request->items)) {
            foreach($request->items as $item) {
                $sale->products()->attach($item['id'], [
                    'unit_price' => $item['unit_price'],
                    'quantity' => $item['quantity'],
                    // 'discount' => $item['discount'],
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
        $sales = Sale::with(['products', 'member', 'branch'])->findOrFail($id);
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
            // 'payment_status' => 'required',
            'payment_method' => 'required',
            'shipping_cost' => 'nullable|numeric',
            'reference_no' => 'nullable|max:100',
            'paid' => 'required|numeric',
        ]);
        
        // $count = Sale::whereDay('created_at', date('d'))->count();

        // dd(date('d'), str_pad($count + 1, 5, '0', STR_PAD_LEFT));

        $sale = Sale::findOrFail($id);
        $sale->user_id = auth()->id();
        $sale->member_id = $request->member['id'];
        $sale->branch_id = $request->branch['id'];
        $sale->payment_method = $request->payment_method;
        // $sale->payment_status = $request->payment_status;
        // $sale->reference_no = 'AS/'  . str_pad($count + 1, 4, '0', STR_PAD_LEFT);
        $sale->discount = $request->discount;
        $sale->shipping_cost = $request->shipping_cost;
        $sale->description = $request->description;
        $sale->paid = $request->paid;
        $sale->save();

        $sale->branch()->associate($request->branch['id'])->save();
        $sale->member()->associate($request->member['id'])->save();
        
        
        $removePivot = $sale->products()->detach();


        foreach($request->products as $product) {
            $sale->products()->attach($product['id'], [
                'unit_price' => $product['unit_price'],
                'quantity' => $product['quantity'],
                // 'discount' => $product['discount'],
            ]);
        }

        // dd($sale->products);

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
        $sale = Sale::findOrFail($id);
        $sale->delete();

        return response()->json(['deleted' => true]);
    }
}
