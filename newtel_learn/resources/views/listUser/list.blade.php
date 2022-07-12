@extends('index')
@section('content')
  <script src="{{ url('/js/list.js') }}"></script>
  <link rel="stylesheet" href="{{ url('/css/listUser.css') }}">
    <div class="container" ng-controller="user">
        <div class="row header-wrapper">
            <div class="col-lg-8 col-sm-8 col-md-8">
                <h3>List User</h3>
            </div>
            <div class="col-lg-4 col-sm-4 col-md-4">
                <a href="{{ route('addUser') }}"><button type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i> Add User</button></a>
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
              <th>@{{user.id}}</th>
              <th>@{{user.name}}</th>
              <th>@{{ user.email}}</th>
              <th>
                <a href="#" ng-click="deleteUser(user.id)"><i class="fa-solid fa-circle-minus"></i></a>
                {{-- <a href="{{ route('showUser', ['id' => user->id]) }}"><i class="fa-solid fa-pen-to-square"></i></a> --}}
              </th>
        </tr>
        </tbody>
      </table>
      {{-- <div class="footer">
          <div class="row">
              <div class="col-lg-8 col-md-8">
                {{ $users->links() }}
              </div>
              <div class="col-lg-4 col-md-4">
                <input type="number" min="1" max="2000" value="{{ $itemPerPage ?? 0 }}" id="itemPerPage">
              </div>
          </div>
      </div> --}}
    </div>
    <script src="{{ url('/js/angularjs/user.js') }}"></script>
@endsection