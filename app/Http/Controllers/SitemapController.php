<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Stores;
use App\Models\Categories;
use Illuminate\Support\Str;

class SitemapController extends Controller
{
    public function generate()
    {
        $sitemap = Sitemap::create();

        // Add pages to the sitemap
        $sitemap->add(Url::create('/blog')->setPriority(1.0));
        $sitemap->add(Url::create('/stores')->setPriority(1.0));
        $sitemap->add(Url::create('/categories')->setPriority(1.0));
         $sitemap->add(Url::create('/about')->setPriority(1.0));
        $sitemap->add(Url::create('/about')->setPriority(0.8));
        $sitemap->add(Url::create('/contact')->setPriority(0.8));
        $sitemap->add(Url::create('/term-and-condition')->setPriority(0.8));
        $sitemap->add(Url::create('/privacy')->setPriority(0.8));


        // Optionally, you can add dynamic URLs from the database
        $stores = Stores::all();
        foreach ($stores as $store) {
            // Generate the URL-friendly slug using Str::slug()
            $slug = Str::slug($store->slug);

            // Add the URL to the sitemap with the slug
            $sitemap->add(Url::create("/store/{$slug}"));        }
         // Optionally, you can add dynamic URLs from the database


         $categories = Categories::all();
         foreach ($categories as $category) {
             // Generate the URL-friendly slug using Str::slug()
             $slug = Str::slug($category->title);

             // Add the URL to the sitemap with the slug
             $sitemap->add(Url::create("/category/{$slug}"));
         }


        // Save the sitemap to the public folder
        $sitemap->writeToFile(public_path('sitemap.xml'));

        return redirect()->route('sitemap')->with('success', 'Sitemap created successfully.');

    }
}
