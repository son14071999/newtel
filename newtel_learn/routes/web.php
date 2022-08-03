<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function(){
    return view('auth.login');
});

// user
Route::get('/listUser', function(){
    return view('listUser.list');
});
Route::get('/editUser', function(){
    return view('listUser.editUser');
});
Route::get('/addUser', function(){
    return view('listUser.addUser');
});


// role
Route::get('/listRole', function(){
    return view('role.list');
});
Route::get('/formRole', function(){
    return view('role.formRole');
});
// department
Route::get('/listDepartment', function(){
    return view('department.list');
});
Route::get('/formDepartment', function(){
    return view('department.formDepartment');
});
// issue
Route::get('/listIssue', function(){
    return view('issue.list');
});
// Route::get('/formDepartment', function(){
//     return view('department.formDepartment');
// });

Route::get('resetPassword', function() {
    return view('auth.resetPassword');
})->name('resetPassword');

