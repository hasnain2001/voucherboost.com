<?php

use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\CouponsController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\StoresController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Localization;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

//     Route::middleware(Normalization::class)->group(function () {
// });

// Admin routes
Route::middleware([RoleMiddleware::class])->group(function () {
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

Route::prefix('employee')->name('employee.')->group(function () {
Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('dashboard');
});

});


Route::middleware([Localization::class])->group(function () {
});
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/stores', 'stores')->name('stores');
    Route::get('store/{slug}', function($slug) {return app(HomeController::class)->StoreDetails('en', $slug, request());})->name('store_details');
    // Route::get('/{lang}/store/{slug}', [HomeController::class, 'StoreDetails'])->name('store_details.withLang');
    Route::get('/coupon', 'coupons')->name('coupons');
    Route::get('/categories', 'categories')->name('categories');
    Route::get('/category/{slug}', 'viewcategory')->name('related_category');
    Route::get('/FREE DELIVERY', 'free_delivery')->name('FREE-DELIVERY');


   // Route for search
    Route::get('/search', [SearchController::class, 'search'])->name('search');
    Route::get('/search_results', [SearchController::class, 'searchResults'])->name('search_results');
// // Route for blog
    Route::get('/blog',  'blog_home')->name('blog');
    Route::get('/blog/{slug}',  'blog_show')->name('blog-details');

            // Route for the contact
    // Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    // Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
// // Route for coupon click

});
Route::post('/update-clicks', [CouponsController::class, 'updateClicks'])->name('update.clicks');
Route::get('/clicks/{couponId}', [CouponsController::class, 'openCoupon'])->name('open.coupon');

// // Route for checking slug
Route::post('/check-slug',[StoresController::class, 'checkSlug'] )->name('check.slug');
Route::post('/blog/create', [BlogController::class, 'checkSlug'])->name('blog.check.slug');
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/employee.php';

