<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Category;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Category::orderBy('id', 'desc');

        if($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('code', 'like', '%' .$request->search . '%')
                ->orWhere('description', 'like', '%' .$request->search . '%');                
            });
        }
        
        $categories = $query->paginate(30);

        return response()->json(['categories' => $categories]);
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
            'code' => 'nullable',
            'description' => 'nullable|max:255',
            'active' => 'nullable',
        ]);

        $productCategory = new Category();
        $productCategory->name = $request->name;
        $productCategory->code = $request->code;
        $productCategory->description = $request->description;
        $productCategory->save();

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
        $product_category = Category::find($id);

        return reponse()->json(['product_category' => $product_category]);
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
            'code' => 'nullable',
            'description' => 'nullable|max:255',
            'active' => 'nullable',
        ]);

        $productCategory = Category::findOrFail($id);
        $productCategory->name = $request->name;
        $productCategory->code = $request->code;
        $productCategory->description = $request->description;
        $productCategory->save();

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
        $product_category = Category::find($id);

        $product_category->delete();

        return response()->json(['deleted' => true]);
    }
}
