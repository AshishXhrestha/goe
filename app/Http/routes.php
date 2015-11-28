<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Blade::setContentTags('{!', '!}');

Route::get('/', function () {
    return view('Dashboard.index');
});


Route::get('/employees', function () {
    return view('Employee.index');
});

Route::get('/sites', function () {
    return view('Site.index');
});

Route::get('/transactions',function(){
   return view('Transaction.index');
});
Route::resource('dashboard','DashboardController');
Route::resource('employee','EmployeeController');
Route::resource('site','SiteController');
Route::resource('transaction','TransactionController');

Route::get('test/{id}',function($id){
     $year = DB::select(DB::raw("select monthname(str_to_date(month(workDate),'%m')) as Months,workDate,
                              (select sum(amount)  from siteemployeerel where monthname(str_to_date(month(workDate),'%m')) = Months and year(workDate) = $id) as Amount
                              from siteemployeerel
                              where year(workDate) = $id
                              group by(months)
                              order by(workDate)"));
    //dd($year);
    return($year);




});

Route::post('test/{id}/update/{status}',function($id,$status){
    if($status == 1)
    {
        $employee = DB::select(DB::raw("update employee set status = 0 where id=$id"));


    }


    else
    {
        $employees = DB::select(DB::raw("update employee set status = 1 where id=$id"));
        //$employees = DB::select(DB::raw("select employee.id,employee.name, employee.status from employee"));
    }
    $employees = DB::select(DB::raw("select employee.id,employee.name, employee.status from employee"));


    return(json_encode($employees));
  //dd('status = '. $status . " " .'id = '. $id);
});
