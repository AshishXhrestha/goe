@extends('layout/template')

@section('content')
    <div class="container-fluid" data-ng-app="goeApp" data-ng-controller="transactionCtrl" data-ng-init="init()">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Employee<a  href="#" data-toggle="modal" data-target="#myEmployeeModal" class="pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a></div>
                <div class="panel-body">
                    <form data-ng-submit="addTransaction()">
                        {!! Form::token() !!}

                        <div class="form-group">
                            {!! Form::label('employee', 'Employee :') !!}
                            <select data-ng-model = "angEmployee"  data-ng-options="activeEmployee.name for activeEmployee in activeEmployees track by activeEmployee.id"  class = "form-control">
                            </select>

                        </div>

                        <div class="form-group">
                            {!! Form::label('site', 'Site :') !!}
                            <select data-ng-model = "angSite"  data-ng-options="site.name for site in sites track by site.id" class = "form-control">
                            </select>
                            <!--<select ng-model="selectedSite" class = "form-control">
                        <option ng-repeat="site in sites" value="{{site.id}}">{{site.name}}</option>
                    </select>-->
                        </div>

                        <div class="form-group">
                            {!! Form::label('workDate', 'Work Date :') !!}
                            <input type="date" class="form-control" data-ng-model="angWorkDate">
                        </div>

                        <div class="form-group">
                            {!! Form::label('day', 'Day :') !!}
                            {!! Form::text('day','1.0',['class'=>'form-control','data-ng-model'=>'angDay'])!!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('ot', 'Ot :') !!}
                            {!!Form::text('ot','0.0',['class'=>'form-control','data-ng-model'=>'angOt'])!!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('advance', 'Advance :') !!}
                            <div class="input-group">
                                <span class="input-group-addon">Rs.</span>
                            {!! Form::text('advance','0.0',['class'=>'form-control','data-ng-model'=>'angAdvance'])!!}
                                </div>
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Employee</div>
                <div class="panel panel-body">
                    <p data-ng-model="currentYear">{{currentYear}}</p>
                    <table class="table">
                        <thead>
                        <th>Employee</th>
                        <th>Site</th>
                        <th>WorkDate</th>
                        <th>Day</th>
                        <th>Ot</th>
                        <th>Advance</th>
                        <th>Amount</th>
                        </thead>


                        <tbody data-ng-repeat="transaction in transactions | filter:search" >

                        <td>{{transaction.empName}}</td>
                        <td>{{transaction.siteName}}</td>
                        <td>{{transaction.workDate}}</td>
                        <td>{{transaction.day}}</td>
                        <td>{{transaction.ot}}</td>
                        <td>Rs. {{transaction.advance}} <strong>-/</strong></td>
                        <td>Rs. {{transaction.amount}} <strong>-/</strong></td>


                        </tbody>




                    </table>

                </div>

            </div>
        </div>



    </div>

    <script>

        var app = angular.module('goeApp',[]);
        app.controller("transactionCtrl",function($scope,$http){
           $scope.init = function(){
              // alert("hello");
               $http.get('/transaction').success(function(data,header,config,status){
                  $scope.transactions = data.transactions;
                   $scope.activeEmployees = data.activeEmployees;
                   $scope.sites = data.sites;
               });
           }

            //storing the traction
            $scope.addTransaction =function(){
                var transaction = {
                    empId :$scope.angEmployee,
                    siteId :$scope.angSite,
                    workDate : $scope.angWorkDate,
                    day : $scope.angDay,
                    ot : $scope.angOt,
                    advance : $scope.angAdvance,

                };


                $http.post('transaction',transaction).success(function(data){
                    //console.log(data);
                    $scope.transactions.push(transaction);
                   $scope.transactions = data.transactions;
                    $scope.day = "1";
                    $scope.ot = "0";
                    $scope.advance = "0.0";

                });
            };

        });
    </script>
    @endsection