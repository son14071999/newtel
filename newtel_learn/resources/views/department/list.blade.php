@extends('index')
@section('content')
    <link rel="stylesheet" href="{{ url('/css/listDepartment.css') }}">
    <div class="container" ng-controller="departmentController">
        <div class="row header-wrapper">
            <div class="col-lg-3 col-sm-3 col-md-3">
                <h3>List Department</h3>
            </div>
            <div class="col-lg-9 col-sm-9 col-md-9">
                <div class="input-group" style="margin-right: 20px">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                        aria-describedby="search-addon" ng-model="data.search" ng-change="searchDepartment()" />
                    <button type="button" class="btn btn-outline-primary">search</button>
                </div>
                <a href="#" ng-click="addDepartment()"><button type="button" class="btn btn-success"><i
                            class="fa-solid fa-plus"></i> Add Department</button></a>
            </div>
        </div>
        <span class="table" ng-show="!data.searchShow">
            <div ng-repeat="department in data.departments" class="wrapper-line-department" ng-show="department.show">
                <span style="padding-left: @{{ department.paddingLeft }}">
                    <span ng-show="department.hasChild" ng-click="dropDown(department.id)" class="wrappper-icon">
                        <i class="fa-solid fa-angle-@{{department.iconAction}}"></i>
                    </span>
                    @{{ department.name }}
                </span>
                <span>
                    <a href="#" ng-click="deleteDepartment(department.id)"><i
                            class="fa-solid fa-circle-minus"></i></a>
                    <a href="#" ng-click="editDepartment(department.id)"><i class="fa-solid fa-pen-to-square"></i></a>
                </span>
            </div>
        </span>

        <div ng-show="data.searchShow">
            <div ng-repeat="department in data.departments" class="wrapper-line-department" ng-show="department.show">
                <div>
                    <div> @{{ department.name }}</div>
                    <div> @{{ department.pathName }}</div>
                </div>
                <span>
                    <a href="#" ng-click="deleteDepartment(department.id)"><i
                            class="fa-solid fa-circle-minus"></i></a>
                    <a href="#" ng-click="editDepartment(department.id)"><i class="fa-solid fa-pen-to-square"></i></a>
                </span>
            </div>
        </div>


        <form-department department-id="data.singleDepartment" title="data.title" departments="data.departments"></form-department>
    </div>
    <script src="{{ url('/js/angularjs/directive/formDepartment.js') }}"></script>
    <script src="{{ url('/js/angularjs/controller/departmentController.js') }}"></script>
    <script src="{{ url('/js/angularjs/factory/departmentFactory.js') }}"></script>
@endsection
