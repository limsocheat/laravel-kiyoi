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

        $itemsPerPage = empty(request('itemsPerPage')) ? 10 : (int)request('itemsPerPage');
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
            'barcode' => 'required',
            'description' => 'nullable',
            'unit' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        // Save Image
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
            $path = public_path() . '/image/' . $fileName;
            
            file_put_contents($path, $decode);

            $img = \Image::make($path)->resize(null, 90, function($constraint) {
                $constraint->aspectRatio();
            });

            $img->save(public_path('/image/' . $fileName));


            $product = new Product();
            $product->image = $fileName;
            $product->user_id = auth()->user()->id;
            $product->brand_id = auth()->user()->id;
            $product->name = $request->name;
            $product->code = $request->code;
            $product->barcode = $request->barcode;
            $product->description = $request->description;
            $product->unit = $request->unit;
            $product->price = $request->price;
            $product->save();

            $product->brand()->associate($request->brand['id'])->save();

            $order = new Order();
            $order->discount = $request->discount; 
            $order->save();

            $product->orders()->attach($order, [
                'unit_price' => $request->get('unit_price', 0),
                'quantity' => $request->get('quantity', 1),
            ]); 

        }
        else {

            $product = new Product();
            $product->user_id = auth()->user()->id;
            $product->brand_id = $request->brand['id'];
            $product->name = $request->name;
            $product->code = $request->code;
            $product->barcode = $request->barcode;
            $product->description = $request->description;
            $product->unit = $request->unit;
            $product->price = $request->price;
            $product->save();

            $product->brand()->associate($request->brand['id'])->save();

            $order = new Order();
            $order->discount = $request->discount; 
            $order->save();

            $product->orders()->attach($order, [
                'unit_price' => $request->get('unit_price', 0),
                'quantity' => $request->get('quantity', 1),
            ]); 
        }
        

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


        // dd($request->get('image'));

        // Save Image
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
            $path = public_path() . '/image/' . $fileName;
            
            file_put_contents($path, $decode);

            $img = \Image::make($path)->resize(null, 90, function($constraint) {
                $constraint->aspectRatio();
            });

            $img->save(public_path('/image/' . $fileName));


            $product = Product::findOrFail($id);
            $product->image = $fileName;
            $product->user_id = auth()->user()->id;
            $product->brand_id = auth()->user()->id;
            $product->name = $request->name;
            $product->code = $request->code;
            $product->barcode = $request->barcode;
            $product->description = $request->description;
            $product->unit = $request->unit;
            $product->price = $request->price;
            $product->save();

            $product->brand()->associate($request->brand['id'])->save();

            $order = new Order();
            $order->discount = $request->discount; 
            $order->save();

            $product->orders()->attach($order, [
                'unit_price' => $request->get('unit_price', 0),
                'quantity' => $request->get('quantity', 1),
            ]); 

        }
        else {

            $product = Product::findOrFail($id);
            $product->user_id = auth()->user()->id;
            $product->brand_id = $request->brand['id'];
            $product->name = $request->name;
            $product->code = $request->code;
            $product->barcode = $request->barcode;
            $product->description = $request->description;
            $product->unit = $request->unit;
            $product->price = $request->price;
            $product->save();

            $product->brand()->associate($request->brand['id'])->save();

            $order = new Order();
            $order->discount = $request->discount; 
            $order->save();

            $product->orders()->attach($order, [
                'unit_price' => $request->get('unit_price', 0),
                'quantity' => $request->get('quantity', 1),
            ]); 
        }

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
