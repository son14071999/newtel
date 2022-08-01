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
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" ng-model="paramRequest.search" />
                    <button type="button" class="btn btn-outline-primary" >search</button>
                </div>
                    <a href="#" ng-click="addDepartment()"><button type="button" class="btn btn-success"><i
                                class="fa-solid fa-plus"></i> Add Department</button></a>
            </div>
        </div>
        <table class="table">
            <div ng-repeat="department in data.departments" style="display: flex; justify-content: space-between;">
                <span style="padding-left: @{{ department.paddingLeft }}">@{{ department.name }}</span>
                <span>
                    <a href="#" ng-click="deleteRole(department.id)"><i class="fa-solid fa-circle-minus"></i></a>
                    <a href="#" ng-click="editRole(department.id)"><i class="fa-solid fa-pen-to-square"></i></a>
                </span>
            </div>
        </table>
        <div class="footer">
          <div class="row">
              <div class="col-lg-8 col-md-8">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                      <li ng-repeat="p in pages" class="page-item"><a class="page-link" ng-class="{'pageCurrent': currentPage==p}" href="#" ng-click="changePage(p)">@{{p}}</a></li>
                    </ul>
                  </nav>
              </div>
              <div class="col-lg-4 col-md-4">
                <input type="number" min="1" max="2000" ng-model="paramRequest.limit" id="itemPerPage" ng-change="changeItemPerPage()">
              </div>
          </div>
      </div>
      <form-department department-id="data.singleDepartment" title="data.title"></form-department>
    </div>
    <script src="{{ url('/js/angularjs/directive/formDepartment.js') }}"></script>
    <script src="{{ url('/js/angularjs/controller/departmentController.js') }}"></script>
    <script src="{{ url('/js/angularjs/factory/departmentFactory.js') }}"></script>
@endsection
