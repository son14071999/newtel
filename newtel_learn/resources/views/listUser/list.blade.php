@extends('index')
@section('content')
    <link rel="stylesheet" href="{{ url('/css/listUser.css') }}">
    <div class="container" ng-controller="user">
        <div class="row header-wrapper">
            <div class="col-lg-5 col-sm-5 col-md-5">
                <h3>List User</h3>
            </div>
            <div class="col-lg-7 col-sm-7 col-md-7">
                <div class="input-group" style="margin-right: 20px">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" ng-model="textSearch" />
                    <button type="button" class="btn btn-outline-primary" ng-click="search()">search</button>
                </div>
                    <a href="#" ng-click="addUser()"><button type="button" class="btn btn-success"><i
                                class="fa-solid fa-plus"></i> Add User</button></a>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Stt</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="user in users">
                    <th>@{{ user.id }}</th>
                    <th>@{{ user.name }}</th>
                    <th>@{{ user.email }}</th>
                    <th>
                        <a href="#" ng-click="deleteUser(user.id)"><i class="fa-solid fa-circle-minus"></i></a>
                        <a href="#" ng-click="editUser(user.id)"><i class="fa-solid fa-pen-to-square"></i></a>
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
                <input type="number" min="1" max="2000" ng-model="itemPerPage" id="itemPerPage" ng-change="changeItemPerPage()">
              </div>
          </div>
      </div>



        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="email-name" class="col-form-label">email</label>
                                <input type="text" class="form-control" id="email-name" ng-model="userEdit.email"
                                    value="@{{ userEdit.email }}">
                            </div>
                            <div class="form-group">
                                <label for="name-text" class="col-form-label">name:</label>
                                <input type="text" class="form-control" id="name-text" ng-model="userEdit.name"
                                    value="@{{ userEdit.name }}">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" ng-click="saveEditUser()">Save</button>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="name" class="col-form-label">name</label>
                                <input type="text" class="form-control" id="name" ng-model="userAdd.name"
                                    value="@{{userAdd.name}}">
                            </div>
                            <div class="form-group">
                                <label for="email-name" class="col-form-label">email</label>
                                <input type="text" class="form-control" id="email-name" ng-model="userAdd.email"
                                    value="@{{userAdd.email}}">
                            </div>
                            <div class="form-group">
                                <label for="password-text" class="col-form-label">password:</label>
                                <input type="password" class="form-control" id="name-text" ng-model="userAdd.password"
                                    value="@{{userAdd.password}}">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" ng-click="saveAddUser()">Save</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script src="{{ url('/js/angularjs/user.js') }}"></script>
@endsection
