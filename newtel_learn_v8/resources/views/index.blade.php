@extends('base')
@section('menu')
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    </header>
    <div class="l-navbar" id="nav-bar" ng-controller="menuController">
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span
                        class="nav_logo-name">MyApp</span>
                </a>
                <div class="nav_list">
                    <a href="/listUser" class="nav_link" ng-class="{'active': menuActive == 'user'}">
                        <i class='bx bx-user nav_icon'></i> <span class="nav_name">Users</span>
                    </a>
                    <a href="/listRole" class="nav_link" ng-class="{'active': menuActive == 'role'}"> <i
                            class="fa-solid fa-ruler"></i> <span class="nav_name">Roles</span>
                    </a>
                    <a href="/listDepartment" class="nav_link" ng-class="{'active': menuActive == 'department'}"> <i
                            class='bx bx-bookmark nav_icon'></i> <span class="nav_name">Department</span>
                    </a>
                    <a href="/listIssue" class="nav_link" ng-class="{'active': menuActive == 'issue'}"> <i
                            class="fa-solid fa-calendar-check"></i> <span class="nav_name">Issue</span>
                    </a>

                    <a href="/listClient" class="nav_link" ng-class="{'active': menuActive == 'client'}"><i
                            class="fa-solid fa-ghost"></i> <span class="nav_name">Client</span>
                    </a>

                </div>
            </div> <a href="#" class="nav_link" ng-click="logout()"> <i class='bx bx-log-out nav_icon'></i> <span
                    class="nav_name">SignOut</span> </a>
        </nav>
    </div>
@endsection
