<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Language;
use App\Models\Slider;
use App\Models\Stores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SliderController extends Controller
{
  public function slider() {
    $sliders = Slider::with('language','store','category')->orderBy('created_at', 'desc')->get();
    return view('admin.slider.index', compact('sliders'));
  }
  public function create_slider()
  {
        $categories =  Categories::orderBy('created_at', 'desc')->get();
        $stores = Stores::orderBy('created_at', 'desc')->get();
        $languages = Language::orderBy('created_at', 'desc')->get();
          return view('admin.slider.create',compact('categories','stores','languages'));
  }
  public function store_slider(Request $request) {

      $request->validate([
          'title' => 'nullable',
          'description' => 'nullable|string|max:455',
         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
          'status' => 'required|string',
         'store_id' => 'required|integer',
          'language_id' => 'required|integer',
           'category_id' => 'required|integer',
      ]);

     if ($request->hasFile('image')) {
            $image = $request->file('image');
            $storeNameSlug = Str::slug($request->title);
            $imageName = $storeNameSlug . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/slider'), $imageName);
        } else {
            $imageName = null;
        }

      Slider::create([
          'title' => $request->title,
          'description' => $request->description,
          'image' => $imageName,
          'status' => $request->status,
          'store_id' => $request->store_id,
          'language_id' => $request->language_id,
          'category_id' => $request->category_id,
           'user_id'=> Auth::id(),
      ]);

      return redirect()->back()->with('success', 'Slider Created Successfully');
  }
    public function edit_slider($id) {
        $slider = Slider::find($id);
         $categories =  Categories::orderBy('created_at', 'desc')->get();
        $stores = Stores::orderBy('created_at', 'desc')->get();
        $languages = Language::orderBy('created_at', 'desc')->get();
        return view('admin.slider.edit', compact('slider','stores','languages','categories'));
    }

    public function update_slider(Request $request, $id) {
        $slider = Slider::find($id);

        $request->validate([
            'title' => 'nullable',
            'description' => 'nullable|string | max:455',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'status' => 'required',
            'store_id' => 'required|integer',
           'language_id' => 'required|integer',
            'category_id' => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/slider/'), $imageName);
            $slider->update([
                'image' => $imageName,
            ]);
        }

        $slider->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'store_id' => $request->store_id ?? $request->store_id,
            'language_id' => $request->language_id ?? $request->language_id,
            'category_id' => $request->category_id ?? $request->category_id,
            'updated_id'=> Auth::id(),
        ]);

        return redirect()->route('admin.slider')->with('success', 'Slider Updated Successfully');
    }

    public function delete_slider($id) {
        Slider::find($id)->delete();
        return redirect()->back()->with('success', 'Slider Deleted Successfully');
    }

}
