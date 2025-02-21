<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Coupons;
use App\Models\DeleteCoupons;
use App\Models\Language;
use App\Models\Stores;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CouponsController extends Controller
{
    public function coupon(Request $request) {
        if ($request->ajax()) {
            $coupons = Coupons::get();
            return response()->json($coupons);
        }

        // Get distinct store names only
        $couponstore = Coupons::select('store')->distinct()->get();
        $selectedCoupon = $request->input('store');

        // Initialize query
        $productsQuery = Coupons::query();

        // Filter by selected store if any
        if ($selectedCoupon) {
            $productsQuery->where('store', $selectedCoupon);
        }


        $coupons = $productsQuery->orderBy('store')
            ->orderByRaw('CAST(`order` AS SIGNED) ASC')
            ->orderBy('created_at', 'desc')
            ->limit(200)
            ->get();
        return view('admin.coupons.index', compact('coupons','couponstore','selectedCoupon'));

    }

public function openCoupon($couponId)
{
    $coupon = Coupons::find($couponId);
    if ($coupon) {
        // Increment click count
        $coupon->clicks++;
        $coupon->save();

        // Assuming you have a route named 'store.detail' that shows the store detail page
        return redirect()->route('store.detail', ['id' => $coupon->store_id]);
    }
    // Handle case where coupon is not found
    return redirect()->back()->with('error', 'Coupon not found.');
}

public function updateClicks(Request $request)
{
    $couponId = $request->input('coupon_id');
    $coupon = Coupons::find($couponId);
    if ($coupon) {
        $coupon->clicks++;
        $coupon->save();
        return redirect()->back()->with('success', 'Coupon Click added');
    }
    return response()->json(['success' => false, 'message' => 'Coupon not found.']);
}


public function update(Request $request)
{
    try {
        $orderData = $request->order;

        // Loop through the order data and update the order column for each coupon
        foreach ($orderData as $order) {
            $coupon = Coupons::find($order['id']);
            $coupon->order = $order['position'];
            $coupon->save();
        }

        return response()->json(['status' => 'success', 'message' => 'Update Successfully.']);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
}

    public function create_coupon() {
        $stores = Stores::all();
        $langs = Language::all();
        return view('admin.coupons.create', compact('stores','langs'));
    }
    public function create_coupon_code() {
        $stores = Stores::orderBy('created_at', 'desc')->get();
        $langs = Language::orderBy('created_at', 'desc')->get();
        return view('admin.coupons.createcode', compact('stores','langs'));
    }

    public function store_coupon(Request $request) {
        // Define validation rules
        $request->validate([
            'name' => 'required|string|max:255',
            'language_id' =>'required|integer',
            'description' => 'nullable|string|max:1000',
            'code' => 'nullable|string|max:100',
            'destination_url' => 'nullable|url',
            'ending_date' => 'nullable|date|after_or_equal:today',
            'status' => 'required|in:enable,disable',
            'authentication' => 'nullable|string',
            'authentication.*' => 'string',
            'store' => 'nullable|string|max:255',
        'top_coupons' => 'nullable|integer|min:0',


        ]);

        // Create coupon using validated data
        Coupons::create([
            'name' => $request->name,
            'language_id' => $request->input('language_id'),
            'description' => $request->description,
            'code' => $request->code,
            'destination_url' => $request->destination_url,
            'ending_date' => $request->ending_date,
            'status' => $request->status,
            'authentication' => $request->authentication ?? "On Sale",
            'store' => $request->store ,
            'top_coupons' => $request->top_coupons,
        ]);

        return redirect()->back()->withInput()->with('success', 'Coupon Created Successfully');
    }


    public function edit_coupon($id) {
        $coupons = Coupons::find($id);
        $stores = Stores::orderBy('created_at', 'desc')->get();
        $langs = Language::orderBy('created_at', 'desc')->get();
        return view('admin.coupons.edit', compact('coupons', 'stores','langs'));
    }

    public function update_coupon(Request $request, $id) {
        // Find the coupon by its ID
        $coupons = Coupons::find($id);

        // Define validation rules
        $request->validate([
            'name' => 'required|string|max:255',
            'language_id' => 'nullable|integer', // Allow null, so it doesn't throw an error if not provided
            'description' => 'nullable|string|max:1000',
            'code' => 'nullable|string|max:100',
            'destination_url' => 'nullable',
            'ending_date' => 'nullable|date|after_or_equal:today',
            'authentication' => 'nullable|string',
              'status' => 'required|in:enable,disable',
            'store' => 'nullable|string|max:255', // Allow null, so it doesn't throw an error if not provided
            'top_coupons' => 'nullable|integer|min:0',
        ]);

        // Update the coupon details, retain old values if not provided
        $coupons->update([
            'name' => $request->name,
            'language_id' => $request->input('language_id', $coupons->language_id), // Retain previous value if not provided
            'description' => $request->description,
            'code' => $request->code,
            'destination_url' => $request->destination_url,
            'ending_date' => $request->ending_date,
            'status' => $request->status,
            'authentication' => $request->authentication,
            'store' => $request->input('store', $coupons->store),
            'top_coupons' => $request->top_coupons,
        ]);

        $store = Stores::where('slug', $coupons->store)->first();

        if ($store) {
            // Assuming $coupon is the variable holding the coupon details
            $couponName = $coupon->name ?? 'Coupon'; // Default to "Coupon" if name is not available

            // Generate the URL for redirection
            $url = route('admin.store_details', ['slug' => Str::slug($store->slug)]);

            // Redirect with a dynamic success message
            return redirect($url)->with('success', "$couponName Updated Successfully");
        }

        return redirect()->back()->with('error', 'Store not found.');

    }



    public function delete_coupon($id) {
        $coupon = Coupons::find($id);

        if (!$coupon) {
            return redirect()->back()->with('error', 'Coupon not found');
        }

        try {
            DB::beginTransaction();

            // Log the deletion in the delete_coupons table
            DeleteCoupons::create([
                'coupon_id' => $coupon->id,
                'coupon_name' => $coupon->name,
                'deleted_by' => Auth::id(),
            ]);

            // Delete the coupon
            $coupon->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Coupon Deleted Successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete coupon. Please try again.');
        }
    }



public function deleteSelected(Request $request)
{
    $couponIds = $request->input('selected_coupons');

    if ($couponIds) {
        Coupons::whereIn('id', $couponIds)->delete();
        return redirect()->back()->with('success', 'Selected coupons deleted successfully');
    } else {
        return redirect()->back()->with('error', 'No coupons selected for deletion');
    }
}


}
