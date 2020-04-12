<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\SaleGroup;

class SaleGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sale_group = SaleGroup::get();

        return response()->json(['sale_group' => $sale_group]);
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
            'description' => 'nullable|max:255',
        ]);

        $sale_group = new SaleGroup();
        $sale_group->name = $request->name;
        $sale_group->description = $request->description;
        $sale_group->save();

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
            'description' => 'nullable|max:255',
        ]);

        $sale_group = SaleGroup::find($id);
        $sale_group->name = $request->name;
        $sale_group->description = $request->description;
        $sale_group->save();

        return response()->json(['created' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale_group = SaleGroup::find($id);
        $sale_group->delete();

        return response()->json(['deleted' => true]);
    }
}
