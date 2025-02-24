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
    public function free_delivery()
    {
        $populorstores = Stores::where('top_store', '>', 0)->where('status', 'enable')->get();
$coupons = Coupons::where('name','Free Delivery')->get();
        return view('free-delivery', compact('coupons'));

    }
    public function index()
    {

    return view('home' );
    }
    public function blog_home(){
 $blogs = Blog::orderBy('created_at', 'desc')->paginate(5);
$chunks = Stores::where('top_store', '>', 0)->where('status', 'enable')->get();
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


    public function stores(Request $request)
    {
        // Build the store query
        $storesQuery = Stores::query();

        if ($request->filled('letter')) {
            $storesQuery->where('name', 'like', $request->input('letter') . '%');
        }

        // Fetch paginated stores
        $stores = $storesQuery->orderBy('name')->paginate(30);

        return view('stores', compact('stores'));
    }


    public function StoreDetails(Request $request, $slug)
    {
        $title = ucwords(str_replace('-', ' ', Str::slug($slug)));
        $store = Stores::where('slug', $title)->firstOrFail();

        $query = Coupons::where('store', $store->slug)
            ->orderByRaw('CAST(`order` AS SIGNED) ASC')
            ->where('status', 'enable');

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
            ->orderBy('created_at', 'desc')
            ->limit(30)
            ->get();

        $relatedblogs = Blog::where('category', $store->category)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('store_details', compact('store', 'coupons', 'relatedStores', 'codeCount', 'dealCount', 'relatedblogs'));
    }


    public function categories(Request $request, )
    {

        $categories = Categories::select('id', 'title', 'category_image', 'status', 'created_at', 'updated_at')
            ->orderBy('created_at', 'desc')
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
    $stores = Stores::where('category', $title)->orderBy('created_at','desc')->paginate(10);
        // Fetch related coupons and stores
        $blogs = Blog::where('category', $title)->get();


    return view('related_category', compact('category', 'stores','blogs' ));
}

}
