<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employees = DB::select(DB::raw("select employee.id,employee.name, employee.status, employee.wage, employee.designation, employee.joinedDate from employee "));

        $employeeDetails = DB::select(DB::raw("select distinct(r.empId) as eid,
				(select sum(r.day) from siteemployeerel as r where r.empId = eid) as Days,
                (select sum(r.ot) from siteemployeerel as r where r.empId = eid) as Ot,
                (select sum(r.advance) from siteemployeerel as r where r.empId = eid) as Advance,
                (select sum(r.amount) from siteemployeerel as r where r.empId = eid) as Amount,
                e.name , e.wage
                from siteemployeerel as r
        inner join employee as e  on r.empId = e.id
        group by(e.id)"));
        //dd(json_encode($employeeDetails));
        $data = json_encode(array('employees'=>$employeeDetails,'employees'=>$employees));
        return $data;

        //retrun(json_encode($employeeDetails));

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
        //

        $employee = $request->all();
        return Employee::create($employee);
        /*$employees = DB::select(DB::raw("select employee.id,employee.name, employee.status, employee.wage, employee.designation, employee.joinedDate from employee "));
        $data = json_encode(array('employees'=>$employees));
        return $data;*/

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
        //
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
