<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Calendar;

use Carbon\Carbon;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calendars = Calendar::all();
        
        return response()->json(['calendars' => $calendars]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data  = $request->validate([
            'title' => 'required',
            'description' => 'nullable|max:255',
            'start' => 'required',
            'end' => 'required',
            'color' => 'required',
        ]);
        
        // dd($request->all());

        $calendar = new Calendar();
        $calendar->title = $request->title;
        $calendar->description = $request->details;
        $calendar->start = Carbon::create($request->start)->format('Y-m-d');
        $calendar->end = Carbon::create($request->end)->format('Y-m-d');
        $calendar->color = $request->color;
        $calendar->save();

        $user = auth()->user();
        $user->notify((new \App\Notifications\Event($calendar))->delay(Carbon::now()->addMinutes(5)));

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
        $data  = $request->validate([
            'title' => 'required',
            'description' => 'nullable|max:255',
            'start' => 'required',
            'end' => 'required',
            'color' => 'required',
        ]);
        
        // dd($request->all());    

        $calendar = Calendar::findOrFail($id);
        $calendar->title = $request->title;
        $calendar->description = $request->details;
        $calendar->start = Carbon::create($request->start)->format('Y-m-d');
        $calendar->end = Carbon::create($request->end)->format('Y-m-d');
        $calendar->color = $request->color;

        // dd($calendar);

        $calendar->save();

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
        $calendar = Calendar::findOrFail($id);
        $calendar->delete();

        return response()->json(['calendar' => $calendar]);
    }
}
