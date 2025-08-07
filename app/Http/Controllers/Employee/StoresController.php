<?php

namespace App\Http\Controllers\Employee;
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
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Str;

class StoresController extends Controller
{
  // In StoreController.php
// In EmployeeController.php
public function checkSlug(Request $request)
{
    $slug = $request->slug;
    $exists = Stores::where('slug', $slug)->exists();  // Adjust Store to your model name

    return response()->json([
        'exists' => $exists
    ]);
}


    public function StoreDetails($name)
        {
            $slug = Str::slug($name);
            $title = ucwords(str_replace('-', ' ', $slug));
            $store = Stores::where('slug', $title)->first();
            if (!$store) {
                return redirect('404');
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
            $coupons = $query->with('user')->orderByRaw('CAST(`order` AS SIGNED) ASC')->get();
            $relatedStores = Stores::where('category', $store->category)->where('id', '!=', $store->id)->get();

            return view('employee.stores.store-detail', compact('store', 'coupons', 'relatedStores'));
        }



    // In your StoreController
    public function store()
    {
        $stores = Stores::with('language','categories')->select('id', 'name', 'slug', 'status', 'store_image', 'network', 'category','category_id','language_id')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('employee.stores.index', compact('stores',));
    }


    public function create_store()
    {
        $categories = Categories::orderByDesc('created_at')->get();
        $networks = Networks::orderByDesc('created_at')->get();
        $langs = Language::orderByDesc('created_at')->get();

        return view('employee.stores.create', compact('categories', 'networks','langs'));
    }





    public function store_store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'language_id' =>'required|integer',
            'slug' => 'required|string|max:255|unique:stores,slug',
            'top_store' => 'nullable|integer',
            'description' => 'required|string',
            'url' => 'required|url',
            'destination_url' => 'required',
            'category_id' => 'required|integer',
            'title' => 'nullable|string',
            'meta_tag' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'authentication' => 'nullable|string',
            'network' => 'nullable|string',
            'store_image' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'content' => 'nullable|string',
            'about' => 'nullable|string',
            'status' => 'required|in:enable,disable',
        ]);

        // Generate a slug from the name if not provided
        $slug = $request->input('slug') ? $request->input('slug') : Str::slug($request->input('name'));

        // Handle the file upload if a store image is provided
        $storeImage = null;
        if ($request->hasFile('store_image')) {
            $file = $request->file('store_image');
            $storeImage = md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $filePath = public_path('uploads/stores/') . $storeImage;

            // Save the file to the specified location
            $file->move(public_path('uploads/stores/'), $storeImage);

            // Ensure that the file has been saved before trying to read it
            if (file_exists($filePath)) {
                // Optimize the image
                // Use Imagick to create a new image instance
                // $image = ImageManager::imagick()->read($filePath);

                // // Resize the image to 300x200 pixels
                // $image->resize(300, 200);

                // // Optionally, resize only the height to 200 pixels
                // $image->resize(null, 200, function ($constraint) {
                //     $constraint->aspectRatio();
                // });
                $optimizer = OptimizerChainFactory::create();
                $optimizer->optimize($filePath);
            } else {
                return redirect()->back()->with('error', 'Image not found');
            }
        }

        // Create a new store record
        $store = Stores::create([
            'name' => $request->input('name'),
            'slug' => $slug, // Use the generated or provided slug
            'language_id' => $request->input('language_id', 1),
            'top_store' => $request->input('top_store'),
            'description' => $request->input('description'),
            'url' => $request->input('url'),
            'destination_url' => $request->input('destination_url'),
            'title' => $request->input('title'),
            'meta_tag' => $request->input('meta_tag'),
            'meta_keyword' => $request->input('meta_keyword'),
            'meta_description' => $request->input('meta_description'),
            'status' => $request->input('status'),
            'authentication' => $request->input('authentication', 'No Auth'),
            'network' => $request->input('network'),
            'store_image' => $storeImage ?? 'No Store Image',
            'content' => $request->input('content'),
            'about' => $request->input('about'),
            'user_id' => Auth::id(),
            'category_id' => $request->input('category_id', null),
        ]);

        // Redirect back with a success message
     return redirect()->route('employee.store_details' ,['slug' => Str::slug($store->slug)])->withInput()->with('success', 'Store Created Successfully');
    }


    public function edit_store($id)
    {
        $stores = Stores::find($id);
        $categories = Categories::orderByDesc('created_at')->get();
        $networks = Networks::orderByDesc('created_at')->get();
        $langs = Language::orderByDesc('created_at')->get();
        return view('employee.stores.edit', compact('stores', 'categories', 'networks','langs'));
    }

    public function update_store(Request $request, $id)
    {
        $store = Stores::find($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => ['required','string', 'max:255', Rule::unique('stores')->ignore($store->id)],
            'language_id' => 'required|integer',
            'top_store' => 'nullable|integer',
            'description' => 'nullable|string',
            'url' => 'required',
            'destination_url' => 'required',
            'category_id' => 'required|integer',
            'title' => 'nullable|string',
            'meta_tag' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'authentication' => 'nullable|string',
            'network' => 'nullable|string',
            'store_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'content' => 'nullable',
            'about' => 'nullable|string',
            'status' => 'required|in:enable,disable',
        ]);

        $storeImage = $store->store_image;

        if ($request->hasFile('store_image')) {
            $file = $request->file('store_image');
            $storeImage = md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $filePath = public_path('uploads/stores/') . $storeImage;

            $file->move(public_path('uploads/stores/'), $storeImage);

            if (file_exists($filePath)) {
                $optimizer = OptimizerChainFactory::create();
                $optimizer->optimize($filePath);
            }
        }



        $store->update([
            'name' => $request->input('name', $store->name),
            'slug' => $request->input('slug', $store->slug),
            'language_id' => $request->input('language_id',$store->language_id),
            'top_store' => $request->input('top_store', $store->top_store),
            'description' => $request->input('description', $store->description),
            'url' => $request->input('url'),
            'destination_url' => $request->input('destination_url', $store->destination_url),
            'category' => $request->input('category', $store->category),
            'title' => $request->input('title', $store->title),
            'meta_keyword' => $request->input('meta_keyword', $store->meta_keyword),
            'meta_description' => $request->input('meta_description', $store->meta_description),
            'status' => $request->input('status', $store->status),
            'authentication' => $request->input('authentication', 'No Auth'),
            'network' => $request->input('network', $store->network),
            'store_image' => $storeImage,
            'content' => $request->input('content', $store->content),
            'about' => $request->input('about', $store->about),
            'updated_id' => Auth::id(),
            'category_id' => $request->category_id ?? $store->category_id,
        ]);

        if (!$store) {
            return redirect()->back()->with('error', 'Failed to update store');
        }

        if ($request->hasFile('store_image') && !file_exists(public_path('uploads/stores/') . $storeImage)) {
            return redirect()->back()->with('error', 'Failed to update store image');
        }

        return redirect()->route('employee.stores')->with('success', 'Store Updated Successfully');
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
