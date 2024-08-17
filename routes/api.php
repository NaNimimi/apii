<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolePermissionController;


// sanctim login logout reguster 
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::group(['middleware' => 'auth:sanctum'], function() {
      Route::get('logout', [AuthController::class, 'logout']);
      Route::get('user', [AuthController::class, 'user']);
    });
});





// this roles and permisinons

Route::post('/roles', [RolePermissionController::class, 'createRole']);
Route::post('/permissions', [RolePermissionController::class, 'createPermission']);
Route::post('/users/{userId}/roles', [RolePermissionController::class, 'assignRole']);
Route::post('/users/{userId}/permissions', [RolePermissionController::class, 'givePermission']);
Route::delete('/users/{userId}/roles', [RolePermissionController::class, 'removeRole']);
Route::delete('/users/{userId}/permissions', [RolePermissionController::class, 'revokePermission']);
