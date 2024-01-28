<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });
});
Route::get(
    '/users/create',
    [UserController::class, 'create']
)->middleware('can:create-users');

Route::middleware('create-users')->group(function () {
    Route::get(
        '/users/create',
        [UserController::class, 'create']
    );

    Route::post(
        '/users',
        [UserController::class, 'store']
    );
});
Route::prefix('roles')->group(function () {
    Route::post('/',[RoleController::class, 'RoleController@store']);
    Route::put('/{role}',[RoleController::class, 'RoleController@update'],);
    Route::delete('/{role}',[RoleController::class, 'RoleController@destroy']);
});

Route::prefix('permissions')->group(function () {
    Route::post('/',[RoleController::class, 'PermissionController@store']);
    Route::put('/{permission}',[RoleController::class, 'PermissionController@update']);
    Route::delete('/{permission}',[RoleController::class, 'PermissionController@destroy']);
});

