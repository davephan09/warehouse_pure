<?php

use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function() {
    Route::get('/', function ()
    {
       return view('users.index'); 
    });
});

Route::prefix('roles')->group(function() {
    Route::get('/', [RolesController::class, 'index'])->name('roles.index');
    Route::get('get-data', [RolesController::class, 'getData'])->name('roles.getData');
});

Route::prefix('permissions')->group(function() {
    Route::get('/', [PermissionsController::class, 'index'])->name('permissions.index');
    Route::get('get-data', [PermissionsController::class, 'getData'])->name('permissions.getData');
});