<?php

use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\LanguageController;
use App\Http\Controllers\admin\StoresController;
use App\Http\Controllers\admin\CouponsController;
use App\Http\Controllers\admin\NetworksController;
use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\admin\DeleteController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

// Admin routes


Route::middleware([RoleMiddleware::class])->group(function () {

Route::controller(AdminController::class)->prefix('admin')->name('admin.')->group(function () {
Route::get('/dashboard', 'dashboard')->name('dashboard');
Route::get('/user/create', 'create_user')->name('user.create');
Route::post('/user/store', 'store_user')->name('user.store');
Route::get('/users', 'index')->name('user.index');
Route::get('/user/edit/{id}', 'edit_user')->name('user.edit');
Route::post('/user/update/{id}', 'update_user')->name('user.update');
Route::delete('/users/{id}',  'destroy')->name('user.destroy');
});

Route::controller(DeleteController::class)->name('admin.')->group(function () {
    Route::get('/admin/delete-store', 'deletedStores')->name('delete_store');
    Route::get('/admin/delete-store/delete{id}', 'delete')->name('delete-store-delete');
    Route::get('/admin/delete-coupons', 'coupon')->name('delete_coupon');
    Route::get('/admin/delete-coupons/delete{id}', 'delete_coupon')->name('delete-coupon-delete');
    Route::get('/admin/delete-blog', 'blog')->name('delete_blog');
    Route::get('/admin/delete-blog/delete{id}', 'delete_blog')->name('delete-blog-delete');
});
  // Stores Routes Begin
  Route::controller(SliderController::class)->prefix('admin')->group(function () {
    Route::get('/slider', 'slider')->name('admin.slider');
    Route::get('/slider/create', 'create_slider')->name('admin.slider.create');
    Route::post('/slider/stores', 'store_slider')->name('admin.slider.store');
    Route::get('/slider/edit/{id}', 'edit_slider')->name('admin.slider.edit');
    Route::post('/slider/update/{id}', 'update_slider')->name('admin.slider.update');
    Route::get('/slider/delete/{id}', 'delete_slider')->name('admin.slider.delete');
    // Route::post('/slider/deleteSelected', 'deleteSelected')->name('admin.slider.deleteSelected');
    // Route::get('/slider/{slug}', 'StoreDetails')->name('admin.details');
});
  // Stores Routes Begin
   Route::controller(LanguageController::class)->prefix('admin')->group(function () {
    Route::get('/lang', 'language')->name('admin.lang');
    Route::get('/lang/Create', 'create_language')->name('admin.lang.create');
    Route::post('/lang/stores', 'store_language')->name('admin.lang.store');
    Route::get('/lang/edit/{id}', 'edit_language')->name('admin.lang.edit');
    Route::post('/lang/update/{id}', 'update_language')->name('admin.lang.update');
    Route::get('/lang/delete/{id}', 'delete_language')->name('admin.lang.delete');
    Route::post('/lang/deleteSelected', 'deleteSelected')->name('admin.lang.deleteSelected');
    Route::get('/lang/{slug}', 'StoreDetails')->name('admin.details');
});

    // AdminBlogs Routes Begin
    Route::controller(BlogController::class)->prefix('admin')->group(function () {
    Route::get('/Blog',  'blogs_show')->name('admin.blog.show');
    Route::get('/blog/create',  'create')->name('admin.blog.create');
    Route::post('/blog/store', 'store')->name('admin.blog.store');
    Route::get('/blog/{id}/edit', 'edit')->name('admin.blog.edit');
    Route::post('/admin/Blog/update/{id}', 'update')->name('admin.Blog.update');
    Route::get('/admin/Blog/{id}',  'destroy')->name('admin.blog.delete');
    Route::post('/blog/deleteSelected',  'deleteSelected')->name('admin.blog.deleteSelected');
    Route::delete('/blog/bulk-delete', 'deleteSelected')->name('admin.blog.bulkDelete');
    });

    // Stores Routes Begin
    Route::controller(StoresController::class)->prefix('admin')->name('admin.')->group(function () {
        Route::get('/store', 'store')->name('stores');
        Route::get('/Store/Create', 'create_store')->name('store.create');
        Route::post('/store/stores', 'store_store')->name('store.store');
        Route::get('/store/edit/{id}', 'edit_store')->name('store.edit');
        Route::post('/store/update/{id}', 'update_store')->name('store.update');
        Route::get('/store/delete/{id}', 'delete_store')->name('store.delete');
        Route::post('/store/deleteSelected', 'deleteSelected')->name('store.deleteSelected');
        Route::get('/stores/{slug}', 'StoreDetails')->name('store_details');

    });
    // Categories Routes Begin
    Route::controller(CategoriesController::class)->prefix('admin')->group(function () {
        Route::get('/category', 'category')->name('admin.category');
        Route::get('/category/create', 'create_category')->name('admin.category.create');
        Route::post('/category/store', 'store_category')->name('admin.category.store');
        Route::get('/category/edit/{id}', 'edit_category')->name('admin.category.edit');
        Route::post('/category/update/{id}', 'update_category')->name('admin.category.update');
        Route::get('/category/delete/{id}', 'delete_category')->name('admin.category.delete');
         Route::post('/category/deleteSelected', 'deleteSelected')->name('admin.category.deleteSelected');
         Route::post('/check-slug', 'checkSlug')->name('admin.category.check.slug');
    });


    // Networks Routes Begin
    Route::controller(NetworksController::class)->prefix('admin')->group(function () {
        Route::get('/network', 'network')->name('admin.network');
        Route::get('/network/create', 'create_network')->name('admin.network.create');
        Route::post('/network/store', 'store_network')->name('admin.network.store');
        Route::get('/network/edit/{id}', 'edit_network')->name('admin.network.edit');
        Route::post('/network/update/{id}', 'update_network')->name('admin.network.update');
        Route::get('/network/delete/{id}', 'delete_network')->name('admin.network.delete');
    });

    // Coupons Routes Begin
   Route::controller(CouponsController::class)->prefix('admin')->group(function () {
    Route::get('/coupon', 'coupon')->name('admin.coupon');
    Route::get('/coupon/create', 'create_coupon')->name('admin.coupon.create');
    Route::get('/coupon/create/code', 'create_coupon_code')->name('admin.coupon.code');
    Route::post('/coupon/store', 'store_coupon')->name('admin.coupon.store');
    Route::get('/coupon/edit/{id}', 'edit_coupon')->name('admin.coupon.edit');
    Route::post('/coupon/update/{id}', 'update_coupon')->name('admin.coupon.update');
    Route::get('/coupon/delete/{id}', 'delete_coupon')->name('admin.coupon.delete');
    Route::post('/custom-sortable', 'update')->name('admin.custom-sortable');
    Route::post('/coupon/deleteSelected', 'deleteSelected')->name('admin.coupon.deleteSelected');
    });


});
