<?php

use App\Http\Controllers\Api\ClientController;
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
use App\Models\Issue;
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


Route::group(['middleware' => 'auth:api'], function () {
    Route::get('test', [LoginController::class, 'createClient']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    //User
    Route::get('listUser', [UserController::class, 'index'])->name('listUser')->middleware('scope:viewListUser');
    Route::get('showUser/{id}', [UserController::class, 'show'])->name('showUser')->middleware('scope:viewUser');
    Route::post('editUser/{id}', [UserController::class, 'edit'])->name('editUser')->middleware('scope:editUser');
    Route::get('deleteListUser/{id}', [UserController::class, 'destroy'])->name('deleteUser')->middleware('scope:deleteUser');
    Route::get('addUser', function () {
        return view('listUser.addUser');
    })->middleware('scope:addUser');
    Route::post('addUser', [UserController::class, 'store'])->name('addUserPost')->middleware('scope:addUser');

    // role
    Route::get('listRole', [RoleController::class, 'index'])->name('listRole')->middleware('scope:viewListRole');
    Route::get('showRole/{id}', [RoleController::class, 'show'])->name('showRole')->middleware('scope:viewRole');
    Route::post('editRole/{id}', [RoleController::class, 'edit'])->name('editRole')->middleware('scope:editRole');
    Route::get('deleteListRole/{id}', [RoleController::class, 'destroy'])->name('deleteRole')->middleware('scope:deleteRole');
    Route::get('addRole', function () {
        return view('listRole.addRole');
    })->middleware('scope:addRole');
    Route::post('addRole', [RoleController::class, 'store'])->name('addRolePost')->middleware('scope:addRole');

    // department
    Route::get('listDepartment', [DepartmentController::class, 'index'])->name('listdepartment')->middleware('scope:viewListDepartment');
    Route::get('showDepartment/{id}', [DepartmentController::class, 'show'])->name('showdepartment')->middleware('scope:viewDepartment');
    Route::post('editDepartment/{id}', [DepartmentController::class, 'edit'])->name('editdepartment')->middleware('scope:editDepartment');
    Route::get('deleteDepartment/{id}', [DepartmentController::class, 'destroy'])->name('deletedepartment')->middleware('scope:deleteDepartment');
    Route::get('addDepartment', function () {
        return view('listdepartment.adddepartment');
    })->middleware('scope:adddepartment');
    Route::post('addDepartment', [DepartmentController::class, 'store'])->name('adddepartmentPost')->middleware('scope:addRole');




    // issue
    Route::get('getListStatus/{id}', [StatusController::class, 'getListStatus']);
    Route::post('addIssue', [IssueController::class, 'store']);
    Route::get('listIssue', [IssueController::class, 'index']);
    Route::get('getIssue/{id}', [IssueController::class, 'show']);
    Route::post('editIssue/{id}', [IssueController::class, 'edit']);
    Route::delete('deleteIssue/{id}', [IssueController::class, 'destroy']);


    // Client
    Route::post('addClient', [ClientController::class, 'store']);
    Route::get('listClient', [ClientController::class, 'index']);
    Route::get('showClient/{id}', [ClientController::class, 'show']);
    Route::post('editClient/{id}', [ClientController::class, 'edit']);
    Route::delete('deleteClient/{id}', [ClientController::class, 'destroy']);
    
    
    
    //permit
    Route::get('/getAllPermit', [PermitController::class, 'getAllPermit']);
    Route::get('/getAllRole', function(){
        return response()->json([
            'roles' => Role::get()
        ], 200);
    });
    
    
});

//client
Route::post('/refreshToken', [ClientController::class, 'refreshToken']);
Route::post('getredirect', [ClientController::class, 'getredirect']);

// send mail khi quên mật khẩu
Route::post('/forgotPassword', [LoginController::class, 'forgotPassword']);

// Thay đổi mật khẩu
Route::post('/updatePassword', [LoginController::class, 'updatePasswrord']);



