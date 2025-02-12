<?php

namespace App\Http\Controllers;

use App\Models\Stores;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
    
        // Fetch stores matching the query for autocomplete
        $stores = Stores::where('slug', 'like', "$query%")->pluck('slug');
    
        // Check if there is a single store matching the query exactly
        $store = Stores::where('slug', $query)->first();
    
        if ($store) {
            // If a single store is found, format the slug correctly
            $formattedSlug = str_replace(' ', '-', $store->slug);
    
            // Redirect to the store details page with the formatted slug
            return redirect()->route('store_details', ['slug' => $formattedSlug ]);
        }
    
        // If no exact match, return JSON response for autocomplete if the request is AJAX
        if ($request->ajax()) {
            return response()->json(['stores' => $stores]);
        }
    
        // Otherwise, redirect to the search results page with the query
        return redirect()->route('search_results', ['query' => $query]);
    }

    public function searchResults(Request $request) {
        $query = $request->input('query');
    
        // Fetch stores matching the query for autocomplete
        $stores = Stores::where('name', 'like', "$query%")->get();
    
        // Check if there is a single store matching the query exactly
        $store = Stores::where('name', $query)->first();
    
        if ($store) {
            // If a single store is found, redirect to its details page
            return redirect()->route('store_details', ['slug' => Str::slug($store->slug)]);
        }
    
        return view('search_results', ['stores' => $stores]);
    }
}
