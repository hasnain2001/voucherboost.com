<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Models\Categories;
use App\Models\Language;
use App\Models\Stores;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            // $view->with('categories', Categories::all());
            $view->with('populorstores', Stores::where('top_store', '>', 0)->orderBy('created_at','desc')->where('status','enable')->limit(8)->get());
              $view->with('langs', Language::all());
            $view->with('currentLang', Session::get('language', 'EN'));
        });
    }
}
