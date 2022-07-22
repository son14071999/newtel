
@extends('base')
@section('content')
<link rel="stylesheet" href="{{ url('/css/login.css') }}">
    <div class="container" ng-controller="loginController">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card border-0 shadow rounded-3 my-5">
            <div class="card-body p-4 p-sm-5">
              <h5 class="card-title text-center mb-5 fw-light fs-5">Sign In</h5>
              <form name="formLogin">
                @csrf
                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" ng-model="user.email" ng-required="true">
                  <label for="floatingInput">Email address</label>
                  {{-- <span ng-show="formLogin.email.$error.required">Email ko đc để trống</span> --}}
                  {{-- <span ng-show="formLogin.email.$error.email">Không phải định dạng email</span> --}}
                </div>
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" ng-model="user.password">
                  <label for="floatingPassword">Password</label>
                  <span></span>
                </div>

                <div class="d-grid">
                  <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit" ng-click="login()">Sign
                    in</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="{{ url('/js/angularjs/controller/login.js') }}"></script>
    <script src="{{ url('/js/angularjs/factory/loginFactory.js') }}"></script>
@endsection
