@extends('index')
@section('content')
    <link rel="stylesheet" href="{{ url('/css/listClient.css') }}">
    <div class="container" ng-controller="clientController">
        <div class="row header-wrapper">
            <div class="col-lg-3 col-sm-3 col-md-3">
                <h3>List Client</h3>
            </div>
            <div class="col-lg-9 col-sm-9 col-md-9">
                <div class="input-group" style="margin-right: 20px">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" ng-change="filters()" aria-describedby="search-addon" ng-model="data.search" />
                    <button type="button" class="btn btn-outline-primary" ng-click="filters()">search</button>
                </div>
                    <a href="#" ng-click="addClient()"><button type="button" class="btn btn-success"><i
                                class="fa-solid fa-plus"></i> Add Client</button></a>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Redirect</th>
                    <th scope="col">Client_id</th>
                    <th scope="col">Client_secret</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="client in data.clientsDisplay">
                    <th>@{{ client.name }}</th>
                    <th>@{{ client.redirect }}</th>
                    <th>@{{ client.id }}</th>
                    <th>@{{ client.secret }}</th>
                    <th>
                        <a href="#" ng-click="deleteClient(client.id)"><i class="fa-solid fa-circle-minus"></i></a>
                        <a href="#" ng-click="editClient(client.id)"><i class="fa-solid fa-pen-to-square"></i></a>
                    </th>
                </tr>
            </tbody>
        </table>
        <div class="footer">
          <div class="row">
              <div class="col-lg-8 col-md-8">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                      <li ng-repeat="p in data.pages" class="page-item"><a class="page-link" ng-class="{'pageCurrent': data.currentPage==p}" href="#" ng-click="changePage(p)">@{{p}}</a></li>
                    </ul>
                  </nav>
              </div>
              <div class="col-lg-4 col-md-4">
                <input type="number" min="1" max="2000" ng-model="data.itemPerPage" id="itemPerPage" ng-change="changeItemPerPage()">
              </div>
          </div>
      </div>
      <form-client client-id="data.singleClient" title="data.title" input-data="data"></form-client>
    </div>
    <script src="{{ url('/js/angularjs/directive/formClient.js') }}"></script>
    <script src="{{ url('/js/angularjs/controller/clientController.js') }}"></script>
    <script src="{{ url('/js/angularjs/factory/clientFactory.js') }}"></script>
@endsection
