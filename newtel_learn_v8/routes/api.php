<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PermitController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\IssueController;
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
    Route::get('listRole', [RoleController::class, 'index'])->name('listRole')->middleware('checkPermit:viewListRole');
    Route::get('showRole/{id}', [RoleController::class, 'show'])->name('showRole')->middleware('checkPermit:viewRole');
    Route::post('editRole/{id}', [RoleController::class, 'edit'])->name('editRole')->middleware('checkPermit:editRole');
    Route::get('deleteListRole/{id}', [RoleController::class, 'destroy'])->name('deleteRole')->middleware('checkPermit:deleteRole');
    Route::get('addRole', function () {
        return view('listRole.addRole');
    })->middleware('checkPermit:addRole');
    Route::post('addRole', [RoleController::class, 'store'])->name('addRolePost')->middleware('checkPermit:addRole');
    // department
    Route::get('listDepartment', [DepartmentController::class, 'index'])->name('listdepartment')->middleware('checkPermit:viewListDepartment');
    Route::get('showDepartment/{id}', [DepartmentController::class, 'show'])->name('showdepartment')->middleware('checkPermit:viewDepartment');
    Route::post('editDepartment/{id}', [DepartmentController::class, 'edit'])->name('editdepartment')->middleware('checkPermit:editDepartment');
    Route::get('deleteDepartment/{id}', [DepartmentController::class, 'destroy'])->name('deletedepartment')->middleware('checkPermit:deleteDepartment');
    Route::get('addDepartment', function () {
        return view('listdepartment.adddepartment');
    })->middleware('checkPermit:adddepartment');
    Route::post('addDepartment', [DepartmentController::class, 'store'])->name('adddepartmentPost')->middleware('checkPermit:addRole');




    // issue
    Route::get('getListStatus/{id}', [StatusController::class, 'getListStatus']);
    Route::post('addIssue', [IssueController::class, 'store']);



    //
    Route::get('/getAllPermit', [PermitController::class, 'getAllPermit']);
    Route::get('/getAllRole', function(){
        return response()->json([
            'roles' => Role::get()
        ], 200);
    });
});

// send mail khi quên mật khẩu
Route::post('/forgotPassword', [LoginController::class, 'forgotPassword']);

// Thay đổi mật khẩu
Route::post('/updatePassword', [LoginController::class, 'updatePasswrord']);

