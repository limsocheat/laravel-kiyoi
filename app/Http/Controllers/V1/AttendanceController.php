<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attendance;


class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attandances = Attendance::with('employee')
                    ->orderBy('id', 'desc')
                    ->get();

        return $attandances;
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
            'date' => 'required',
            'employee_name' => 'required',
            'checkin' => 'required',
            'checkout' => 'required',
            'status' => 'required',
        ]);

        $attandances = new Attendance();
        $attandances->date = $request->date;
        $attandances->employee_id = auth()->user()->id;
        $attandances->description = $request->description;
        $attandances->employee_name = $request->employee_name;
        $attandances->checkin = date('H:i', strtotime($request->checkin));
        $attandances->checkout = date('H:i', strtotime($request->checkout));
        $attandances->status = $request->status;
        $attandances->save();

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
            'date' => 'required',
            'employee_name' => 'required',
            'checkin' => 'required',
            'checkout' => 'required',
            'status' => 'required',
        ]);

        $attandances = Attendance::findOrFail($id);
        $attandances->date = $request->date;
        $attandances->employee_id = auth()->user()->id;
        $attandances->description = $request->description;
        $attandances->employee_name = $request->employee_name;
        $attandances->checkin = date('H:i', strtotime($request->checkin));
        $attandances->checkout = date('H:i', strtotime($request->checkout));
        $attandances->status = $request->status;
        $attandances->save();

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
        $attandances = Attendance::findOrFail($id);
        $attandances->delete();

        return response()->json(['deleted' => true]);
    }
}
