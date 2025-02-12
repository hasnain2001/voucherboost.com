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
class HomeController extends Controller
{
    public function index()
    {
    $stores = Stores::orderBy('created_at', 'desc')->paginate(5);
    $blogs = Blog::orderBy('created_at', 'desc')->limit(4)->get();
    $topblogs = Blog::orderBy('created_at', 'desc')->where('top','top')->limit(4)->get();
    $latestblogs = Blog::orderBy('created_at','desc')->where('category','Travel')->limit(2)->get();
    $category = Categories::select('category_image','slug')->where('authentication','top_category')->get();
    return view('home', compact('stores', 'blogs','category','topblogs','latestblogs'));
    }
    public function blog_home(){
 $blogs = Blog::orderBy('created_at', 'desc')->paginate(5);
 $chunks = Stores::paginate(5);
        return view('blog', compact('blogs','chunks'));
    }

    public function blog_show($name) {
        $slug = Str::slug($name);
        $title = ucwords(str_replace('-', ' ', $slug));
        $blog = Blog::where('slug', $title)->first();

        // Check if blog exists
        if (!$blog) {
            abort(404, 'Blog not found');
        }

        $chunks = Stores::where('category', $blog->category)->get();
        $relatedblogs = Blog::where('category', $blog->category)->get();

        return view('blog_details', compact('blog', 'chunks', 'relatedblogs'));
    }

    public function coupons()
    {
        $coupons = Coupons::orderByRaw("CASE WHEN authentication = 'featured' THEN 1 ELSE 2 END")
            ->orderBy('created_at', 'desc') // Secondary sort by creation date
            ->where('status', 'enable')
            ->paginate(5);

        return view('coupon', compact('coupons'));
    }


    public function stores(Request $request, $lang = 'en')
    {
        app()->setLocale($lang);

        // Fetch the language object based on the given code
        $language = Language::where('code', $lang)->firstOrFail();

        // Build the store query
        $storesQuery = Stores::where('language_id', $language->id);

        if ($request->filled('letter')) {
            $storesQuery->where('name', 'like', $request->input('letter') . '%');
        }

        // Fetch paginated stores
        $stores = $storesQuery->orderBy('name')->paginate(30);

        // Append language-based URLs to each store
        $stores->getCollection()->transform(fn ($store) =>
            $store->forceFill([
                'url_with_language' => url("$lang/store/{$store->id}")
            ])
        );

        return view('stores', compact('stores'));
    }


public function StoreDetails($lang = 'en', $slug, Request $request)
{
    app()->setLocale($lang);
    $title = ucwords(str_replace('-', ' ', Str::slug($slug)));
    $store = Stores::with('language')->where('slug', $title)->firstOrFail();
    if (!$store->language) {
        return response()->json(['error' => 'No language selected for this store.'], 404);
    }
    if ($lang !== $store->language->code) {
        return redirect()->route('store_details.withLang', [
            'lang' => $store->language->code,
            'slug' => $slug
        ]);
    }
    $query = Coupons::where('store', $store->slug)->orderByRaw('CAST(`order` AS SIGNED) ASC');
   if ($request->query('sort') === 'codes') {
        $query->whereNotNull('code');
    } elseif ($request->query('sort') === 'deals') {
        $query->whereNull('code');
    }
    $coupons = $query->get();
    $codeCount = $coupons->whereNotNull('code')->count();
    $dealCount = $coupons->whereNull('code')->count();
    $relatedStores = Stores::where('category', $store->category)
                           ->where('id', '!=', $store->id)
                           ->where('language_id', $store->language_id)
                           ->orderBy('created_at', 'desc')
                            ->limit(15)
                           ->get();

    return view('store_details', compact('store', 'coupons', 'relatedStores', 'codeCount', 'dealCount'));
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
    $stores = Stores::where('category', $title)->orderBy('created_at','desc')->paginate(10);
        // Fetch related coupons and stores
        $blogs = Blog::where('category', $title)->get();


    return view('related_category', compact('category', 'stores','blogs' ));
}

}
