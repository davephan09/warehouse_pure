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
    Route::post('store', [RolesController::class, 'store'])->name('roles.store');
    Route::get('{role}/show', [RolesController::class, 'show'])->name('roles.show');
    Route::get('{role}/get-data-detail', [RolesController::class, 'getDataDetailed'])->name('roles.getDataDetailed');
});

Route::prefix('permissions')->group(function() {
    Route::get('/', [PermissionsController::class, 'index'])->name('permissions.index');
    Route::get('get-data', [PermissionsController::class, 'getData'])->name('permissions.getData');
    Route::post('store', [PermissionsController::class, 'store'])->name('permissions.store');

});