<?php

use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\CouponsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\StoresController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Localization;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/login', function () {return view('auth.login');})->middleware('guest')->name('login');
Route::get('/register', function () {return view('auth.register');})->middleware('guest')->name('register');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

//     Route::middleware(Normalization::class)->group(function () {
// });

Route::get('/generate-sitemap', [SitemapController::class, 'generate']);
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Admin routes
Route::middleware([RoleMiddleware::class])->group(function () {
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

Route::prefix('employee')->name('employee.')->group(function () {
Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('dashboard');
});

});

 Route::middleware([Localization::class])->group(function () {
     Route::group(['prefix' => '{lang?}',], function () {
    Route::get('/contact', function () {return view('contact');})->name('contact');
    Route::get('/about-us', function () {return view('about');})->name('about');
    Route::get('/terms-and-condition', function () {return view('terms_and_condition');})->name('terms_and_condition');
    Route::get('/privacy', function () {return view('privacy');})->name('privacy');
    Route::get('/cookies', function () {return view('cookies');})->name('cookies');
    Route::get('/imprint', function () {return view('imprint');})->name('imprint');
     });
 });


    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/category', 'categories')->name('categories');
        Route::get('/category/{slug}', 'viewcategory')->name('related_category');
    });
    Route::middleware([Localization::class])->group(function () {
            });
    Route::controller(HomeController::class)->group(function () {
        Route::get('{lang?}/', 'index')->name('index');
        Route::get('/{lang?}/stores', 'stores')->name('stores');
        Route::get('/{lang?}/store/{slug}', [HomeController::class, 'StoreDetails'])->name('store_details.withLang');
        Route::get('store/{slug}', function($slug) {return app(HomeController::class)->StoreDetails('en', $slug, request());})->name('store.detail');
        Route::get('/{lang?}/coupon', 'coupons')->name('coupons');
        Route::get('/{lang?}/free-delivery-offers', 'free_delivery')->name('FREE-DELIVERY');
        Route::get('/{lang?}/20-off-offers', 'off_offers')->name('20-off-offers');
        Route::get('/{lang?}/blog',  'blog_home')->name('blog');
        Route::get('/blog/{slug}',function($slug) {return app(HomeController::class)->blog_detail('en', $slug, request());})->name('blog.detail');
        Route::get('/{lang}/blog/{slug}', 'blog_detail')->name('blog-details.withLang');
    });



  Route::group(['prefix' => '{lang?}',], function () {
    });
Route::get('/Store/search', [SearchController::class, 'search'])->name('search');
Route::get('/Store/Search_results', [SearchController::class, 'searchResults'])->name('search_results');
Route::post('/update-clicks', [CouponsController::class, 'updateClicks'])->name('update.clicks');
Route::get('/clicks/{couponId}', [CouponsController::class, 'openCoupon'])->name('open.coupon');

// // Route for checking slug
Route::post('/check-slug',[StoresController::class, 'checkSlug'] )->name('check.slug');
Route::post('/blog/create', [BlogController::class, 'checkSlug'])->name('blog.check.slug');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/employee.php';
require __DIR__.'/artisan.php';


