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


// permit
Route::get('/listPermit', function(){
    return view('permit.list');
});
Route::get('/editPermit', function(){
    return view('permit.editPermit');
});
Route::get('/addPermit', function(){
    return view('permit.addPermit');
});


// role
Route::get('/listRole', function(){
    return view('role.list');
});
Route::get('/editRole', function(){
    return view('role.editRole');
});
Route::get('/addRole', function(){
    return view('role.addRole');
});