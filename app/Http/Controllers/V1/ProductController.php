<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product;
use App\Order;

use App\Http\Resources\ProductResource;

use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function export_pdf() 
    {
        return Excel::download(new ProductsExport, 'products.pdf');
    }

    public function export() 
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function index(Request $request)
    {   

        $itemsPerPage = empty(request('itemsPerPage')) ? 10 : (int)request('itemsPerPage');
        $products = Product::with(['brand', 'orders', 'category'])
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
            'barcode' => 'required',
            'description' => 'nullable',
            'unit' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
        
        if($request->hasFile('image')) {
            $image = $request->image;
            $imageName = '/products/' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->move(public_path('/products'), $imageName);
        }
        
        $product = new Product();
        $product->user_id = auth()->user()->id;
        $product->image = $request->image ? $imageName : null;
        $product->name = $request->name;
        $product->code = $request->code;
        $product->barcode = $request->barcode;
        $product->description = $request->description;
        $product->unit = $request->unit;
        $product->price = $request->price;
        $product->save();


        // Associate Category
        $category = json_decode($request->category, true);
        $product->category()->associate($category['id'])->save();

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
        $data = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'barcode' => 'required',
            'description' => 'nullable',
            'unit' => 'required|integer',
            'price' => 'required|numeric',
        ]);
            

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = '/products/' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->move(public_path('/products/'), $imageName);
        }

        $product = Product::findOrFail($id);
        $product->user_id = auth()->user()->id;
        $product->image = $request->image ? $imageName : null;
        $product->name = $request->name;
        $product->code = $request->code;
        $product->barcode = $request->barcode;
        $product->description = $request->description;
        $product->unit = $request->unit;
        $product->price = $request->price;
        $product->save();
        
        // Associate Category
        $category = json_decode($request->category, true);
        $product->category()->associate($category['id'])->save();

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
