@extends('layout/template')

@section('content')
    <div class="container-fluid" data-ng-app="goeApp" data-ng-controller="siteCtrl" data-ng-init="init()">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading"> Add Site</div>
                <div class="panel-body">

                    <form data-ng-submit="addSite()">
                        {!!Form::token()!!}
                        <div class="form-group">
                            {!! Form::label('name','Name') !!}
                            {!! Form::text('name',Input::old('name'),['class'=>'form-control','placeholder'=>'Enter Name','data-ng-model'=>'angName']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('owner','Owner') !!}
                            {!! Form::text('owner',Input::old('owner'),['class'=>'form-control','placeholder'=>'Enter Owner','data-ng-model'=>'angOwner']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('location','Location') !!}
                            {!! Form::text('location',Input::old('location'),['class'=>'form-control','placeholder'=>'Enter the location','data-ng-model'=>'angLocation'])!!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('startedDate','Started Date') !!}
                            <input type="date" class="form-control" name="startedDate" data-ng-model="angStartedDate">
                        </div>

                        <div class="form-group">
                            {!! Form::label('finishDate','Started Date') !!}
                            <input type="date" class="form-control" name="finishDate" data-ng-model="angFinishDate">
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


                        <tbody data-ng-repeat="site in sites | filter:search" >

                        <tr>

                            <td>{{site.name}}</td>
                            <td>{{site.owner}}</td>
                            <td> {{site.location}}</td>
                            <td>{{site.startedDate}}</td>
                            <td>{{site.finishDate}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <script>

        var app = angular.module('goeApp',["xeditable"]);
        app.controller('siteCtrl',function($scope,$http) {
            //init function
            $scope.init = function () {
                $http.get('/site').success(function (data, header, config, status) {
                    $scope.sites = data.sites;
                });
            };

            //storing the site
            $scope.addSite = function(){
                var site = {
                    name : $scope.angName,
                    owner : $scope.angOwner,
                    location : $scope.angLocation,
                    startedDate:$scope.angStartedDate,
                    finishDate:$scope.angFinishDate,
                };
                $scope.sites.push(site);
                $scope.angName = "";
                $scope.angOwner = "";
                $scope.angLocation = "";
                $scope.angStartedDate = "";
                $scope.angFinishDate = "";
                $http.post('site',site);
            }



        });
    </script>



@endsection