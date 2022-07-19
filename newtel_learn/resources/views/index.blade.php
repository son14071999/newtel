<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <script>
        var rootUrl = "{{ URL::to('/') }}/";
    </script>
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.3/angular.min.js"
    integrity="sha512-KZmyTq3PLx9EZl0RHShHQuXtrvdJ+m35tuOiwlcZfs/rE7NZv29ygNA8SFCkMXTnYZQK2OX0Gm2qKGfvWEtRXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="{{ url('/css/bootstrap.min.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-route/1.8.3/angular-route.min.js"
    integrity="sha512-y1qD3hz/IAf8W4+/UMLZ+CN6LIoUGi7srWJ3r1R17Hid8x0yXe+1B5ZelkaL1Mjzedzu0Cg3HBvDG02SAgSzBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ url('/css/all.min.css') }}">
    <script src="{{ url('/js/style.js') }}"></script>

</head>

<body ng-app="app-demo">

    <body id="body-pd">
        <header class="header" id="header" ng-controller="logoutController">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
            <div class="header_info">
                <div>
                    <button ng-click="logout()">Logout</button>
                </div>
            </div>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span
                            class="nav_logo-name">MyApp</span>
                    </a>
                    <div class="nav_list">
                        <a href="/listUser" class="nav_link" ng-class="{'active': menuShow.users}">
                            <i class='bx bx-user nav_icon'></i> <span class="nav_name">Users</span>
                        </a>
                        <a href="/listPermit" class="nav_link" ng-class="{'active' : menuShow.permits}">
                            <i class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Permit</span>
                        </a>
                        <a href="#" class="nav_link" ng-class="{'active' : menuShow.roles}"> <i
                                class='bx bx-bookmark nav_icon'></i> <span class="nav_name">Roles</span>
                        </a>

                    </div>
                </div> <a href="#" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span
                        class="nav_name">SignOut</span> </a>
            </nav>
        </div>
        <!--Container Main start-->
        <div class="height-100 bg-light">
            <script src="{{ url('/js/angularjs/app.js') }}"></script>
            <script src="{{ url('/js/angularjs/handler/handle.js') }}"></script>
            <script src="{{ url('/js/angularjs/factory/logoutFactory.js') }}"></script>
            <script src="{{ url('/js/angularjs/controller/logout.js') }}"></script>
            <div style="margin-top: 120px;">
                @yield('content')
            </div>
        </div>
        <!--Container Main end-->

    </body>
