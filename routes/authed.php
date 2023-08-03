<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchasingController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VariationController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function() {
    Route::get('/', [UsersController::class, 'index'])->name('users.index');
    Route::get('get-data', [UsersController::class, 'getData'])->name('users.getData');
});

Route::get('/', [ProductController::class, 'index'])->name('home');

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
    Route::get('show/{id}', [CategoryProductController::class, 'show'])->name('category.product.show');
    Route::post('update', [CategoryProductController::class, 'update'])->name('category.product.update');
    Route::post('delete', [CategoryProductController::class, 'destroy'])->name('category.product.destroy');
});

Route::prefix('products')->group(function() {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::get('get-data', [ProductController::class, 'getData'])->name('product.getData');
    Route::get('create', [ProductController::class, 'create'])->name('product.create');
    Route::post('store', [ProductController::class, 'store'])->name('product.store');
    Route::get('show/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::post('update', [ProductController::class, 'update'])->name('product.update');
    Route::post('delete', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::post('create-tag', [ProductController::class, 'createTag'])->name('product.createTag');
    Route::get('search-product', [ProductController::class, 'searchProduct'])->name('product.searchProduct');
});

Route::prefix('brands')->group(function() {
    Route::get('/', [BrandController::class, 'index'])->name('brand.index');
    Route::get('get-data', [BrandController::class, 'getData'])->name('brand.getData');
    Route::post('store', [BrandController::class, 'store'])->name('brand.store');
    Route::post('update', [BrandController::class, 'update'])->name('brand.update');
    Route::post('update-status', [BrandController::class, 'updateStatus'])->name('brand.updateStatus');
    Route::post('delete', [BrandController::class, 'destroy'])->name('brand.destroy');
});

Route::prefix('units')->group(function() {
    Route::get('/', [UnitController::class, 'index'])->name('unit.index');
    Route::get('get-data', [UnitController::class, 'getData'])->name('unit.getData');
    Route::post('store', [UnitController::class, 'store'])->name('unit.store');
    Route::post('update', [UnitController::class, 'update'])->name('unit.update');
    Route::post('update-status', [UnitController::class, 'updateStatus'])->name('unit.updateStatus');
    Route::post('delete', [UnitController::class, 'destroy'])->name('unit.destroy');
});

Route::prefix('taxes')->group(function() {
    Route::get('/', [TaxController::class, 'index'])->name('tax.index');
    Route::get('get-data', [TaxController::class, 'getData'])->name('tax.getData');
    Route::post('store', [TaxController::class, 'store'])->name('tax.store');
    Route::post('update', [TaxController::class, 'update'])->name('tax.update');
    Route::post('update-status', [TaxController::class, 'updateStatus'])->name('tax.updateStatus');
    Route::post('delete', [TaxController::class, 'destroy'])->name('tax.destroy');
});

Route::prefix('variations')->group(function() {
    Route::get('/', [VariationController::class, 'index'])->name('variation.index');
    Route::get('get-data', [VariationController::class, 'getData'])->name('variation.getData');
    Route::post('store', [VariationController::class, 'store'])->name('variation.store');
    Route::post('update', [VariationController::class, 'update'])->name('variation.update');
    Route::post('update-status', [VariationController::class, 'updateStatus'])->name('variation.updateStatus');
    Route::post('delete', [VariationController::class, 'destroy'])->name('variation.destroy');
});

Route::prefix('purchasing')->group(function() {
    Route::get('/', [PurchasingController::class, 'index'])->name('purchasing.index');
    Route::get('get-data', [PurchasingController::class, 'getData'])->name('purchasing.getData');
    Route::get('create', [PurchasingController::class, 'create'])->name('purchasing.create');
    Route::post('store', [PurchasingController::class, 'store'])->name('purchasing.store');
    Route::get('show/{id}', [PurchasingController::class, 'show'])->name('purchasing.show');
    Route::post('update', [PurchasingController::class, 'update'])->name('purchasing.update');
    Route::post('delete', [PurchasingController::class, 'destroy'])->name('purchasing.destroy');
});