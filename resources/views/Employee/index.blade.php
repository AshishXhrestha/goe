@extends('layout/template')

@section('content')
    <div class="container-fluid" data-ng-app="goeApp" data-ng-controller="employeeCtrl" data-ng-init="init()">


        <div class="col-md-3">
            <div class="panel panel-default">
            <div class="panel-heading"> Add Employee</div>
            <div class="panel-body">

                <form data-ng-submit="addEmployee()">
                    {!!Form::token()!!}


                    <div class="form-group">
                        {!! Form::label('name','Name') !!}
                        {!! Form::text('name',Input::old('name'),['class'=>'form-control','placeholder'=>'Enter Name','data-ng-model'=>'angName']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('designation','Designation') !!}
                        {!! Form::text('designation',Input::old('designation'),['class'=>'form-control','placeholder'=>'Enter the designation','data-ng-model'=>'angDesignation']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('wage','Wage') !!}
                        <div class="input-group">
                            <span class="input-group-addon">Rs.</span>
                            {!! Form::text('wage',Input::old('wage'),['class'=>'form-control','placeholder'=>'Enter the wage','data-ng-model'=>'angWage'])!!}
                        </div>


                    </div>

                    <div class="form-group">
                        {!! Form::label('joinedDate','Joined Date') !!}
                        <input type="date" class="form-control" name="joinedDate" data-ng-model="angJoinedDate">

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

                    <table class="table">
                        <thead>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Wage</th>
                            <th>Joined Date</th>
                        </thead>


                        <tbody data-ng-repeat="emp in employees | filter:search" >

                        <tr>

                            <td>{{emp.name}}</td>
                            <td>{{emp.designation}}</td>
                            <td> Rs. {{emp.wage}}</td>
                            <td>{{emp.joinedDate}}</td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>

    </div>
    <script>

        var app = angular.module('goeApp',["xeditable"]);
        app.controller('employeeCtrl',function($scope,$http) {
            //init function
            $scope.init = function () {
                $http.get('/employee').success(function (data, header, config, status) {
                    $scope.employees = data.employees;

                });


            };

            $scope.addEmployee = function(){
                var employee = {
                    name : $scope.angName,
                    status : $scope.angStatus,
                    designation :$scope.angDesignation,
                    wage :$scope.angWage,
                    joinedDate:$scope.angJoinedDate,
                    status:1
                }
                $scope.employees.push(employee);
                $scope.angName = "";
                $scope.angDesignation="";
                $scope.angWage="";
                $http.post("employee",employee);
            }

        });
    </script>



       @endsection