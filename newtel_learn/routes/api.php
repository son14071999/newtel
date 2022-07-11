<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;

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
Route::get('login', function(){
    return view('auth.login');
});
Route::get('listUser', function(){
    return view('listUser.list');
});
Route::post('login', [LoginController::class, 'login'])->name('postLogin');

//User
Route::get('listUser', [UserController::class, 'index'])->name('listUser');
Route::get('showUser/{id}', [UserController::class, 'show'])->name('showUser');
// Route::post('User/{id}', [UserController::class, 'show'])->name('showUser');
Route::post('editUser/{id}', [UserController::class, 'edit'])->name('editUser');
Route::get('deleteListUser/{id}', [UserController::class, 'destroy'])->name('deleteUser');
Route::get('addUser', function(){
    return view('listUser.addUser');
})->name('addUser');
Route::post('addUser', [UserController::class, 'store'])->name('addUserPost');
// Route::get('listUser', UserController::class);
