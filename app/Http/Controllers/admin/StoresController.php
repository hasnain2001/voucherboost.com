<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Spatie\ImageOptimizer\OptimizerChainFactory;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use App\Models\Categories;
use App\Models\Networks;
use App\Models\Coupons;
use App\Models\DeleteStore;
use App\Models\Language;
use App\Models\Stores;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class StoresController extends Controller
{

    public function StoreDetails($name)
    {
        $slug = Str::slug($name);
        $title = ucwords(str_replace('-', ' ', $slug));
        $store = Stores::where('slug', $title)->first();
        if (!$store) {
            return redirect('404');
        }
        $coupons = Coupons::with('user')->where('store', $title)->orderByRaw('CAST(`order` AS SIGNED) ASC')->get();
        $relatedStores = Stores::where('category', $store->category)->where('id', '!=', $store->id)->get();

        return view('admin.stores.store-detail', compact('store', 'coupons', 'relatedStores'));
    }
    public function checkSlug(Request $request)
    {
        $slug = $request->slug;
        $exists = Stores::where('slug', $slug)->exists();

        return response()->json([
            'exists' => $exists
        ]);
    }



    // In your StoreController
    public function store()
    {
        $stores = Stores::with('language')->with('user')
        ->select('id', 'name', 'slug', 'status', 'created_at', 'updated_at', 'store_image', 'network', 'category','user_id','language_id',)
        ->orderBy('created_at', 'desc')
        ->get();
// // In the controller
// dd($stores->toArray());

        return view('admin.stores.index', compact('stores',));
    }


    public function create_store()
    {
        $categories = Categories::all();
        $networks = Networks::all();
        $langs = Language::get();

        return view('admin.stores.create', compact('categories', 'networks','langs'));
    }





    public function store_store(Request $request)
    {
        // dd(Auth::id());
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'language_id' =>'nullable|integer',
            'slug' => 'nullable|string|max:255|unique:stores,slug',
            'top_store' => 'nullable|integer',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'destination_url' => 'nullable|url',
            'category' => 'nullable|string',
            'title' => 'nullable|string',
            'status' => 'required|in:enable,disable',
            'meta_keyword' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'authentication' => 'nullable|string',
            'network' => 'nullable|string',
            'store_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'content' => 'nullable',
            'about' => 'nullable|string|max:255',
        ]);

        // Generate a slug if not provided
        $slug = $request->input('slug') ?: Str::slug($request->input('name'));

        // Handle file upload
        $storeImage = null;
        if ($request->hasFile('store_image')) {
            $file = $request->file('store_image');
            $storeImage = md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $filePath = public_path('uploads/stores/') . $storeImage;
            $file->move(public_path('uploads/stores/'), $storeImage);

            if (file_exists($filePath)) {
                $optimizer = OptimizerChainFactory::create();
                $optimizer->optimize($filePath);
            } else {
                return redirect()->back()->with('error', 'Image not found');
            }
        }

        // Create a new store record with the authenticated user's ID
        Stores::create([
            'name' => $request->input('name'),
            'slug' => $slug,
            'language_id' => $request->input('language_id', 1),
            'top_store' => $request->input('top_store'),
            'description' => $request->input('description'),
            'url' => $request->input('url'),
            'destination_url' => $request->input('destination_url'),
            'category' => $request->input('category'),
            'title' => $request->input('title'),
            'meta_keyword' => $request->input('meta_keyword'),
            'meta_description' => $request->input('meta_description'),
            'status' => $request->input('status'),
            'authentication' => $request->input('authentication', 'No Auth'),
            'network' => $request->input('network'),
            'store_image' => $storeImage ?? 'No Store Image',
            'content' => $request->input('content'),
            'about' => $request->input('about'),
            'user_id' => Auth::id(),

        ]);

        return redirect()->back()->withInput()->with('success', 'Store Created Successfully');
    }



    public function edit_store($id)
    {
        $stores = Stores::find($id);
        $categories = Categories::all();
        $networks = Networks::all();
        $langs = Language::get();
        return view('admin.stores.edit', compact('stores', 'categories', 'networks','langs'));
    }

    public function update_store(Request $request, $id)
    {
        // Find the store by ID
        $store = Stores::find($id);

        // Validate the request data
        $request->validate([
        'name' => 'required|string|max:255',
        'slug' => ['required','string','max:255',Rule::unique('stores')->ignore($store->id),],
        'language_id' =>'nullable|integer',
        'top_store' => 'nullable|integer',
        'description' => 'nullable|string',
        'url' => 'nullable|url',
        'destination_url' => 'nullable|url',
        'category' => 'nullable|string',
        'title' => 'nullable|string',
        'meta_keyword' => 'nullable|string',
        'meta_description' => 'nullable|string',
        'status' => 'nullable|in:enable,disable',
        'authentication' => 'nullable|string',
        'network' => 'nullable|string',
        'store_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validates image file
        'content' => 'nullable|',
        'about' => 'nullable|string|max:255',
        ]);


        $storeImage = $store->store_image;
        if ($request->hasFile('store_image')) {
            $file = $request->file('store_image');
            $storeImage = md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $filePath = public_path('uploads/stores/') . $storeImage;

            // Save the file to the specified location
            $file->move(public_path('uploads/stores/'), $storeImage);

            // Ensure that the file has been saved before trying to read it
            if (file_exists($filePath)) {
                // Use Imagick to create a new image instance
                // $image = ImageManager::imagick()->read($filePath);

                // // Resize the image to 300x200 pixels
                // $image->resize(300, 200);

                // // Optionally, resize only the height to 200 pixels
                // $image->resize(null, 200, function ($constraint) {
                //     $constraint->aspectRatio();
                // });

                // Optimize the image
                $optimizer = OptimizerChainFactory::create();
                $optimizer->optimize($filePath);

                // // Save the resized and optimized image
                // $image->save($filePath);
            }
        }
        // Update the store record
        $store->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'language_id' => $request->input('language_id',$store->language_id),
            'top_store' => $request->input('top_store', $store->top_store),
            'description' => $request->input('description'),
            'url' => $request->input('url'),
            'destination_url' => $request->input('destination_url'),
            'category' => $request->input('category', $store->category),
            'title' => $request->input('title'),
            'meta_keyword' => $request->input('meta_keyword'),
            'meta_description' => $request->input('meta_description'),
            'status' => $request->input('status'),
            'authentication' => $request->input('authentication', 'No Auth'),
            'network' => $request->input('network', $store->network),
            'store_image' => $storeImage, // Updated or existing image
            'content' => $request->input('content'),
            'about' => $request->input('about'),
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.stores')->withInput()->with('success', 'Store Updated Successfully');
    }
    public function delete_store($id)
    {
        // Find the store by ID
        $store = Stores::find($id);

        if ($store) {
            // Log the store deletion attempt in the delete_store table
            DeleteStore::create([
                'store_id' => $store->id,
                'store_name' => $store->name,
                'deleted_by' => Auth::id(),

            ]);
            // Delete associated coupons with the same store name
            Coupons::where('store', $store->name)->delete();

            // Delete the store (soft delete if the SoftDeletes trait is used)
            $store->delete();

            return redirect()->back()->with('success', 'Store and associated coupons marked for deletion.');
        }

        return redirect()->back()->with('error', 'Store not found.');
    }
    public function deleteSelected(Request $request)
    {

        $storeIds = $request->input('selected_stores');
        if ($storeIds) {
        $stores = Stores::whereIn('id', $storeIds)->get();
        foreach ($stores as $store) {
        DeleteStore::create([
        'store_id' => $store->id,
        'store_name' => $store->name,
        'deleted_by' => Auth::id(),
        ]);
        Coupons::where('store', $store->slug)->delete();
        $store->delete();
        }
        return redirect()->back()->with('success', 'Selected stores and their associated coupons deleted successfully.');
        } else {
        return redirect()->back()->with('error', 'No stores selected for deletion.');
        }
    }
}
