<?php

namespace App\Http\Controllers;

use App\Models\Stores;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{
        public function search(Request $request)
        {
            $query = strtolower($request->input('query'));

            // Fetch stores matching the query for autocomplete
            $stores = Stores::whereRaw('LOWER(slug) LIKE ?', ["$query%"])->pluck('slug');

            // Check if there is a single store matching the query exactly
            $store = Stores::whereRaw('LOWER(slug) = ?', [$query])->first();

            if ($store) {
                // Format the slug in lowercase and replace spaces with hyphens
                $formattedSlug = str_replace(' ', '-', strtolower($store->slug));

                // Redirect to the store details page with the lowercase slug
                return redirect()->route('store.detail', ['slug' => $formattedSlug]);
            }

            // If no exact match, return JSON response for autocomplete if the request is AJAX
            if ($request->ajax()) {
                return response()->json(['stores' => $stores]);
            }

            // Otherwise, redirect to the search results page with the query
            return redirect()->route('search_results', ['query' => $query]);
        }

        public function searchResults(Request $request)
        {
            $query = strtolower($request->input('query'));

            // Fetch stores matching the query (case insensitive)
            $stores = Stores::whereRaw('LOWER(name) LIKE ?', ["$query%"])->paginate(20);
            $stores->appends(['query' => $query]);

            // Check if there is a single store matching the query exactly (case insensitive)
            $store = Stores::whereRaw('LOWER(name) = ?', [$query])->first();

            if ($store) {
                // Format the slug in lowercase and replace spaces with hyphens
                $formattedSlug = str_replace(' ', '-', strtolower($store->slug));
                return redirect()->route('store.detail', ['slug' => $formattedSlug]);
            }

            return view('search_results', ['stores' => $stores]);
        }
}
