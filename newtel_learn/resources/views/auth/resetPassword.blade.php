@extends('base')
@section('content')
    <link rel="stylesheet" href="{{ url('/css/resetPassword.css') }}">
    <div class="formResetPassword" ng-controller="resetController">
        <form>
            <!-- Email input -->
            @csrf
            <div class="form-outline mb-4">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" class="form-control" name="password" value="" ng-model="data.pw.password"/>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="passwordConfirm">Password confirm</label>
                <input type="password" id="passwordConfirm" class="form-control" name="passwordConfirm" value="" ng-model="data.pw.passwordConfirm" />
            </div>

            <!-- Submit button -->
            <div class="btn-submit">
            
              <button type="button" class="btn btn-primary btn-block mb-4" ng-click="updatePassword()">Change password</button>
            </div>

        </form>
    </div>
    <script src="{{ url('/js/angularjs/factory/resetFactory.js') }}"></script>
    <script src="{{ url('/js/angularjs/controller/resetController.js') }}"></script>
@endsection
