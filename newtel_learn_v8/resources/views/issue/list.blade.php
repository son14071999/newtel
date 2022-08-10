@extends('index')
@section('content')
    <link rel="stylesheet" href="{{ url('/css/listIssue.css') }}">
    <div class="container" ng-controller="issueController">
        <div class="row header-wrapper">
            <div class="col-lg-3 col-sm-3 col-md-3">
                <h3>List Issue</h3>
            </div>
            <div class="col-lg-9 col-sm-9 col-md-9">
                <div class="input-group" style="margin-right: 20px">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" ng-change="filterNameGmail()" aria-describedby="search-addon" ng-model="paramRequest.search" />
                    <button type="button" class="btn btn-outline-primary" ng-click="filterNameGmail()">search</button>
                </div>
                    <a href="#" ng-click="addIssue()"><button type="button" class="btn btn-success"><i
                                class="fa-solid fa-plus"></i> Add Issue</button></a>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Stt</th>
                    <th scope="col">Code</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="issue in issues">
                    <th>@{{ issue.id }}</th>
                    <th>@{{ issue.code }}</th>
                    <th>@{{ issue.name }}</th>
                    <th>
                        <a href="#" ng-click="deleteIssue(issue.id)"><i class="fa-solid fa-circle-minus"></i></a>
                        <a href="#" ng-click="editIssue(issue.id)"><i class="fa-solid fa-pen-to-square"></i></a>
                    </th>
                </tr>
            </tbody>
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
      <form-issue issue-id="data.singleIssue" title="data.title"></form-issue>
    </div>
    <script src="{{ url('/js/angularjs/directive/formIssue.js') }}"></script>
    <script src="{{ url('/js/angularjs/controller/issueController.js') }}"></script>
    <script src="{{ url('/js/angularjs/factory/issueFactory.js') }}"></script>
@endsection
