<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Categories;
use App\Models\Coupons;
use App\Models\Language;
use App\Models\Slider;
use App\Models\Stores;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use  Illuminate\Support\Facades\App;
class HomeController extends Controller
{
    public function free_delivery($lang = 'en')
    {
        $languageCode = $lang ?? 'en';
        app()->setLocale($languageCode);
    // Fetch the language, or default to English
        $language = language::where('code', $languageCode)->firstOr(function () {
            abort(404, 'Language not found');
        });
        $coupons = Coupons::where('language_id', $language->id)->where('name','Free Delivery')->paginate(10);
        return view('free-delivery', compact('coupons'));

    }
    public function off_offers($lang = 'en')
    {
          $languageCode = $lang ?? 'en';
        app()->setLocale($languageCode);
    // Fetch the language, or default to English
        $language = language::where('code', $languageCode)->firstOr(function () {
            abort(404, 'Language not found');
        });
    $coupons = Coupons::where('language_id', $language->id)->where('name', 'like', '20%')->paginate(10);
    return view('coupons-offer', compact('coupons'));
    }

    public function index(Request $request, $lang = null)
    {
        $languageCode = $lang ?? 'en';
            app()->setLocale($languageCode);
        // Fetch the language, or default to English
            $language = language::where('code', $languageCode)->firstOr(function () {
                abort(404, 'Language not found');
            });
        $sliders = Slider::where('language_id', $language->id)->with('store')->where('status', 'active')->orderBy('created_at', 'desc')->get();
        $topstores = Stores::where('language_id', $language->id)->orderBy('created_at','desc')->where('status', 'enable')->limit(18)->get();
        $topcouponcode = Coupons::where('language_id', $language->id)->with('stores')->select('id', 'name', 'status', 'code','created_at', 'ending_date', 'store', 'clicks',  'authentication')->where('authentication', 'Featured')->where('status', 'enable')->whereNotNull('code')->orderBy('created_at', 'desc')->limit(8)->get();
        $Couponsdeals = Coupons::where('language_id', $language->id)->with('stores')->select('id', 'name', 'status', 'code', 'created_at', 'ending_date', 'store', 'clicks', 'authentication','store_id')->whereNull('code')->where('top_coupons', '>', 0)->where('status', 'enable')->orderBy('created_at','desc')->limit(8)->get();
        $homecategories = Categories::where('authentication', 'top_category')->where('status', 'enable')->limit(4)->get();
        $blogs = Blog::where('language_id', $language->id)->orderBy('created_at', 'desc')
            ->where('language_id', $language->id)
                ->take(5)
                ->get();

        return view('welcome', compact( 'topstores',  'homecategories','topcouponcode','Couponsdeals','sliders','blogs'));
    }


    public function blog_home($lang = "en"){
        app()->setLocale($lang);

        // Fetch the language, or default to English
        $language = language::where('code', $lang)->firstOr(function () {
        abort(404, 'Language not found');
        });
        $blogs = Blog::orderBy('created_at', 'desc')->where('language_id', $language->id)->paginate(5);
        $chunks = Stores::where('top_store', '>', 0)->where('language_id', $language->id)->where('status', 'enable')->get();
        return view('blog', compact('blogs','chunks'));
    }

     public function blog_detail($lang = 'en', $slug, Request $request)
    {
        app()->setLocale($lang);
       $language = language::where('code', $lang)->firstOr(function () {
            abort(404, 'Language not found');
        });
        $slug = Str::slug($slug);
        $title = ucwords(str_replace('-', ' ', $slug));
        $blog = Blog::where('slug', $title)->first();
   if (!$blog->language) {
            return response()->json(['error' => 'No language select for this store.'], 404);
        }
        if ($lang !== $blog->language->code) {
            return redirect()->route('blog-details.withLang', [ 'lang' => $blog->language->code,
                'slug' => $slug
            ]);
        }
        $chunks = Stores::where('language_id', $language->id)->where('id', $blog->store_id)->get();
        $relatedblogs = Blog::where('language_id', $language->id)->where('category_id', $blog->category_id)
          ->where('id', '!=', $blog->id)
        ->get();

        return view('blog_details', compact('blog', 'chunks', 'relatedblogs'));
    }


