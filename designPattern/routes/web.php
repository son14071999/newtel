<?php

use App\Http\Controllers\UserControllerTest;
use Illuminate\Support\Facades\Route;
use Repositories\User\UserRepository;
use Repositories\User\UserRepositoryInterface;

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

Route::get('/', [UserControllerTest::class, 'index']);
