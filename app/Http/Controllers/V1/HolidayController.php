<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Holiday;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemsPerPage = empty(request('itemsPerPage')) ? 5 : (int)request('itemsPerPage');
        $holidays = Holiday::with(['employee.department.user'])
                                    ->orderBy('id', 'desc')
                                    ->paginate($itemsPerPage);
        
        return response()->json(['holidays' => $holidays]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);

        $holidays = new Holiday();
        $holidays->employee_id =  auth()->user()->id;
        $holidays->description = $request->input('description');
        $holidays->from_date = $request->input('from_date');
        $holidays->to_date = $request->input('to_date');
        $holidays->save();

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
        $validateData = $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);

        $holidays = Holiday::findOrFail($id);
        $holidays->employee_id =  auth()->user()->id;
        $holidays->description = $request->input('description');
        $holidays->from_date = $request->input('from_date');
        $holidays->to_date = $request->input('to_date');
        $holidays->save();

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
        $holidays = Holiday::findOrFail($id);
        $holidays->delete();

        return response()->json(['deleted' => true]);
    }
}
