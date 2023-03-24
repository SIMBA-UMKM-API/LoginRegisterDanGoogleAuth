<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UMKMController;
use App\Http\Controllers\UserController;

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

//REGISTER
Route::post("register", [UserController::class, 'register']);
//LOGIN
Route::post("login", [UserController::class, 'login']);


//REGISTER BUSINESS
Route::post("registerBusiness", [UMKMController::class, 'registerBusiness']);
// Route::post("registerBusiness",  'App\Http\Controllers\UMKMController@get_branch_list')->name('branch');
