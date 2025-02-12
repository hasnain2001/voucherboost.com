<?php
use App\Http\Controllers\Employee\BlogController;
use App\Http\Controllers\Employee\StoresController;
use App\Http\Controllers\Employee\CouponsController;
use App\Http\Controllers\Employee\NetworksController;
use App\Http\Controllers\Employee\CategoriesController;
use App\Http\Controllers\EmployeeController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\EmployeeMiddleware;
use Illuminate\Support\Facades\Route;
Route::middleware([RoleMiddleware::class])->group(function () {
     // Employee Routes Begin   
      Route::controller(BlogController::class)->prefix('employee')->group(function () {
          Route::get('/Blog',  'blogs_show')->name('employee.blog.index');
          Route::get('/blog/create',  'create')->name('employee.blog.create');
          Route::post('/blog/store', 'store')->name('employee.blog.store');
          Route::get('/blog/{id}/edit', 'edit')->name('employee.blog.edit');
          Route::post('/employee/Blog/update/{id}', 'update')->name('employee.Blog.update');
          Route::delete('/employee/Blog/{id}', [BlogController::class, 'destroy'])->name('employee.blog.delete');
          Route::post('/blog/deleteSelected', [BlogController::class, 'deleteSelected'])->name('employee.blog.deleteSelected');
          Route::delete('/blog/bulk-delete', [BlogController::class, 'deleteSelected'])->name('employee.blog.bulkDelete');
      });
  
      // Stores Routes Begin
      Route::controller(StoresController::class)->prefix('employee')->name('employee.')->group(function () {
          Route::get('/store', 'store')->name('stores');
          Route::get('/Store/Create', 'create_store')->name('store.create');
          Route::post('/store/stores', 'store_store')->name('store.store');
          Route::get('/store/edit/{id}', 'edit_store')->name('store.edit');
          Route::post('/store/update/{id}', 'update_store')->name('store.update');
          Route::get('/store/delete/{id}', 'delete_store')->name('store.delete');
          Route::post('/store/deleteSelected', 'deleteSelected')->name('store.deleteSelected');
          Route::get('/stores/{slug}', 'StoreDetails')->name('store_details');
          Route::post('/check-slug', 'checkSlug')->name('check.slug');

      });
  
  
      // Categories Routes Begin
      Route::controller(CategoriesController::class)->prefix('employee')->name('employee.')->group(function () {
          Route::get('/category', 'category')->name('category');
          Route::get('/category/create', 'create_category')->name('category.create');
          Route::post('/category/store', 'store_category')->name('category.store');
          Route::get('/category/edit/{id}', 'edit_category')->name('category.edit');
          Route::post('/category/update/{id}', 'update_category')->name('category.update');
          Route::get('/category/delete/{id}', 'delete_category')->name('category.delete');
           Route::post('/category/deleteSelected', 'deleteSelected')->name('category.deleteSelected');
      });
  
  
      // Networks Routes Begin
      Route::controller(NetworksController::class)->prefix('employee')->group(function () {
          Route::get('/network', 'network')->name('employee.network');
          Route::get('/network/create', 'create_network')->name('employee.network.create');
          Route::post('/network/store', 'store_network')->name('employee.network.store');
          Route::get('/network/edit/{id}', 'edit_network')->name('employee.network.edit');
          Route::post('/network/update/{id}', 'update_network')->name('employee.network.update');
          Route::get('/network/delete/{id}', 'delete_network')->name('employee.network.delete');
      });
  
      // Coupons Routes Begin
  
  
      Route::controller(CouponsController::class)->prefix('employee')->group(function () {
          Route::get('/coupon', 'coupon')->name('employee.coupon');
          Route::get('/coupon/create', 'create_coupon')->name('employee.coupon.create');
          Route::get('/coupon/create/code', 'create_coupon_code')->name('employee.coupon.code');
          Route::post('/coupon/store', 'store_coupon')->name('employee.coupon.store');
          Route::get('/coupon/edit/{id}', 'edit_coupon')->name('employee.coupon.edit');
          Route::post('/coupon/update/{id}', 'update_coupon')->name('employee.coupon.update');
          Route::get('/coupon/delete/{id}', 'delete_coupon')->name('employee.coupon.delete');
          Route::post('/custom-sortable', 'update')->name('employee.custom-sortable');
      Route::post('/coupon/deleteSelected', 'deleteSelected')->name('employee.coupon.deleteSelected');
  });
  });
