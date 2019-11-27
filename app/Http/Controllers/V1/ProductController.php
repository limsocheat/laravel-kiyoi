<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();

        return $product;
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
            'name' => 'required',
            'code' => 'required',
            'type' => 'required',
            'barcode' => 'required',
            'category' => 'required',
            'unit' => 'required',
            'cost' => 'required',
            'price' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->code = $request->code;
        $product->type = $request->type;
        $product->barcode = $request->barcode;
        $product->category = $request->category;
        $product->unit = $request->unit;
        $product->cost = $request->cost;
        $product->price = $request->price;
        $product->save();

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
            'name' => 'required',
            'code' => 'required',
            'type' => 'required',
            'barcode' => 'required',
            'category' => 'required',
            'unit' => 'required',
            'cost' => 'required',
            'price' => 'required',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->code = $request->code;
        $product->type = $request->type;
        $product->barcode = $request->barcode;
        $product->category = $request->category;
        $product->unit = $request->unit;
        $product->cost = $request->cost;
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
