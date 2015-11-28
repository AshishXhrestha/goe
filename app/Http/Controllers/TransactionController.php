<?php

namespace App\Http\Controllers;

use App\Employee;
use App\SiteEmployeeRel;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class TransactionController extends Controller
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

        //getting the active employee only to populate the dropdown list
        $activeEmployee = DB::select(DB::raw("select e.name, e.id from employee as e where e.status =1"));

        //selecting the sites to populate the dropdown list
        $sites = DB::select(DB::raw("select site.id,site.name,site.owner,site.location from site "));

        $data = json_encode(array('transactions'=>$transactions,'activeEmployees'=>$activeEmployee,'sites'=>$sites));
        return $data;
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
        $transaction = $request->all();

        $empId = $transaction["empId"]['id'];
        $siteId=  $transaction["siteId"]['id'];
        $workDate =  $transaction["workDate"];
        $day = (double)($transaction["day"]);
        $ot = (double) ($transaction["ot"]);
        $advance =  (double)($transaction["advance"]);

        //$wage = DB::select(DB::raw("select employee.wage from employee where employee.id=$empId "));
        $wage = Employee::where('id',$empId)->first()->wage;

        //dd($wage);
        $amount = (double)((($day + $ot/8.0) * $wage));



        $transact = SiteEmployeeRel::create([

            'siteId'=>$siteId,
            'empId'=>$empId,
            'workDate'=>$workDate,
            'day'=>$day,
            'ot'=>$ot,
            'advance'=>$advance,
            'amount'=>$amount,
            'advance'=>$advance
        ]);
        //return $transact;



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
                        where year(t.workDate) = $currentYear and month(t.workDate) = $currentMonth
                        order by t.created_at;"));

        return json_encode(array('transactions'=>$transactions));


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
