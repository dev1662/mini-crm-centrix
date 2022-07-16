<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Companies::all();
        $employee = Employees::paginate(10);
        return view('employees', compact('company','employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            // 'email' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',


        ]);
        $employee =  new Employees();
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->company = (int)$request->company;
        $employee->email = $request->email;
        $employee->phone = (string)$request->phone;

        $employee->save();
        return redirect()->to('/employees')->with('status', 'Employee Created');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
            // 'email' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',


        ]);
        $employee =   Employees::find($id);
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->company = (int)$request->company;
        $employee->email = $request->email;
        $employee->phone = (string)$request->phone;

        $employee->save();
        return redirect()->to('/employees')->with('status', 'Employee Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $com = Employees::find($id);
        $com->delete();
        return redirect()->to('/employees')->with('status', 'Employees Deleted');
    }
}
