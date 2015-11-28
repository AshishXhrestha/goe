@extends('layout/template')

@section('content')
    <div class="container-fluid" data-ng-app="goeApp" data-ng-controller="dashboardCtrl" data-ng-init="init()">


    <section id = "Expense">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Expense Summary of <b>{{selected.Year}}</b></div>
                        <div class="panel-body">
                            Choose Year:
                            <select data-ng-model = "selected"  data-ng-init="getExpenses(2015)" data-ng-options="year.Year for year in years track by year.Year" data-ng-change="getMonthlyExpenses(selected.Year)">
                            </select>
                            <table class="table">
                                <thead>
                                <th>Months</th>
                                <th>Amount</th>
                                </thead>

                                <tbody data-ng-repeat="yearlyExpense in yearlyExpenses">
                                <td>{{ yearlyExpense.Months }}</td>
                                <td>Rs. {{yearlyExpense.Amount}} -/</td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Employee<a  href="#" data-toggle="modal" data-target="#myEmployeeModal" class="pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a></div>
                        <div class="panel-body">
                            <input type="text" data-ng-model="search" class="form-control" placeholder="Search Employee">
                            <table class="table">
                                <thead>
                                <th>Employee</th>
                                <th>Status</th>
                                </thead>

                                <tbody data-ng-repeat="emp in employees | filter:search" >
                                <td>{{emp.name}}</td>

                                <td data-ng-if="emp.status == 1"> <input type="checkbox" checked data-ng-click = "updateStatus(emp.id,emp.status)"></td>
                                <td data-ng-if="emp.status != 1"> <input type="checkbox" data-ng-click = "updateStatus(emp.id,emp.status)"></td>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Site <a  href="#" data-toggle="modal" data-target="#mySiteModal" class="pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a></div>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                <th>Name</th>
                                <th>Owner</th>
                                <th>Location</th>
                                </thead>

                                <tbody data-ng-repeat="site in sites">
                                <td>{{site.name}}</td>
                                <td>{{site.owner}}</td>
                                <td>{{site.location}}</td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>

        </div>


    </section>



<!-- =========================================section ====================================-->
<section id = "employee">


</section>
<!-- =================================================================== modal for employee add ============================== -->
    <div class="modal fade" id="myEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Employee</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(array('url'=>'employee')) !!}
                    {!!Form::token()!!}
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('name', 'Name :') !!}
                            {!! Form::text('name',Input::old('name'),['class'=>'form-control','placeholder'=>'Enter Name']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('designation','Designation :') !!}
                            {!! Form::text('designation',Input::old('designation'),['class'=>'form-control','placeholder'=>'Enter the designation']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('wage' ,'Wage :')!!}
                            <div class="input-group">
                                <span class="input-group-addon">Rs.</span>
                                {!! Form::text('wage',Input::old('wage'),['class'=>'form-control','placeholder'=>'Enter the wage'])!!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('joinedDate','Joined Date: ') !!}
                            <input type="date" class="form-control">
                        </div>

                        <input type="hidden" name="status" value="1">

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


    <div class="modal fade" id="mySiteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Site</h4>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    </div>


    <script>

        var app = angular.module('goeApp',['xeditable']);
        app.run(function(editableOptions) {
            editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
        });

        app.controller('dashboardCtrl',function($scope,$http){
            //init function
            $scope.init = function(){
                $http.get('/dashboard').success(function(data,header,config,status){
                   // $scope.yearlyExpenses = data.yearlyExpense;
                    $scope.employees = data.employees;
                    $scope.years = data.years;
                    $scope.sites = data.sites;
                    //$scope.transactions = data.transactions;
                    $scope.activeEmployees = data.activeEmployees;
                    $scope.currentYear = data.currentYear;
                    $scope.selected =  $scope.years[0];
                    $scope.selectedEmployee = $scope.employees[0];


                });


            };

            $scope.user = {
                name: 'awesome user'
            };


            $scope.updateStatus = function(id,status){
              //alert(id + status);
                $http.post('/test/'+id+'/update/'+status).success(function(data,header,config,status){
                    $scope.employees = data;
                });

            };

            $scope.getExpenses = function(year){
                //alert(year);
                $http.get('/test/'+year).success(function(data,header,config,status){
                    $scope.yearlyExpenses = data;


                });
            };

            $scope.getMonthlyExpenses = function (year) {
                //alert(year);
                $http.get('/test/'+year).success(function(data,header,config,status){
                    $scope.yearlyExpenses = data;


                });
            };



        })
    </script>

    @endsection