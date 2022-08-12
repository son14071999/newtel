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
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                        ng-change="fillerAll()" aria-describedby="search-addon" ng-model="data.config.search" />
                    <button type="button" class="btn btn-outline-primary" ng-click="filterNameGmail()">search</button>
                </div>
                <a href="#" ng-click="addIssue()"><button type="button" class="btn btn-success"><i
                            class="fa-solid fa-plus"></i> Add Issue</button></a>
            </div>
        </div>
        <div class="wrapper_filters">
            <span style="width: 150px">
                <span for="status">Trạng thái </span>
                <select name="status" class="form-select" id="status"
                    ng-model="data.status" aria-label="Chọn trạng thái"  ng-change="fillerAll()" style="width: 150px; display: inline;">
                    <option value="">--Chọn trạng thái--</option>
                    <option ng-repeat="status in data.statuses" ng-value="@{{ status.id }}" style="height: 60px">@{{ status.name }}
                    </option>
                </select>
            </span>

            <span style="width: 150px; margin-left: 20px">
                <label for="status">Từ ngày </label>
                <input type="date" name="startTime" id="startTime" ng-model="data.startTime" ng-change="fillerAll()">
            </span>


            <span style="width: 150px; margin-left: 20px">
                <label for="status">Đến ngày </label>
                <input type="date" name="endTime" id="endTime" ng-model="data.endTime" ng-change="fillerAll()">
            </span>

        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Stt</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Người thực hiện</th>
                    <th scope="col">Người giao</th>
                    <th scope="col">Hạn</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="issue in data.issuesDisplay">
                    <th>@{{ issue.id }}</th>
                    <th>@{{ issue.name }}</th>
                    <th>@{{ issue.descripttion }}</th>
                    <th>@{{ issue.executor }}</th>
                    <th>@{{ issue.jobAssignor }}</th>
                    <th>@{{ issue.deadline }}</th>
                    <th>@{{ issue.status }}</th>
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
                            <li ng-repeat="p in data.config.pages" class="page-item"><a class="page-link"
                                    ng-class="{'pageCurrent': data.config.currentPage==p}" href="#"
                                    ng-click="changePage(p)">@{{ p }}</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-4 col-md-4">
                    <input type="number" min="1" max="2000" ng-model="data.config.itemPerPage" id="itemPerPage"
                        ng-change="changeItemPerPage()">
                </div>
            </div>
        </div>
        <form-issue issue-id="data.singleIssue" title="data.title" input-data="data"></form-issue>
    </div>
    <script src="{{ url('/js/angularjs/directive/formIssue.js') }}"></script>
    <script src="{{ url('/js/angularjs/controller/issueController.js') }}"></script>
    <script src="{{ url('/js/angularjs/factory/issueFactory.js') }}"></script>
@endsection
