<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PermitController;
use App\Http\Controllers\Api\RoleController;

use function PHPSTORM_META\registerArgumentsSet;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', [RegisterController::class, 'register']);
Route::get('login', function () {
    return view('auth.login');
});
Route::post('login', [LoginController::class, 'login'])->name('login');


Route::group(['middleware' => 'authLogin'], function () {
    // Logout
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    //User
    Route::get('listUser', [UserController::class, 'index'])->name('listUser');
    Route::get('showUser/{id}', [UserController::class, 'show'])->name('showUser');
    Route::post('editUser/{id}', [UserController::class, 'edit'])->name('editUser');
    Route::get('deleteListUser/{id}', [UserController::class, 'destroy'])->name('deleteUser');
    Route::get('addUser', function () {
        return view('listUser.addUser');
    });
    Route::post('addUser', [UserController::class, 'store'])->name('addUserPost');
    Route::get('changeItemPerPage/{number}', [UserController::class, 'changeItemPerPage'])->whereNumber('number');
    //Permit
    Route::get('listPermit', [PermitController::class, 'index'])->name('listPermit');
    Route::get('showPermit/{id}', [PermitController::class, 'show'])->name('showPermit');
    Route::post('editPermit/{id}', [PermitController::class, 'edit'])->name('editPermit');
    Route::get('deleteListPermit/{id}', [PermitController::class, 'destroy'])->name('deletePermit');
    Route::get('addPermit', function () {
        return view('listPermit.addPermit');
    });
    Route::post('addPermit', [PermitController::class, 'store'])->name('addPermitPost');
    Route::get('changeItemPerPage/{number}', [PermitController::class, 'changeItemPerPage'])->whereNumber('number');
    // role
    Route::get('listRole', [RoleController::class, 'index'])->name('listRole');
    Route::get('showRole/{id}', [RoleController::class, 'show'])->name('showRole');
    Route::post('editRole/{id}', [RoleController::class, 'edit'])->name('editRole');
    Route::get('deleteListRole/{id}', [RoleController::class, 'destroy'])->name('deleteRole');
    Route::get('addRole', function () {
        return view('listRole.addRole');
    });
    Route::post('addRole', [RoleController::class, 'store'])->name('addRolePost');
    Route::get('changeItemPerPage/{number}', [RoleController::class, 'changeItemPerPage'])->whereNumber('number');
});
