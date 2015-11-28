<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //getting current date
        $currentDate = Carbon::now();
        //getting current year
        $currentYear = $currentDate->year;
        //getting current month
        $currentMonth = $currentDate->month;

        //getting the employee transaction according to current month and year
        $transactions = DB::select(DB::raw("select e.name as empName,e.wage, s.name as siteName, t.workDate, t.day ,t.ot,t.advance,t.amount from siteemployeerel as t
                        inner join employee as e on t.empId = e.id
                        inner join site as s on t.siteId = s.id
                        where year(t.workDate) = $currentYear and month(t.workDate) = $currentMonth;"));

        //getting the active employee only
        $activeEmployee = DB::select(DB::raw("select e.name, e.id from employee as e where e.status =1"));

        //selecting the years to populate the year dropdown in the dashboadd
        $years = DB::select(DB::raw("select distinct(year(workDate)) as Year from siteemployeerel"));

        //select the sites
        $sites = DB::select(DB::raw("select site.id,site.name,site.owner,site.location from site "));

        /*$months = DB::select(DB::raw("select distinct(month(workDate)) as MonthID ,
                              monthname(str_to_date(month(workDate),'%m')) as Months
                              from siteemployeerel; "));*/


        //dd($months);

        /*$yearlyExpense = DB::select(DB::raw("select monthname(str_to_date(month(workDate),'%m')) as Months,workDate,
                              (select sum(amount)  from siteemployeerel where monthname(str_to_date(month(workDate),'%m')) = Months and year(workDate)=2015) as Amount
                              from siteemployeerel
                              where year(workDate) = 2015
                              group by(months)
                              order by(workDate)"));*/

        $employees = DB::select(DB::raw("select employee.id,employee.name, employee.status, employee.wage, employee.designation from employee "));
        //dd($employee);




       /* $yearJson = json_encode($years);
        $employeeJson = json_encode($employees);*/




        $data = json_encode(array('employees'=>$employees,'years'=>$years,'sites'=>$sites,'transactions'=>$transactions,'activeEmployees'=>$activeEmployee,'currentYear'=>$currentYear));
        return $data;
        dd($data);

    }

    /**
     *
     * @return \Illuminate\Http\Response
     * Show the form for creating a new resource.
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