    public function coupons($lang = 'en')
    {
            app()->setLocale($lang);

        // Fetch the language, or default to English
        $language = language::where('code', $lang)->firstOr(function () {
        abort(404, 'Language not found');
        });
        $coupons = Coupons::orderByRaw("CASE WHEN authentication = 'featured' THEN 1 ELSE 2 END")
            ->orderBy('created_at', 'desc')
            ->where('language_id',$language->id)
            ->where('status', 'enable')
            ->paginate(5);

        return view('coupon', compact('coupons'));
    }


    public function stores(Request $request, $lang = 'en')
    {
        app()->setLocale($lang);

        $language = language::where('code', $lang)->first();
        if (!$language) {
            abort(404, 'Language not found');
        }

        $storesQuery = Stores::query();

        // Apply alphabet filter if present
        if ($request->filled('letter')) {
            $storesQuery->where('name', 'like', $request->input('letter') . '%');
        }

        $stores = $storesQuery->where('language_id', $language->id)
                            ->orderBy('name')
                            ->paginate(30);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('partials.stores_list', ['stores' => $stores])->render(),
                'pagination' => $stores->links()->toHtml()
            ]);
        }

        return view('stores', compact('stores'));
    }

        public function StoreDetails($lang = 'en', $slug, Request $request)
    {
          app()->setLocale($lang);
        $title = ucwords(str_replace('-', ' ', Str::slug($slug)));
        $store = Stores::where('slug', $title)->firstOrFail();

        if ($store->status === 'disable') {
            abort(403, 'Store status is disabled');
        }

       // Check if the store has an associated language
        if (!$store->language) {
            return response()->json(['error' => 'No language select for this store.'], 404);
        }

        // Redirect if the language code doesn't match the store's language
        if ($lang !== $store->language->code) {
            return redirect()->route('store_details.withLang', [
                'lang' => $store->language->code,
                'slug' => $slug
            ]);
        }
        // Check if any coupons exist with the 'store' column matching this slug
        $hasCouponsWithStoreColumn = Coupons::where('store', $store->slug)->exists();

        if ($hasCouponsWithStoreColumn) {
            // If store slug is used in 'store' column
            $query = Coupons::where('store', $store->slug);
        } else {
            // Otherwise fallback to store_id
            $query = Coupons::where('store_id', $store->id);
        }

        $query->where('status', 'enable')
            // ->where('language_id', $store->language_id)
            ->orderByRaw('CAST(`order` AS SIGNED) ASC');

        // Optional filtering
        if ($request->query('sort') === 'codes') {
            $query->whereNotNull('code');
        } elseif ($request->query('sort') === 'deals') {
            $query->whereNull('code');
        }

        $coupons = $query->get();
        $codeCount = $coupons->whereNotNull('code')->count();
        $dealCount = $coupons->whereNull('code')->count();

        $relatedStores = Stores::where('category_id', $store->category_id)
           ->where('language_id', $store->language_id)
            ->where('id', '!=', $store->id)
            ->orderBy('created_at', 'desc')
            ->limit(30)
            ->get();

        $relatedblogs = Blog::where('store_id', $store->id)
           ->where('language_id', $store->language_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('store_details', compact('store', 'coupons','relatedStores','codeCount','dealCount','relatedblogs'));
    }


    public function categories(Request $request,)
    {

        $categories = Categories::select('id', 'title','slug', 'category_image', 'status', 'created_at', 'updated_at')
            ->orderBy('created_at', 'asc')
            ->get();
        return view('categories', compact('categories'));
    }

    public function viewcategory($name) {
        $slug = Str::slug($name);
        $title = ucwords(str_replace('-', ' ', $slug));

        // Fetch the store
        $category = Categories::where('slug', $title)->first();


        if (!$category) {
            return redirect('404');
        }

        // Fetch related coupons and stores
        $stores = Stores::where('category_id', $category->id)->orderBy('created_at','desc')->paginate(10);
            // Fetch related coupons and stores
            $blogs = Blog::where('category_id', $category->id)->get();


        return view('related_category', compact('category', 'stores','blogs' ));
    }

}
