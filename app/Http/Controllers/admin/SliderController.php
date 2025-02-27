<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
  public function slider() {
    $sliders = Slider::all();
    return view('admin.slider.index', compact('sliders'));
  }
  public function create_slider()
  {

      return view('admin.slider.create' );
  }
  public function store_slider(Request $request) {

      $request->validate([
          'title' => 'nullable',
          'description' => 'nullable',
            'url' => 'nullable|url',
          'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
          'status' => 'required',
          'url' => 'nullable|url',
      ]);

      $imageName = time().'.'.$request->image->extension();
      $request->image->move(public_path('uploads/slider/'), $imageName);

      Slider::create([
          'title' => $request->title,
          'description' => $request->description,
          'image' => $imageName,
          'status' => $request->status,
      ]);

      return redirect()->back()->with('success', 'Slider Created Successfully');
  }
    public function edit_slider($id) {
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update_slider(Request $request, $id) {
        $slider = Slider::find($id);

        $request->validate([
            'title' => 'nullable',
            'description' => 'nullable',
            'url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'status' => 'required',
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
        ]);

        return redirect()->back()->with('success', 'Slider Updated Successfully');
    }

    public function delete_slider($id) {
        Slider::find($id)->delete();
        return redirect()->back()->with('success', 'Slider Deleted Successfully');
    }

}
