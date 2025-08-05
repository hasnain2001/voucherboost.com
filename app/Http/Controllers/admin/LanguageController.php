<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LanguageController extends Controller
{
    public function language() {
        $languages = Language::orderByDesc('created_at')->get();
        return view('admin.language.index', compact('languages'));
    }

    public function create_language() {
        return view('admin.language.create');
    }

    public function store_language(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10',
            'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('flag')) {
            $flag = $request->file('flag');
            $storeNameSlug = Str::slug($request->name);
            $flagName = $storeNameSlug . '.' . $flag->getClientOriginalExtension();
            $flag->move(public_path('uploads/flags'), $flagName);
        } else {
            $flagName = null;
        }

        // Create the language entry in the database
        Language::create([
            'name' => $request->name,
            'code' => $request->code,
            'flag' => $flagName, // ✅ Fixed this line
        ]);

        return redirect()->route('admin.lang')->withInput()->with('success', 'Language created successfully');
    }


    public function edit_language($id) {
        $language = Language::find($id);
        return view('admin.language.edit', compact('language'));
    }

    public function update_language(Request $request, $id) {
        $languages = Language::find($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10',
            'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
           if ($request->hasFile('flag')) {
            // Delete the old flag if it exists
            if ($languages->flag) {
                $oldFlagPath = public_path('uploads/flags/' . $languages->flag);
                if (file_exists($oldFlagPath)) {
                    unlink($oldFlagPath);
                }
            }
            $flag = $request->file('flag');
            $storeNameSlug = Str::slug($request->name);
            $flagName = $storeNameSlug . '.' . $flag->getClientOriginalExtension();
            $flag->move(public_path('uploads/flags'), $flagName);
        } else {
            $flagName = $languages->flag;
        }
        $languages->update([
            'name' => $request->name,
            'code' => $request->code,
               'flag' => $flagName,
        ]);

        return redirect()->route('admin.lang')->with('success', 'Store Updated Successfully');
    }

    public function delete_language($id) {
        Language::find($id)->delete();
        return redirect()->back()->with('success', 'language Deleted Successfully');
    }
}
