<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product;

use App\Order;

use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   

        $itemsPerPage = empty(request('itemsPerPage')) ? 5 : (int)request('itemsPerPage');
        $products = Product::with(['brand', 'orders'])
                        ->orderBy('id', 'desc')
                        ->paginate($itemsPerPage);

        return response()->json(['products' => $products]);
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
            'name' => 'required',
            'code' => 'required',
            'type' => 'required',
            'barcode' => 'required',
            'description' => 'nullable',
        ]);

        // dd($request->all());

        if($request->get('image')) {
            $exploded = explode(',', $request->image);
            $decode = base64_decode($exploded[1]);

            if(str_contains($exploded[0], 'jpeg')) {
                $extension = 'jpeg';
            }
            else {
                $extension = 'png';
            }

            $fileName = str_random() . '.' . $extension;
            $path = public_path() . '/' . $fileName;

            file_put_contents($path, $decode);

            $product = Product::create($data + [
                'image' => $fileName,
                'user_id' => auth()->user()->id,
                'order_id' => auth()->user()->id,
                'sale_id' => auth()->user()->id,
                'brand_id' => auth()->user()->id,
            ]);

        }
        else {

            $product = Product::create($data + [
                'user_id' => auth()->user()->id,
                'order_id' => auth()->user()->id,
                'sale_id' => auth()->user()->id,
                'brand_id' => auth()->user()->id,
            ]);
        }

        // dd($product->orders());

        $order = new Order();
        $order->discount = $request->discount; 
        $order->save();

        $product->orders()->attach($order, [
            'unit_price' => $request->get('unit_price', 0),
            'quantity' => $request->get('quantity', 0),
        ]);   

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
        $product = Product::with(['brand'])
                            ->findOrFail($id);

        return response()->json(['product' => $product]);
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
            'name' => 'required',
            'code' => 'required',
            'type' => 'required',
            'barcode' => 'required',
            'unit' => 'required',
            'price' => 'required',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->code = $request->code;
        $product->type = $request->type;
        $product->barcode = $request->barcode;
        $product->unit = $request->unit;
        $product->price = $request->price;
        $product->save();

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
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'deleted' => true,
        ]);
    }
}
