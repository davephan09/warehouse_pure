<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchasingController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SwitchController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VariationController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function() {
    Route::get('/', [UsersController::class, 'index'])->name('users.index');
    Route::get('get-data', [UsersController::class, 'getData'])->name('users.getData');
    Route::get('show/{id}', [UsersController::class, 'show'])->name('users.show');
    Route::get('get-detail-data', [UsersController::class, 'getDetailData'])->name('users.getDetailData');
    Route::post('assign-permissions', [UsersController::class, 'assignPermissions'])->name('users.assignPermissions');
    Route::post('revoke-permissions', [UsersController::class, 'revokePermissions'])->name('users.revokePermissions');
    Route::post('/delete', [UsersController::class, 'destroy'])->name('users.delete');
});

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('dashboard', function () {
    return view('welcome');
})->name('dashboard');

Route::prefix('roles')->as('roles.')->group(function() {
    Route::get('/', [RolesController::class, 'index'])->name('index');
    Route::get('get-data', [RolesController::class, 'getData'])->name('getData');
    Route::post('store', [RolesController::class, 'store'])->name('store');
    Route::post('update', [RolesController::class, 'update'])->name('update');
    Route::get('{role}/show', [RolesController::class, 'show'])->name('show');
    Route::get('{role}/get-data-detail', [RolesController::class, 'getDataDetailed'])->name('getDataDetailed');
    Route::post('delete', [RolesController::class, 'destroy'])->name('destroy');
});

Route::prefix('permissions')->as('permissions.')->group(function() {
    Route::get('/', [PermissionsController::class, 'index'])->name('index');
    Route::get('get-data', [PermissionsController::class, 'getData'])->name('getData');
    Route::post('store', [PermissionsController::class, 'store'])->name('store');
    Route::post('update', [PermissionsController::class, 'update'])->name('update');
    Route::post('delete', [PermissionsController::class, 'destroy'])->name('destroy');
});

Route::prefix('suppliers')->as('suppliers.')->group(function() {
    Route::get('/', [SupplierController::class, 'index'])->name('index');
    Route::get('get-data', [SupplierController::class, 'getData'])->name('getData');
    Route::post('store', [SupplierController::class, 'store'])->name('store');
    Route::post('update', [SupplierController::class, 'update'])->name('update');
    Route::post('change-status', [SupplierController::class, 'changeStatus'])->name('changeStatus');
    Route::post('delete', [SupplierController::class, 'destroy'])->name('destroy');
});

Route::prefix('categories/product')->as('category.')->group(function() {
    Route::get('/', [CategoryProductController::class, 'index'])->name('product.index');
    Route::get('get-data', [CategoryProductController::class, 'getData'])->name('product.getData');
    Route::get('create', [CategoryProductController::class, 'create'])->name('product.create');
    Route::post('store', [CategoryProductController::class, 'store'])->name('product.store');
    Route::get('show/{id}', [CategoryProductController::class, 'show'])->name('product.show');
    Route::post('update', [CategoryProductController::class, 'update'])->name('product.update');
    Route::post('delete', [CategoryProductController::class, 'destroy'])->name('product.destroy');
});

Route::prefix('products')->as('product.')->group(function() {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('get-data', [ProductController::class, 'getData'])->name('getData');
    Route::get('create', [ProductController::class, 'create'])->name('create');
    Route::post('store', [ProductController::class, 'store'])->name('store');
    Route::get('show/{id}', [ProductController::class, 'show'])->name('show');
    Route::post('update', [ProductController::class, 'update'])->name('update');
    Route::post('delete', [ProductController::class, 'destroy'])->name('destroy');
    Route::post('create-tag', [ProductController::class, 'createTag'])->name('createTag');
    Route::get('search-product', [ProductController::class, 'searchProduct'])->name('searchProduct');
    Route::get('sync-product', [ProductController::class, 'syncProductAjax'])->name('syncProductAjax');
});

