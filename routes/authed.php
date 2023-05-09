<?php

use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function() {
    Route::get('/', [UsersController::class, 'index'])->name('users.index');
    Route::get('get-data', [UsersController::class, 'getData'])->name('users.getData');
});

Route::get('dashboard', function () {
    return view('welcome');
})->name('dashboard');

Route::prefix('roles')->group(function() {
    Route::get('/', [RolesController::class, 'index'])->name('roles.index');
    Route::get('get-data', [RolesController::class, 'getData'])->name('roles.getData');
    Route::post('store', [RolesController::class, 'store'])->name('roles.store');
    Route::post('update', [RolesController::class, 'update'])->name('roles.update');
    Route::get('{role}/show', [RolesController::class, 'show'])->name('roles.show');
    Route::get('{role}/get-data-detail', [RolesController::class, 'getDataDetailed'])->name('roles.getDataDetailed');
    Route::post('delete', [RolesController::class, 'destroy'])->name('roles.destroy');
});

Route::prefix('permissions')->group(function() {
    Route::get('/', [PermissionsController::class, 'index'])->name('permissions.index');
    Route::get('get-data', [PermissionsController::class, 'getData'])->name('permissions.getData');
    Route::post('store', [PermissionsController::class, 'store'])->name('permissions.store');
    Route::post('update', [PermissionsController::class, 'update'])->name('permissions.update');
    Route::post('delete', [PermissionsController::class, 'destroy'])->name('permissions.destroy');
});

Route::prefix('suppliers')->group(function() {
    Route::get('/', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('get-data', [SupplierController::class, 'getData'])->name('suppliers.getData');
    Route::post('store', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::post('update', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::post('change-status', [SupplierController::class, 'changeStatus'])->name('suppliers.changeStatus');
    Route::post('delete', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
});

Route::prefix('categories/product')->group(function() {
    Route::get('/', [CategoryProductController::class, 'index'])->name('category.product.index');
    Route::get('get-data', [CategoryProductController::class, 'getData'])->name('category.product.getData');
    Route::get('create', [CategoryProductController::class, 'create'])->name('category.product.create');
    Route::post('store', [CategoryProductController::class, 'store'])->name('category.product.store');
});