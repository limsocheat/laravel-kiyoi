<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Employee;
use App\Http\Resources\EmployeeResource;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemsPerPage = empty(request('itemsPerPage')) ? 5 : (int)request('itemsPerPage');
        $employee = Employee::orderBy('id', 'desc')
                    ->paginate($itemsPerPage);

        return EmployeeResource::collection($employee);
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
            'city' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'department' => 'required',
        ]);

        $employee = new Employee();
        $employee->department_id = auth()->user()->id;
        $employee->department = $request->department;
        $employee->description = $request->description;
        $employee->name = $request->name;
        $employee->city = $request->city;
        $employee->phone = $request->phone;
        $employee->gender = $request->gender;
        $employee->address = $request->address;
        $employee->country = $request->country;
        $employee->save();

        $department = new \App\Department();
        $department->name = $request->name;
        $employee->department()->associate($department);

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
            'city' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'department' => 'required',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->department_id = auth()->user()->id;
        $employee->department = $request->department;
        $employee->description = $request->description;
        $employee->name = $request->name;
        $employee->city = $request->city;
        $employee->phone = $request->phone;
        $employee->gender = $request->gender;
        $employee->address = $request->address;
        $employee->country = $request->country;
        $employee->save();

        $department = \App\Department::findOrFail($id);
        $department->name = $request->name;
        $employee->department()->associate($department);

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
        //
    }
}