Route::prefix('brands')->as('brand.')->group(function() {
    Route::get('/', [BrandController::class, 'index'])->name('index');
    Route::get('get-data', [BrandController::class, 'getData'])->name('getData');
    Route::post('store', [BrandController::class, 'store'])->name('store');
    Route::post('update', [BrandController::class, 'update'])->name('update');
    Route::post('update-status', [BrandController::class, 'updateStatus'])->name('updateStatus');
    Route::post('delete', [BrandController::class, 'destroy'])->name('destroy');
});

Route::prefix('units')->as('unit.')->group(function() {
    Route::get('/', [UnitController::class, 'index'])->name('index');
    Route::get('get-data', [UnitController::class, 'getData'])->name('getData');
    Route::post('store', [UnitController::class, 'store'])->name('store');
    Route::post('update', [UnitController::class, 'update'])->name('update');
    Route::post('update-status', [UnitController::class, 'updateStatus'])->name('updateStatus');
    Route::post('delete', [UnitController::class, 'destroy'])->name('destroy');
});

Route::prefix('taxes')->as('tax.')->group(function() {
    Route::get('/', [TaxController::class, 'index'])->name('index');
    Route::get('get-data', [TaxController::class, 'getData'])->name('getData');
    Route::post('store', [TaxController::class, 'store'])->name('store');
    Route::post('update', [TaxController::class, 'update'])->name('update');
    Route::post('update-status', [TaxController::class, 'updateStatus'])->name('updateStatus');
    Route::post('delete', [TaxController::class, 'destroy'])->name('destroy');
});

Route::prefix('variations')->as('variation.')->group(function() {
    Route::get('/', [VariationController::class, 'index'])->name('index');
    Route::get('get-data', [VariationController::class, 'getData'])->name('getData');
    Route::post('store', [VariationController::class, 'store'])->name('store');
    Route::post('update', [VariationController::class, 'update'])->name('update');
    Route::post('update-status', [VariationController::class, 'updateStatus'])->name('updateStatus');
    Route::post('delete', [VariationController::class, 'destroy'])->name('destroy');
});

Route::prefix('purchasing')->as('purchasing.')->group(function() {
    Route::get('/', [PurchasingController::class, 'index'])->name('index');
    Route::get('get-data', [PurchasingController::class, 'getData'])->name('getData');
    Route::get('create', [PurchasingController::class, 'create'])->name('create');
    Route::post('store', [PurchasingController::class, 'store'])->name('store');
    Route::get('show/{id}', [PurchasingController::class, 'show'])->name('show');
    Route::post('update', [PurchasingController::class, 'update'])->name('update');
    Route::post('delete', [PurchasingController::class, 'destroy'])->name('destroy');
});

Route::prefix('customers')->as('customers.')->group(function() {
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::get('get-data', [CustomerController::class, 'getData'])->name('getData');
    Route::post('store', [CustomerController::class, 'store'])->name('store');
    Route::post('update', [CustomerController::class, 'update'])->name('update');
    Route::post('change-status', [CustomerController::class, 'changeStatus'])->name('changeStatus');
    Route::post('delete', [CustomerController::class, 'destroy'])->name('destroy');
    Route::post('restore', [CustomerController::class, 'restore'])->name('restore');
});

Route::prefix('orders')->as('order.')->group(function() {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('get-data', [OrderController::class, 'getData'])->name('getData');
    Route::get('create', [OrderController::class, 'create'])->name('create');
    Route::post('store', [OrderController::class, 'store'])->name('store');
    Route::get('show/{id}', [OrderController::class, 'show'])->name('show');
    Route::post('update', [OrderController::class, 'update'])->name('update');
    Route::post('delete', [OrderController::class, 'destroy'])->name('destroy');
    Route::get('restore', [OrderController::class, 'restore'])->name('restore');
});

Route::prefix('switches')->as('switch.')->group(function() {
    Route::get('/', [SwitchController::class, 'index'])->name('index');
    Route::get('get-data', [SwitchController::class, 'getData'])->name('getData');
    Route::post('switch-user', [SwitchController::class, 'switchUser'])->name('switchUser');
});

Route::impersonate();