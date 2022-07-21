<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PermitController;
use App\Models\Permit;
use App\Models\Role;

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
    Route::get('listUser', [UserController::class, 'index'])->name('listUser')->middleware('checkPermit:viewListUser');
    Route::get('showUser/{id}', [UserController::class, 'show'])->name('showUser')->middleware('checkPermit:viewUser');
    Route::post('editUser/{id}', [UserController::class, 'edit'])->name('editUser')->middleware('checkPermit:editUser');
    Route::get('deleteListUser/{id}', [UserController::class, 'destroy'])->name('deleteUser')->middleware('checkPermit:deleteUser');
    Route::get('addUser', function () {
        return view('listUser.addUser');
    })->middleware('checkPermit:addUser');
    Route::post('addUser', [UserController::class, 'store'])->name('addUserPost')->middleware('checkPermit:addUser');
    // role
    Route::get('listRole', [RoleController::class, 'index'])->name('listRole')->middleware('checkPermit:viewListUser');
    Route::get('showRole/{id}', [RoleController::class, 'show'])->name('showRole')->middleware('checkPermit:viewUser');
    Route::post('editRole/{id}', [RoleController::class, 'edit'])->name('editRole')->middleware('checkPermit:editUser');
    Route::get('deleteListRole/{id}', [RoleController::class, 'destroy'])->name('deleteRole')->middleware('checkPermit:deleteUser');
    Route::get('addRole', function () {
        return view('listRole.addRole');
    })->middleware('checkPermit:addUser');
    Route::post('addRole', [RoleController::class, 'store'])->name('addRolePost')->middleware('checkPermit:addUser');

    //
    Route::get('/getAllPermit', [PermitController::class, 'getAllPermit']);
    Route::get('/getAllRole', function(){
        return response()->json([
            'roles' => Role::get()
        ], 200);
    });
});
